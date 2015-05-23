<?php
    $sql=mysqli_query($dbcon,"select * from news  where banner !='' order by news_id ") or die(mysql_error());
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Untitled Document</title>
        <link href="../style.css" rel="stylesheet" type="text/css">
        <link href="../themes/6/js-image-slider.css" rel="stylesheet" type="text/css" />
        <script src="../themes/6/mcVideoPlugin.js" type="text/javascript"></script>
        <script src="../themes/6/js-image-slider.js" type="text/javascript"></script>
        <link href="../generic.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    	<div id="sliderFrame">
            <div id="slider">

                <?php
                    while($row=mysqli_fetch_array($sql)){
                        if($row['news_type']=="0"){
                            $link="../list_course.php";
                        }elseif($row['news_type']=="1") {
                            $link="news_content.php?news_id=$row[0]";
                        }elseif($row['news_type']=="2") {
                            $link="news_content.php?news_id=$row[0]";
                        }else {
                            $link=$row['news_type'];
                        }

                        if($st_login=1){
                ?>
                            <a href="<?=$link; ?>" target="_blank" >
                            	<img width='100%' height='306px' src="../images/banner/<?=$row['banner'];?>">
                                </a>
                            <!-- $img_dir='../images/banner/'; -->
                    <?php
                        }else{
                    ?>
                            <a href="<?=$link; ?>" target="_blank" >
                                <img width='100%' height='306px' src="/images/banner/<?=$row['banner'];?>">
                            </a>
                            <!-- $img_dir='/images/banner/'; -->
                <?php
                        } 
                    }                 
                ?>
<!--                         <a href="<?=$link; ?>" target="_blank" >
    <img width='100%' height='306px' src="<?=$img_dir; ?><?=$row['banner'];?>">
</a> -->
                <?php
                    }
                ?>
            </div>
        </div>
        <?php
           /* echo $_SESSION['login'];*/
       }
        ?>

    </body>
</html>