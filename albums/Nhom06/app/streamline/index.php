<?php
	require_once('../lib/functions.php');

	$d = initializeApp('streamline');	
	$ni = sizeof($d['items']);
	// debug_to_console($ni);
	$iu = array($ni);	
?>

<!DOCTYPE HTML>
<html>

<head>
<title><?php echo $d['title']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<!--test template style-->
<!--Easy Scroll Dots style-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="../styles.css"/> -->
<style>
	.scroll-indicator-controller{position:fixed;top:50vh;transform:translate(0,-50%);right:10px;z-index:999}.scroll-indicator-controller.indi-mobile>div span{display:none}@media (min-width:1025px){.scroll-indicator-controller{right:20px}}.scroll-indicator-controller>div{width:20px;height:20px;position:relative;border-radius:50%;border:1px solid tomato;background:rgba(0,0,0,.25);margin:0 0 10px 0;cursor:pointer;transition:background .4s ease;will-change:transition}.scroll-indicator-controller>div span{color:tomato;position:absolute;right:calc(100% + 8px);white-space:nowrap;top:50%;font-family:arial,sans-serif;font-size:16px;line-height:17px;width:0;overflow:hidden;opacity:0;transform:translateY(-50%) translateX(10px);transition:all .4s ease;will-change:transition}@media (hover:none){.scroll-indicator-controller>div span{display:none}}.scroll-indicator-controller>div span:after{content:"-----";padding-left:5px;letter-spacing:-2px;font-family:arial,sans-serif;vertical-align:text-top;line-height:14px}@media (hover:hover),(-ms-high-contrast:none),(-ms-high-contrast:active){.scroll-indicator-controller>div:hover span{width:auto;opacity:1;overflow:visible;transform:translateY(-50%) translateX(0)}}.scroll-indicator-controller>div.active{background:tomato;border-color:rgba(0,0,0,.25)}@supports (-ms-ime-align:auto){.scroll-indicator-controller>div span{transition:opacity .4s ease}}
	html, body {
    height: 100%;
    width: 100%;
	}

	body {
		background-image: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url(https://img2.thuthuatphanmem.vn/uploads/2019/03/05/hinh-nen-powerpoint-chu-de-lich-su-don-gian_110315874.jpg);
		background-color: #f0e5c7;
	}

	#home {
		background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(
			<?php 
				$idata 	= fetchItemData($d['imgFront']);
				echo $idata['url_full'];
			?>
		) no-repeat center center fixed;
		display: table;
		height: 60%;
		width: 100%;
		position: relative;
		background-size: cover ;
	}

	.landing-text {
		display: table-cell;
		text-align: center;
		vertical-align: middle;
		color: aliceblue;
	}

	.landing-text h1 {
		font-size: 500%;
		font-weight: 700;
	}

	#header {
		margin-bottom: 50px;
	}

	#header h1 {
		font-size: 52px;
		text-align: center;
		/* padding-top: 20px; */
	}

	#header p {
		width: 700px;
		font-size: 20px;
		/* margin-top: 20px; */
		margin: auto;
		text-align: center;
	}
	
	#itemcontent{
		box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; 
		border-radius: 20px 20px 20px 20px;
		padding: 10px;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	
	.grid-content {
		display: grid;
		grid-template-columns: repeat(3, 350px);
		grid-gap: 1.5rem;
	}

	#main {
		margin: 50px auto;
		width: 80%;
		max-width: 1200px;
	}

	#logo_text {
		text-align: center;
	}

	.title {
		margin-bottom: 25px;
	}

	.content {
		margin: 50px auto;
	}

	/* css itemslider */
	.slider {
    width: 980px;
    margin: auto;
	margin-top: 30px;
	margin-bottom: 30px;
    overflow: hidden;
    position: relative;
	}
	.slider-container {
    	display: flex;
	}
	.prev{
		width: 1.2em;
		text-align: center;
		position: absolute;
		left: 10px;
		top: 50%;
		margin-top: -0.5em;
		font-size: 60px;
		font-family: monospace;
		border-radius: 5px;
		color: white;
		padding-bottom:8px;
	}
	.next {
		width: 1.2em;
		text-align: center;
		position: absolute;
		right: 10px;
		top: 50%;
		margin-top: -0.5em;
		font-size: 60px;
		font-family: monospace;
		border-radius: 5px;
		color: white;
		padding-bottom:8px;
	}
	.prev:hover, .next:hover {
    background-color: rgba(30, 30, 30, .6);
	}

	.details {
		display: none;
		position: fixed;
		top: 0;
		left: 0;
		width: 100vw;
		height: 100vh;
		background-color: rgba(0,0,0,.7);
	}
	
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-dark navbar-expand-lg text-uppercase fixed-top" id="navbar">
		<div class="container">
			<a class="navbar-brand fs-4 fw-bold" href="../introPage/index.php">HaNoiTrip</a>
			<button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded fw-bold" href="../introPage/index.php#about">Khám phá</a></li>
					<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded fw-bold" href="../introPage/map.php">Bản đồ</a></li>
					<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded fw-bold" href="#contact">Liên hệ</a></li>
				</ul>
			</div>
		</div>
    </nav>
	<div id="home">
		<div class="landing-text">
			<h1><?php echo $d['title']; ?></h1>
			<!-- <h3>Tìm hiểu về kiến trúc lịch sử Hà Nội</h3> -->
			<!-- <a role="button" class="btn btn-light smoothscroll" href="#main">Khám phá</a> -->
		</div>
    </div>
  <div id="main">
    <div id="header" class="container">
      <div id="logo">
		<h1 id="desc"><span class="logo_colour">Giới thiệu</span></h1>
		
        <div id="logo_text">
<?php
		// if(isset($d['author']))
		// 	echo '<h2><b>Tác giả: </b><i>'.$d['author'].'</i></h2>';
		echo '<p>'.$d['desc'].'</p>';
?>
        </div>
      </div>
    </div>
	
    <div id="site_content" class="container">
<?php
	for($i=0;$i<$ni;$i++){
		$title = $d['items'][$i]['title'];
		$value = $d['items'][$i]['value'];
		if(is_array($value)) {
			echo '<div><div class="scroll-indicator" id="section'.($i+1).'" data-scroll-indicator-title="'.$title.'"></div></div>';
			echo '<div class="content">';
			echo '<h1 class="title">'.$title.'</h1>';
			echo '<div class="slider">';
			echo '<div class="slider-container">';
			for($j=0;$j<sizeof($value);$j++){
				$itemid = $value[$j];
				// debug_to_console($itemid);
				$idata 	= fetchItemData($itemid);
				// echo '<div><div class="scroll-indicator" id="section0'.($i+1).'" data-scroll-indicator-title="'.$idata['title'].'"></div></div>';        
				// echo htmlItem('',1,$idata,'itemcontent');
				echo itemSlider($idata);
			}
			echo '</div>';
			echo '<div class="prev" onclick="prev()">&lt;</div>';
        	echo '<div class="next" onclick="next()">&gt;</div>';
			echo '</div>';
			echo '</div>';
		}
		else if(is_string($value)) {
			echo '<div><div class="scroll-indicator" id="section'.($i+1).'" data-scroll-indicator-title="'.$title.'"></div></div>';
            echo '<div class="content"><h1 class="title">'.$title.'</h1>';
            echo '<div style="text-align: center;">';
            echo $value;
            echo '</div></div>';
        }
		else {
			$idata 	= fetchItemData($value);
			echo '<div><div class="scroll-indicator" id="section'.($i+1).'" data-scroll-indicator-title="'.$title.'"></div></div>';
			echo '<div class="content">';
			echo htmlItem('',1,$idata);
			echo '</div>';
		}
	}
?>
	<!-- slider script -->
	<script>
		var slider = document.querySelector('.slider-container');
		var index = 0;
		var length = document.querySelectorAll('.item').length;

		function next() {
			if (index < length - 3) {
			index++;
			}
			slider.style.transition = 'transform 0.4s ease-in-out';
			slider.style.transform = 'translateX(-'+ 340 * index + 'px)';
		}

		function prev() {
			if (index > 0) {
				index--;
			} 
			slider.style.transition = 'transform 0.4s ease-in-out';
			slider.style.transform = 'translateX(-' + 340 * index + 'px)';
		}
	</script>

<?php
	for($i=0;$i<$ni;$i++){
		if(is_array($d['items'][$i]['value'])) {
			$value = $d['items'][$i]['value'];
			echo '<div class="details">';
			for($j=0;$j<sizeof($value);$j++){
				$itemid = $value[$j];
				// debug_to_console($itemid);
				$idata 	= fetchItemData($itemid);
				// echo '<div><div class="scroll-indicator" id="section0'.($i+1).'" data-scroll-indicator-title="'.$idata['title'].'"></div></div>';        
				// echo htmlItem('',1,$idata,'itemcontent');
				echo itemDetails($idata);
			}
			echo '<div class="prev" onclick="prevDetail()">&lt;</div>';
        	echo '<div class="next" onclick="nextDetail()">&gt;</div>';
			echo '</div>';
		}
	}
?>
	<!-- detail script -->
	<script>
		var detailIndex;
		function showDetails(element) {
			document.querySelector(".details").style.display = "block";
			var items = document.querySelectorAll('.item');	
			console.log(items);
			for (let i = 0; i < items.length; i++) {
				if (items[i] == element) {
					detailIndex = i;
					show(detailIndex);
				}
			}
		}

		function nextDetail() {
			if (detailIndex < length - 1) {
			detailIndex++;
			}
			console.log(detailIndex);
			show(detailIndex);
		}

		function prevDetail() {
			if (detailIndex > 0) {
			detailIndex--;
			}
			console.log(detailIndex);
			show(detailIndex);
		}

		function show(n) {
			var details = document.querySelectorAll(".detailContainer");
			for (let i = 0; i < details.length; i++) {
				if (i == n) {
					details[i].style.display = "block";
				} else {
					details[i].style.display = "none";
				}
			}
		}

		window.onscroll = function() {scrollFunction()};

		function scrollFunction() {
		if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400) {
			document.getElementById("navbar").style.backgroundColor = "#ffc107";
		} else {
			document.getElementById("navbar").style.backgroundColor = "transparent";
		}
		}
	</script>
    </div>
  </div>
<!--Easy Scroll Dots js-->
<script>function dotsThrottle(t,e,o){let n,i,d,l=null,c=0;o||(o={});const s=function(){c=!1===o.leading?0:Date.now(),l=null,d=t.apply(n,i),l||(n=i=null)};return function(){const a=Date.now();c||!1!==o.leading||(c=a);const r=e-(a-c);return n=this,i=arguments,r<=0||r>e?(l&&(clearTimeout(l),l=null),c=a,d=t.apply(n,i),l||(n=i=null)):l||!1===o.trailing||(l=setTimeout(s,r)),d}}let dotFixedNavPresent=!1,dotFixedNavId="",dotFixedNavUp=!1,dotOffset=0;function easyScrollDots(t){let e=document.querySelectorAll(".scroll-indicator");if(!0===t.fixedNav&&(dotFixedNavPresent=!0),dotFixedNavId=""!==t.fixedNavId&&t.fixedNavId,!0===t.fixedNavUpward&&(dotFixedNavUp=!0),t.offset>0&&(dotOffset=t.offset),e.length){const t='<div class="scroll-indicator-controller"><span></span></div>';document.querySelector("body").lastElementChild.insertAdjacentHTML("afterend",t);const o=document.querySelector(".scroll-indicator-controller");void 0===window.orientation&&-1===navigator.userAgent.indexOf("IEMobile")||o.classList.add("indi-mobile");const n=Array.prototype.slice.call(e);n.forEach(function(t,e){const n=t.getAttribute("id"),i=t.getAttribute("data-scroll-indicator-title");let d="";0==e&&(d="active"),o.lastElementChild.insertAdjacentHTML("afterend",'<div class="'+d+'" data-indi-controller-id="'+n+'" onclick="scrollIndiClicked(\''+n+"');\"><span>"+i+"</span><div></div></div>")});const i=o.querySelectorAll("[data-indi-controller-id]"),d=dotsThrottle(function(){let t={};n.forEach(function(e){const o=e.getAttribute("id"),n=e.getBoundingClientRect().top;t[o]=n});const e=Object.keys(t).map(function(e){return t[e]});Object.keys(t).forEach(function(n){t[n]==function(){const t=e.filter(function(t){return t>-150});return Math.min.apply(null,t)}()&&(Array.prototype.forEach.call(i,function(t){t.classList.contains("active")&&t.classList.remove("active")}),o.querySelector('[data-indi-controller-id="'+n+'"]').classList.add("active"))})},300);window.addEventListener("scroll",d)}}function scrollIndiClicked(t){if(window.jQuery){const e=$("html, body");if(!0===dotFixedNavPresent&&dotFixedNavId.length){const o=document.getElementById(dotFixedNavId).clientHeight,n=$("#"+t);if(!0===dotFixedNavUp){e.animate({scrollTop:n.offset().top-dotOffset},700);const t=document.body.getBoundingClientRect().top;setTimeout(function(){document.body.getBoundingClientRect().top>t&&e.animate({scrollTop:n.offset().top-o-dotOffset},400)},400)}else e.animate({scrollTop:n.offset().top-o-dotOffset},700)}else e.animate({scrollTop:$("#"+t).offset().top-dotOffset},700)}else if(!0===dotFixedNavPresent&&dotFixedNavId.length){const e=document.getElementById(dotFixedNavId).clientHeight,o=document.getElementById(t);if(!0===dotFixedNavUp){window.scrollTo({top:o.offsetTop-dotOffset,left:0,behavior:"smooth"});const t=document.body.getBoundingClientRect().top;setTimeout(function(){document.body.getBoundingClientRect().top>t&&window.scrollTo({top:o.offsetTop-e-dotOffset,left:0,behavior:"smooth"})},400)}else window.scrollTo({top:o.offsetTop-e-dotOffset,left:0,behavior:"smooth"})}else window.scrollTo({top:document.getElementById(t).offsetTop-dotOffset,left:0,behavior:"smooth"})}</script>
<!--Easy Scroll Dots init-->
<script>
easyScrollDots({
  'fixedNav': false,
  'fixedNavId': '',
  'fixedNavUpward': false,
  'offset': 0
});
</script>
</body>
</html>
