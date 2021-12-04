<?php
	require_once('../lib/functions.php');
	$d = initializeApp('streamline');	
	$ni = sizeof($d['places']);
	$places = $d['places'];	
?>

<!DOCTYPE html>
<html lang="vi">
    <head>
        <title>HaNoiTrip</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="logo.png" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css?ver=25">
        <link rel="stylesheet" href="showOff.css?ver=26">
        <style>
            .map {
                background-image: url(<?php echo $d["map"]?>);
            }
        </style>
    </head>
    <body>
        <div class="frame">
            <div class="corner_topleft"></div>
            <div class="corner_topright"></div>
            <div class="corner_bottomleft"></div>
            <div class="corner_bottomright"></div>
            
            
            <div class="camera">
                <div class="map pixel-art">
                    <?php
                        for($i=0; $i < $ni; $i++) {
                            $title = $places[$i]['title'];
                            $data = fetchItemData($places[$i]['imgRPG']);
                            $imgRPG = $data['url_full'];
                            $x = $places[$i]['x'];
                            $y = $places[$i]['y'];

                            echo '<div class="place" 
                                    x='.$x.'
                                    y='.$y.'
                                    title="'.$title.'"
                                    id="'.$i.'">
                                    <img src="'.$imgRPG.'"/>
                                </div>';
                        }
                    ?>
                    <div class="character" facing="down" walking="true" position>
                        <div class="shadow pixel-art"></div>  
                        <div class="character_spritesheet pixel-art"></div>
                    </div>
                    <div class="popover-content d-grid gap-2">
                        <h4 id="destinationInfo"></h4>
                        <button id="infoButton" class="btn btn-warning btn-block" name onclick="showOff(this.name);">Khám phá</button>
                    </div> 
                    <div class="text">        
                        <svg class="corner" viewBox="0 0 65 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M35 3.5L65 6.5V62L0 0L35 3.5Z" fill="white"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            for($k=0;$k<sizeof($d['places']);$k++) {
                echo '<div class = "showOff">';
                echo '<div class = "showOffHeader">';
                echo '<h1 style = "margin-left:20px; padding-top: 10px;">'.$d['places'][$k]['title'].'</h1>';
                echo '<div class="closeShowOff" style="position: absolute; right: 20px; top: 18px; width: 40px; height: 40px; border-radius: 10px;" onclick="closeShowOff()"><svg style="padding-top: 10px; padding-left: 10px;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                </svg></div></div>';
                echo '<div class = "showOffContainer">';
                echo '<p style="font-size:20px; padding-top: 30px; width: 72vw; margin: auto">'.$d['places'][$k]['desc'].'</p>';
                for($i=0;$i<sizeof($d['places'][$k]['items']);$i++){
                    $title = $d['places'][$k]['items'][$i]['title'];
                    $value = $d['places'][$k]['items'][$i]['value'];
                    if(is_array($value)) {
                        echo '<h3 class="title" style="margin-top: 20px; margin-left: 20px"><span>'.$title.'</span></h3>';
                        echo '<div class="slider">';
                        echo '<div class="slider-container">';
                        for($j=0;$j<sizeof($value);$j++){
                            $itemid = $value[$j];
                            $idata 	= fetchItemData($itemid);
                            echo itemSlider($idata, $k);
                        }
                        echo '</div>';
                        echo '<div class="prev" onclick="prev('.$k.')">&lt;</div>';
                        echo '<div class="next" onclick="next('.$k.')">&gt;</div>';
                        echo '</div>';
                    }
                    // else if(is_string($value)) {
                    //     echo '<div class="content container-fluid" style="margin-top: 60px;"><h3 class="title"><span>'.$title.'</span></h3>';
                    //     echo '<div style="text-align: center;">';
                    //     echo $value;
                    //     echo '</div></div>';
                    // }
                    else {
                        $idata 	= fetchItemData($value);
                        echo '<div class="content container" style="margin-top: 40px;">';
                        echo htmlItem('',1,$idata);
                        echo '</div>';
                    }
                }
                echo '</div>';
                echo '</div>';
            }
        ?>

        <script src="script.js?ver=28"></script>
        <script src="text.js?ver=1"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function ( popoverTrigger ) {
                return new bootstrap.Popover(popoverTrigger)
            });      
        </script>

        <script>
            function showOff(n) {
                showOffs = document.querySelectorAll('.showOff');
                for (let i = 0; i < showOffs.length; i++) {
                    if (i == parseInt(n)) {
                        showOffs[i].style.display = 'block';
                    } else {
                        showOffs[i].style.display = 'none';
                    }
                }
            }
            function closeShowOff() {
                showOffs = document.querySelectorAll('.showOff');
                for (let i = 0; i < showOffs.length; i++) {
                    showOffs[i].style.display = 'none';
                }
            }
        </script>
        <!-- slider script -->
        <script>
            var sliderIndex = 0;
            var sliders = document.querySelectorAll('.slider-container');
            function next(k) {
                var length = sliders[k].getElementsByTagName('div').length;
                console.log(length);
                if (sliderIndex < length - 3) {
                    sliderIndex++;
                } else {
                    sliderIndex = 0;
                }
                sliders[k].style.transition = 'transform 0.4s ease-in-out';
                sliders[k].style.transform = 'translateX(-'+ 340 * sliderIndex + 'px)';
            }

            function prev(k) {
                var length = sliders[k].getElementsByTagName('div').length;
                console.log(sliders);
                if (sliderIndex > 0) {
                    sliderIndex--;
                } else {
                    sliderIndex = length - 3;
                }
                sliders[k].style.transition = 'transform 0.4s ease-in-out';
                sliders[k].style.transform = 'translateX(-' + 340 * sliderIndex + 'px)';
            }
        </script>

        <?php
            for($k=0;$k<sizeof($d['places']);$k++) {
                for($i=0;$i<$ni;$i++){
                    if(is_array($d['places'][$k]['items'][$i]['value'])) {
                        $value = $d['places'][$k]['items'][$i]['value'];
                        echo '<div class="details">';
                        for($j=0;$j<sizeof($value);$j++){
                            $itemid = $value[$j];
                            $idata 	= fetchItemData($itemid);
                            echo itemDetails($idata);
                        }
                        echo '<div id="closeDetails" onclick="closeDetails()"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                        <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                        </svg></div>';
                        echo '<div class="prev" onclick="prevDetail('.$k.')" style= "left: 100px">&lt;</div>';
                        echo '<div class="next" onclick="nextDetail('.$k.')" style= "right: 100px">&gt;</div>';
                        echo '</div>';
                    }
                }
            }
        ?>
        <!-- detail script -->
        <script>
            var detailIndex;
            function showDetails(element, k) {
                var detailWindow = document.querySelectorAll(".details")[k];
                detailWindow.style.display = "block";
                var items = sliders[k].getElementsByClassName("item");;
                for (let i = 0; i < items.length; i++) {
                    if (items[i] == element) {
                        detailIndex = i;
                        show(detailIndex, k);
                    }
                }
            }

            function nextDetail(k) {
                if (detailIndex == length - 1) {
                    detailIndex = 0;
                }else if (detailIndex < length - 1) {
                detailIndex++;
                }
                console.log(detailIndex);
                show(detailIndex, k);
            }

            function prevDetail(k) {
                if (detailIndex > 0) {
                detailIndex--;
                }else if (detailIndex == 0) {
                    detailIndex = length - 1;
                }
                console.log(detailIndex);
                show(detailIndex, k);
            }

            function show(n, k) {
                var detailWindow = document.querySelectorAll(".details")[k];
                var details = detailWindow.getElementsByClassName("detailContainer");
                for (let i = 0; i < details.length; i++) {
                    if (i == n) {
                        details[i].style.display = "block";
                    } else {
                        details[i].style.display = "none";
                    }
                }
            }

            function closeDetails() {
                var detailWindows = document.querySelectorAll(".details");
                for (let i = 0; i < detailWindows.length; i++) {
                    detailWindows[i].style.display = "none";
                }
            }
        </script>

        
    </body>
</html>