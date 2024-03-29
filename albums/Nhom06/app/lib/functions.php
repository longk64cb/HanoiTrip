<?php


const APP_URL = 'trealet';

function initializeApp($exec){
	$app_url = '../../../..'.$_GET[APP_URL];
	// $app_url = '../vanmieu.trealet';
	$json_string = file_get_contents($app_url);	
	if(!$json_string) die($app_url.' not found!');
	$d = json_decode($json_string, true);	
	if(!$d) die('Cannot parse the trealet content!');	
	if(!isset($d['trealet'])) die('It is not a trealet!');	
	if($d['trealet']['exec']!=$exec) die('Wrong executable name!');
	return $d['trealet'];
}

function parseTrealetJSON($json_string,$exec){
	$d = json_decode($json_string, true);	
	if(!$d) die('Cannot parse the trealet content!');	
	if(!isset($d['trealet'])) die('It is not a trealet!');	
	if($d['trealet']['exec']!=$exec) die('Wrong executable name!');
	return $d['trealet'];
}

function fetchItemData($item_url){
	if(is_numeric($item_url)){
		$item_url = 'https://hcloud.trealet.com/tiny'.$item_url.'/?json';
		$json_string = file_get_contents($item_url);
		// debug_to_console($json_string);
		if(!$json_string){debug_to_console('bruh'); return;	}
		$d = json_decode($json_string, true);
		return $d['image'];
	}
	else {
		return $item_url;
	}
}

// hàm render nội dung item
function htmlItem($trealet_id,$nij,$idata, $css_item_id='', $css_input_id=''){
	if(isset($idata['url_full']))//Show up the data item
	{
		$title 	  = isset($idata['title'])?$idata['title']:'';;
		$desc	  = isset($idata['desc'])?$idata['desc']:'';
		$url_full = isset($idata['url_full'])?$idata['url_full']:'';
		$path     = isset($idata['path'])?$idata['path']:'';
		
		$vobj	  = '';
		
		//Supported format APP, FLA, FLV, GIF, GLB, HTM, HTML, JPEG, JPG, M4A, M4V, MP3, MP4, PDF, PNG, PPS, PPT, TIF, TIFF, TXT		
		
		$ext = strtoupper(pathinfo($url_full, PATHINFO_EXTENSION));
		
		//items
		if($ext=='GIF' || $ext=='JPEG'|| $ext=='JPG'|| $ext=='PNG'|| $ext=='TIF'|| $ext=='TIFF'){
			$vobj .= '<center><img src="'.$url_full.'" style="max-width:90%;"></center>';
			$html = '<div class="row"><div class="col-md-7 caption"><h3><span>'.$title.'</span></h3><p>'.$desc.'</p></div><div class="col-md-5">'.$vobj.'</div></div>';
		}

		// if($ext="HTML") {
		// 	$vobj .=
		// }
		
		//Text
		if($ext=='TXT'){
			$vobj .= file_get_contents('https://hcloud.trealet.com'.$url_full); //For embedded video
			//$vobj = '<iframe src="'.$url_full.'"></iframe>';
			$html = '<h3><span>'.$title.'</span></h3><center>'.$vobj.'</center><br><p>'.$desc.'</p>';
		}
		
		//Youtube
		if($ext=="YTB"){
			$vid = file_get_contents('https://hcloud.trealet.com'.$url_full);
			$vobj .= '<div style="position: relative; width: 90%; height: 0; padding-bottom: 50%;">';
			$vobj .= '<iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="https://www.youtube.com/embed/'.$vid.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
			$vobj .= '</div>';
			$html = '<div class="row"><div class="col-md-5 caption"><h3><span>'.$title.'</span></h3><p>'.$desc.'</p></div><div class="col-md-7">'.$vobj.'</div></div>';
		}
		
		//GLB for 3D
		if($ext=='GLB'){
			$vobj .= '<div style="position: relative; width: 90%; height: 0; padding-bottom: 50%;">';
			$vobj .= '<iframe src="https://hcloud.trealet.com/h3r/embed/?glb='.$url_full.'" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>';
			$vobj .= '</div>';
			$vobj = '<center>'.$vobj.'</center>';
			$html = '<h3 class="title"><span>'.$title.'</span></h3><center>'.$vobj.'</center><br><p>'.$desc.'</p>';
		}
		
		//Audio MP3
		if($ext=='MP3'){
			$vobj = '<audio controls><source src="'.$url_full.'" type="audio/mpeg">Your browser does not support the audio tag.</audio>';
			$html = '<h3 class="title"><span>'.$title.'</span></h3><center>'.$vobj.'</center><br><p>'.$desc.'</p>';
		}
		
		//Video MP4
		if($ext=='MP4'){
			$vobj = '<video width="90%" height="auto" controls><source src="'.$url_full.'" type="video/mp4">Your browser does not support the video tag.</video>';
			$html = '<h3 class="title"><span>'.$title.'</span></h3><center>'.$vobj.'</center><br><p>'.$desc.'</p>';
		}
		return $html;
	}else if(isset($idata['input']) && isset($idata['input']['type'])){
		$type 	  = $idata['input']['type'];
		$title 	  = isset($idata['input']['label'])?$idata['input']['label']:'';
		$desc	  = isset($idata['input']['desc'])?$idata['input']['desc']:'';
		$vobj 	  = '';
		if($type=='picture'){
			$vobj = '<iframe style="position: relative; width: 90%;" src="https://hcloud.trealet.com/trealet-schema/input-picture/index.php?tr_id='.$trealet_id.'&nij='.$nij.'" title="'.$title.'" frameborder="0" allow="camera" onload="this.style.height=(this.contentWindow.document.body.scrollHeight+200)+\'px\';"></iframe>';
		}else if($type=='audio'){
			$vobj = '<iframe style="position: relative; width: 100%;" src="https://hcloud.trealet.com/trealet-schema/input-audio/index.php?tr_id='.$trealet_id.'&nij='.$nij.'" title="'.$title.'" frameborder="0" allow="microphone" onload="this.style.height=(this.contentWindow.document.body.scrollHeight+100)+\'px\';"></iframe>';
		}else if($type=='form'){
			$vobj = '<iframe style="position: relative; width: 90%;" src="https://hcloud.trealet.com/trealet-schema/input-form/index.php?tr_id='.$trealet_id.'&nij='.$nij.'" title="Input data from a form" frameborder="0" onload="this.style.height=(this.contentWindow.document.body.scrollHeight+250)+\'px\';"></iframe>';
		}else if($type=='qr'){
			$vobj 	 .= '<iframe style="position: relative; width: 90%;" src="https://hcloud.trealet.com/trealet-schema/input-qr/index.php?tr_id='.$trealet_id.'&nij='.$nij.'" title="Scan QR code from camera" frameborder="0" allow="camera" onload="this.style.height=(this.contentWindow.document.body.scrollHeight+200)+\'px\';"></iframe>';
		}
		$html 	  = '<div id="'.$css_input_id.'"><h1 class="title" style={}>'.$title.'</h1><center>'.$vobj.'</center><br><p>'.$desc.'</p></div>';
		return $html;
	}
}

// load thumbnail cho grid item
function itemThumbnail($idata) {
	$url_full = $idata['url_full'];
	$html = '<style>
    .item {
		border: 1px solid #ddd; /* Gray border */
		border-radius: 4px;  /* Rounded border */
		padding: 5px; /* Some padding */
		width: 350px; /* Set a small width */
        height: 200px;
		background-color: white;
	  }
	  
	  /* Add a hover effect (blue shadow) */
	.item:hover {
		box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
	}

    .item {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    img {
        max-height: 100%;
        max-width: 100%;
    }
	</style>
	<a class="item">
		<img src="'.$url_full.'">
	</a>';
	return $html;
}

function itemSlider($idata, $k) {
	$url_full = $idata['url_full'];
	// debug_to_console($url_full);
	$title	  = $idata['title'];
	$html = '<style>
    .item {
		position: relative;
		width:300px;
		height:500px;
		margin-right: 40px;
	}
	.item img{
		width:300px;
		height:500px;
		object-fit: cover;
	}
	.img__description_layer {
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		background: rgba(4, 4, 15, 0.6);
		color: #fff;
		visibility: hidden;
		opacity: 0;
		display: flex;
		align-items: center;
		justify-content: center;
	  
		/* transition effect. not necessary */
		transition: opacity .2s, visibility .2s;
	  }
	  
	  .item:hover .img__description_layer {
		visibility: visible;
		opacity: 1;
	  }
	  
	  .img__description {
		transition: .2s;
		transform: translateY(1em);
		text-align: center;
	  }
	  
	  .item:hover .img__description {
		transform: translateY(0);
	  }
	</style>
	<a class="item" onClick="showDetails(this, '.$k.')">
		<img src="'.$url_full.'">
		<div class="img__description_layer">	
			<h3 class="img_description">'.$title.'</h3>
		</div>
	</a>
	';
	return $html;
}

function itemDetails($idata) {
	$url_full = $idata['url_full'];
	// debug_to_console($url_full);
	$title = $idata['title'];
	$desc = $idata['desc'];
	$html = '<style>
	.detailContainer {
		display: none;
		padding-top: 90px;
		margin: auto;
		width: 70vw;
		height: 80vh;
	}
	.detailContainer h3 {
		text-align: center;
		font-weight: bold;
		color: white;
	}
	.detailContainer img {
		width: 70vw;
		height: 65vh;
		object-fit: contain;
		padding: 10px;
		border: solid white;
		background-color: white;
	}
	.detail p {
		width: 75vw;
		height: 10vh;
		overflow: auto;
	}
	</style>
	<div class="detailContainer">
	  	<h3>'.$title.'</h3>
		<img src="'.$url_full.'">	
		<p style="color: white;">'.$desc.'</p>
	</div>
	';
	return $html;
}

function debug_to_console($data) {
	$output = $data;
	if (is_array($output))
		$output = implode(',', $output);

	echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>

