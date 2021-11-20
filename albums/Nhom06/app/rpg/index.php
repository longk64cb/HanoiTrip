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
        <link rel="stylesheet" href="style.css?ver=23">
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
        

        
            <!-- <div class="dpad">
                <div class="DemoDirectionUI flex-center">
                        <button class="dpad-button dpad-left">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -0.5 13 13" shape-rendering="crispEdges">
                                <path class="Arrow_outline-top"  stroke="#5f5f5f" d="M1 0h11M0 1h1M12 1h1M0 2h1M12 2h1M0 3h1M12 3h1M0 4h1M12 4h1M0 5h1M12 5h1M0 6h1M12 6h1M0 7h1M12 7h1M0 8h1M12 8h1" />
                                <path class="Arrow_surface" stroke="#f5f5f5" d="M1 1h11M1 2h11M1 3h5M7 3h5M1 4h4M7 4h5M1 5h3M7 5h5M1 6h4M7 6h5M1 7h5M7 7h5M1 8h11" />
                                <path class="Arrow_arrow-inset"  stroke="#434343" d="M6 3h1M5 4h1M4 5h1" />
                                <path class="Arrow_arrow-body" stroke="#5f5f5f" d="M6 4h1M5 5h2M5 6h2M6 7h1" />
                                <path class="Arrow_outline-bottom" stroke="#434343" d="M0 9h1M12 9h1M0 10h1M12 10h1M0 11h1M12 11h1M1 12h11" />
                                <path class="Arrow_edge" stroke="#ffffff" d="M1 9h11" />
                                <path class="Arrow_front" stroke="#cccccc" d="M1 10h11M1 11h11" />
                            </svg>
                        </button>
                        <button class="dpad-button dpad-up">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -0.5 13 13" shape-rendering="crispEdges">
                                <path class="Arrow_outline-top"  stroke="#5f5f5f" d="M1 0h11M0 1h1M12 1h1M0 2h1M12 2h1M0 3h1M12 3h1M0 4h1M12 4h1M0 5h1M12 5h1M0 6h1M12 6h1M0 7h1M12 7h1M0 8h1M12 8h1" />
                                <path class="Arrow_surface" stroke="#f5f5f5" d="M1 1h11M1 2h11M1 3h11M1 4h5M7 4h5M1 5h4M8 5h4M1 6h3M9 6h3M1 7h11M1 8h11" />
                                <path class="Arrow_arrow-inset"  stroke="#434343" d="M6 4h1M5 5h1M7 5h1" />
                                <path class="Arrow_arrow-body" stroke="#5f5f5f" d="M6 5h1M4 6h5" />
                                <path class="Arrow_outline-bottom" stroke="#434343" d="M0 9h1M12 9h1M0 10h1M12 10h1M0 11h1M12 11h1M1 12h11" />
                                <path class="Arrow_edge" stroke="#ffffff" d="M1 9h11" />
                                <path class="Arrow_front" stroke="#cccccc" d="M1 10h11M1 11h11" />
                            </svg>
                        </button>
                        <button class="dpad-button dpad-down">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -0.5 13 13" shape-rendering="crispEdges">
                                <path class="Arrow_outline-top" stroke="#5f5f5f" d="M1 0h11M0 1h1M12 1h1M0 2h1M12 2h1M0 3h1M12 3h1M0 4h1M12 4h1M0 5h1M12 5h1M0 6h1M12 6h1M0 7h1M12 7h1M0 8h1M12 8h1" />
                                <path class="Arrow_surface" stroke="#f5f5f5" d="M1 1h11M1 2h11M1 3h11M1 4h3M9 4h3M1 5h4M8 5h4M1 6h5M7 6h5M1 7h11M1 8h11" />
                                <path class="Arrow_arrow-inset" stroke="#434343" d="M4 4h5" />
                                <path class="Arrow_arrow-body" stroke="#5f5f5f" d="M5 5h3M6 6h1" />
                                <path class="Arrow_outline-bottom" stroke="#434343" d="M0 9h1M12 9h1M0 10h1M12 10h1M0 11h1M12 11h1M1 12h11" />
                                <path class="Arrow_edge" stroke="#ffffff" d="M1 9h11" />
                                <path class="Arrow_front" stroke="#cccccc" d="M1 10h11M1 11h11" />
                            </svg>
                        </button>
                        <button class="dpad-button dpad-right">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -0.5 13 13" shape-rendering="crispEdges">
                                <path class="Arrow_outline-top"  stroke="#5f5f5f" d="M1 0h11M0 1h1M12 1h1M0 2h1M12 2h1M0 3h1M12 3h1M0 4h1M12 4h1M0 5h1M12 5h1M0 6h1M12 6h1M0 7h1M12 7h1M0 8h1M12 8h1" />
                                <path class="Arrow_surface" stroke="#f5f5f5" d="M1 1h11M1 2h11M1 3h5M7 3h5M1 4h5M8 4h4M1 5h5M9 5h3M1 6h5M8 6h4M1 7h5M7 7h5M1 8h11" />
                                <path class="Arrow_arrow-inset"  stroke="#434343" d="M6 3h1M7 4h1M8 5h1" />
                                <path class="Arrow_arrow-body" stroke="#5f5f5f" d="M6 4h1M6 5h2M6 6h2M6 7h1" />
                                <path class="Arrow_outline-bottom" stroke="#434343" d="M0 9h1M12 9h1M0 10h1M12 10h1M0 11h1M12 11h1M1 12h11" />
                                <path class="Arrow_edge" stroke="#ffffff" d="M1 9h11" />
                                <path class="Arrow_front" stroke="#cccccc" d="M1 10h11M1 11h11" />
                            </svg>
                        </button>
                    </div>
            </div> -->
            
            
            <!-- <svg class="headline" xmlns="http://www.w3.org/2000/svg" viewBox="0 -0.5 75 14" shape-rendering="crispEdges">
        <metadata>Made with Pixels to Svg https://codepen.io/shshaw/pen/XbxvNj</metadata>
        <path stroke="rgba(128,191,255,0.01568627450980392)" d="M0 0h1M74 0h1M0 13h1M74 13h1" />
        <path stroke="#5f5f5f" d="M1 0h73M0 1h1M74 1h1M0 2h1M74 2h1M0 3h1M74 3h1M0 4h1M74 4h1M0 5h1M74 5h1M0 6h1M74 6h1M0 7h1M74 7h1M0 8h1M74 8h1M0 9h1M74 9h1M0 10h1M74 10h1M0 11h1M74 11h1" />
        <path stroke="#f5f5f5" d="M1 1h73M1 2h73M1 3h3M7 3h12M21 3h22M45 3h29M1 4h4M6 4h13M20 4h1M22 4h20M43 4h2M46 4h28M1 5h4M6 5h2M10 5h2M15 5h4M20 5h2M23 5h2M27 5h2M30 5h1M32 5h1M34 5h1M38 5h4M43 5h5M50 5h2M56 5h3M61 5h3M66 5h1M69 5h5M1 6h4M6 6h1M8 6h2M11 6h1M13 6h2M16 6h3M20 6h2M23 6h1M25 6h2M28 6h1M30 6h1M32 6h1M34 6h1M36 6h2M39 6h3M43 6h7M51 6h1M53 6h1M55 6h1M57 6h1M59 6h2M62 6h1M64 6h5M70 6h4M1 7h4M6 7h1M8 7h2M11 7h1M13 7h2M16 7h3M20 7h2M23 7h1M25 7h2M28 7h1M30 7h1M32 7h1M34 7h1M36 7h2M39 7h3M43 7h5M51 7h1M53 7h1M55 7h1M57 7h1M62 7h1M64 7h3M70 7h4M1 8h4M6 8h1M8 8h2M11 8h1M13 8h2M16 8h3M20 8h1M22 8h2M25 8h2M28 8h1M30 8h1M32 8h1M34 8h1M36 8h2M39 8h3M43 8h2M46 8h1M48 8h2M51 8h1M53 8h1M55 8h1M57 8h1M59 8h4M64 8h2M67 8h2M70 8h4M1 9h4M6 9h2M10 9h2M15 9h4M21 9h4M27 9h3M34 9h1M36 9h2M39 9h4M45 9h3M51 9h1M53 9h1M55 9h1M57 9h2M62 9h1M64 9h3M70 9h4M1 10h11M13 10h61M1 11h11M13 11h61" />
        <path stroke="#323234" d="M4 3h3M19 3h2M43 3h2M5 4h1M19 4h1M21 4h1M42 4h1M45 4h1M5 5h1M8 5h2M12 5h3M19 5h1M22 5h1M25 5h2M29 5h1M31 5h1M33 5h1M35 5h3M42 5h1M48 5h2M52 5h4M59 5h2M64 5h2M67 5h2M5 6h1M7 6h1M10 6h1M12 6h1M15 6h1M19 6h1M22 6h1M24 6h1M27 6h1M29 6h1M31 6h1M33 6h1M35 6h1M38 6h1M42 6h1M50 6h1M52 6h1M54 6h1M56 6h1M58 6h1M61 6h1M63 6h1M69 6h1M5 7h1M7 7h1M10 7h1M12 7h1M15 7h1M19 7h1M22 7h1M24 7h1M27 7h1M29 7h1M31 7h1M33 7h1M35 7h1M38 7h1M42 7h1M48 7h3M52 7h1M54 7h1M56 7h1M58 7h4M63 7h1M67 7h3M5 8h1M7 8h1M10 8h1M12 8h1M15 8h1M19 8h1M21 8h1M24 8h1M27 8h1M29 8h1M31 8h1M33 8h1M35 8h1M38 8h1M42 8h1M45 8h1M47 8h1M50 8h1M52 8h1M54 8h1M56 8h1M58 8h1M63 8h1M66 8h1M69 8h1M5 9h1M8 9h2M12 9h3M19 9h2M25 9h2M30 9h4M35 9h1M38 9h1M43 9h2M48 9h3M52 9h1M54 9h1M56 9h1M59 9h3M63 9h1M67 9h3M12 10h1M12 11h1" />
        <path stroke="#434343" d="M0 12h1M74 12h1M1 13h73" />
        <path stroke="#cccccc" d="M1 12h73" />
        </svg> -->
            
        </div>
        
        <?php
            for($k=0;$k<sizeof($d['places']);$k++) {
                echo '<div class = "showOff" style="z-index:10; position: fixed; top: 5vh; left: 10vw; display: none; width: 80vw; height: 90vh; overflow: scroll; background-color: white; margin: auto;">';
                echo '<div id="closeShowOff" style="position: absolute; right: 20px; top: 20px;" onclick="closeShowOff()"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                </svg></div>';
                for($i=0;$i<sizeof($d['places'][$k]['items']);$i++){
                    $title = $d['places'][$k]['items'][$i]['title'];
                    $value = $d['places'][$k]['items'][$i]['value'];
                    if(is_array($value)) {
                        echo '<h1 class="title" style="margin-top: 20px; margin-left: 20px"><span>'.$title.'</span></h1>';
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
                    else if(is_string($value)) {
                        echo '<div class="content container-fluid" style="margin-top: 60px;"><h1 class="title"><span>'.$title.'</span></h1>';
                        echo '<div style="text-align: center;">';
                        echo $value;
                        echo '</div></div>';
                    }
                    else {
                        $idata 	= fetchItemData($value);
                        echo '<div class="content container" style="margin-top: 40px;">';
                        echo htmlItem('',1,$idata);
                        echo '</div>';
                    }
                }
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