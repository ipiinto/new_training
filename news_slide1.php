<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div id="sliderFrame">
        <div id="slider">
            <a href="aboutme.php" target="_blank">
                <img src="images/slide-1.jpg" />
            </a>
            <!--<a class="lazyImage" href="images/slide-2.jpg" title="หลักสูตรที่เปิดสอนทั้งหมด..">Pure JavaScript</a>-->
            <a href="list_course.php">
            	<img src="images/slide-2.jpg" title="หลักสูตรที่เปิดสอนทั้งหมด.."/>
            </a>
            
        </div>
        <!--thumbnails-->
        <div id="thumbs">
            <div class="thumb">
                <div class="frame"><img src="images/thumb-1.jpg" /></div>
                <div class="thumb-content">
                  <p>รู้จักกันหน่อย..</p>
                  โรงเรียนกวดวิชาวิชญา (ครูแป้ม)</div>
                <div style="clear:both;"></div>
            </div>
            <div class="thumb">
                <div class="frame"><img src="images/thumb2.jpg" /></div>
                <div class="thumb-content"><p><a href="list_course.php">หลักสูตรที่เปิดสอน</a></p>
              หลักสูตร/รายวิชาทั้งหมด ที่เปิดสอน</div>
                <div style="clear:both;"></div>
            </div>
        </div>
        <!--clear above float:left elements. It is required if above #slider is styled as float:left. -->
        <div style="clear:both;height:0;"></div>
    </div>

</body>
</html>
