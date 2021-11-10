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
<link rel="stylesheet" href="scroll_indicator.css" />
<link rel="stylesheet" href="styles.css"/>
<style>
	#home {
		background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(
			<?php 
				$idata 	= fetchItemData($d['imgFront']);
				echo $idata['url_full'];
			?>
		) no-repeat center center fixed;
		display: table;
		height: 500px;
		width: 100%;
		position: relative;
		background-size: cover ;
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
	<div><div class="scroll-indicator" id="sectionDesc" data-scroll-indicator-title="Giới thiệu"></div></div>

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
			echo '<hr><div><div class="scroll-indicator" id="section'.($i+1).'" data-scroll-indicator-title="'.$title.'"></div></div>';
			echo '<div class="content container">';
			echo '<h1 class="title"><span>'.$title.'</span></h1>';
			echo '<div class="slider">';
			echo '<div class="slider-container">';
			for($j=0;$j<sizeof($value);$j++){
				$itemid = $value[$j];
				$idata 	= fetchItemData($itemid);
				echo itemSlider($idata);
			}
			echo '</div>';
			echo '<div class="prev" onclick="prev()">&lt;</div>';
        	echo '<div class="next" onclick="next()">&gt;</div>';
			echo '</div>';
			echo '</div>';
		}
		else if(is_string($value)) {
			echo '<hr><div><div class="scroll-indicator" id="section'.($i+1).'" data-scroll-indicator-title="'.$title.'"></div></div>';
            echo '<div class="content container-fluid"><h1 class="title"><span>'.$title.'</span></h1>';
            echo '<div style="text-align: center;">';
            echo $value;
            echo '</div></div>';
        }
		else {
			$idata 	= fetchItemData($value);
			echo '<hr><div><div class="scroll-indicator" id="section'.($i+1).'" data-scroll-indicator-title="'.$title.'"></div></div>';
			echo '<div class="content container">';
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
			} else {
				index = 0;
			}
			slider.style.transition = 'transform 0.4s ease-in-out';
			slider.style.transform = 'translateX(-'+ 340 * index + 'px)';
		}

		function prev() {
			if (index > 0) {
				index--;
			} else {
				index = length - 3;
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
				$idata 	= fetchItemData($itemid);
				echo itemDetails($idata);
			}
			echo '<div id="closeDetails" onclick="closeDetails()"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
			<path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
		  </svg></div>';
			echo '<div class="prev" onclick="prevDetail()" style= "left: 100px">&lt;</div>';
        	echo '<div class="next" onclick="nextDetail()" style= "right: 100px">&gt;</div>';
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
			console.log(length);
			for (let i = 0; i < items.length; i++) {
				if (items[i] == element) {
					detailIndex = i;
					show(detailIndex);
				}
			}
		}

		function nextDetail() {
			if (detailIndex == length - 1) {
				detailIndex = 0;
			}else if (detailIndex < length - 1) {
			detailIndex++;
			}
			console.log(detailIndex);
			show(detailIndex);
		}

		function prevDetail() {
			if (detailIndex > 0) {
			detailIndex--;
			}else if (detailIndex == 0) {
				detailIndex = length - 1;
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

		function closeDetails() {
			document.querySelector(".details").style.display = "none";
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
<script>
	function dotsThrottle(t, e, o) {
    let n, i, d, l = null,
        c = 0;
    o || (o = {});
    const s = function() {
        c = !1 === o.leading ? 0 : Date.now(), l = null, d = t.apply(n, i), l || (n = i = null)
    };
    return function() {
        const a = Date.now();
        c || !1 !== o.leading || (c = a);
        const r = e - (a - c);
        return n = this, i = arguments, r <= 0 || r > e ? (l && (clearTimeout(l), l = null), c = a, d = t.apply(n, i), l || (n = i = null)) : l || !1 === o.trailing || (l = setTimeout(s, r)), d
    }
}
let dotFixedNavPresent = !1,
    dotFixedNavId = "",
    dotFixedNavUp = !1,
    dotOffset = 0;

function easyScrollDots(t) {
    let e = document.querySelectorAll(".scroll-indicator");
    if (!0 === t.fixedNav && (dotFixedNavPresent = !0), dotFixedNavId = "" !== t.fixedNavId && t.fixedNavId, !0 === t.fixedNavUpward && (dotFixedNavUp = !0), t.offset > 0 && (dotOffset = t.offset), e.length) {
        const t = '<div class="scroll-indicator-controller"><span></span></div>';
        document.querySelector("body").lastElementChild.insertAdjacentHTML("afterend", t);
        const o = document.querySelector(".scroll-indicator-controller");
        void 0 === window.orientation && -1 === navigator.userAgent.indexOf("IEMobile") || o.classList.add("indi-mobile");
        const n = Array.prototype.slice.call(e);
        n.forEach(function(t, e) {
            const n = t.getAttribute("id"),
                i = t.getAttribute("data-scroll-indicator-title");
            let d = "";
            0 == e && (d = "active"), o.lastElementChild.insertAdjacentHTML("afterend", '<div class="' + d + '" data-indi-controller-id="' + n + '" onclick="scrollIndiClicked(\'' + n + "');\"><div><div class='indicator_title'>" + i + "</div></div><div></div></div>")
        });
        const i = o.querySelectorAll("[data-indi-controller-id]"),
            d = dotsThrottle(function() {
                let t = {};
                n.forEach(function(e) {
                    const o = e.getAttribute("id"),
                        n = e.getBoundingClientRect().top;
                    t[o] = n
                });
                const e = Object.keys(t).map(function(e) {
                    return t[e]
                });
                Object.keys(t).forEach(function(n) {
                    t[n] == function() {
                        const t = e.filter(function(t) {
                            return t > -150
                        });
                        return Math.min.apply(null, t)
                    }() && (Array.prototype.forEach.call(i, function(t) {
                        t.classList.contains("active") && t.classList.remove("active")
                    }), o.querySelector('[data-indi-controller-id="' + n + '"]').classList.add("active"))
                })
            }, 300);
        window.addEventListener("scroll", d)
    }
}

function scrollIndiClicked(t) {
    if (window.jQuery) {
        const e = $("html, body");
        if (!0 === dotFixedNavPresent && dotFixedNavId.length) {
            const o = document.getElementById(dotFixedNavId).clientHeight,
                n = $("#" + t);
            if (!0 === dotFixedNavUp) {
                e.animate({
                    scrollTop: n.offset().top - dotOffset - 40
                }, 700);
                const t = document.body.getBoundingClientRect().top;
                setTimeout(function() {
                    document.body.getBoundingClientRect().top > t && e.animate({
                        scrollTop: n.offset().top - o - dotOffset - 40
                    }, 400)
                }, 400)
            } else e.animate({
                scrollTop: n.offset().top - o - dotOffset - 40
            }, 700)
        } else e.animate({
            scrollTop: $("#" + t).offset().top - dotOffset - 40
        }, 700)
    } else if (!0 === dotFixedNavPresent && dotFixedNavId.length) {
        const e = document.getElementById(dotFixedNavId).clientHeight,
            o = document.getElementById(t);
        if (!0 === dotFixedNavUp) {
            window.scrollTo({
                top: o.offsetTop - dotOffset,
                left: 0,
                behavior: "smooth"
            });
            const t = document.body.getBoundingClientRect().top;
            setTimeout(function() {
                document.body.getBoundingClientRect().top > t && window.scrollTo({
                    top: o.offsetTop - e - dotOffset,
                    left: 0,
                    behavior: "smooth"
                })
            }, 400)
        } else window.scrollTo({
            top: o.offsetTop - e - dotOffset,
            left: 0,
            behavior: "smooth"
        })
    } else window.scrollTo({
        top: document.getElementById(t).offsetTop - dotOffset,
        left: 0,
        behavior: "smooth"
    })
}
</script>
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
