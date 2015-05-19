<?php
    session_start();
    include('config/config.php');
    mysql_connect($host,$hostuser,$hostpass);
    mysql_query("SET NAMES UTF8");
    $sql=mysql_db_query($database,"select * from news  where banner !='' order by news_id ") or die(mysql_error());
    //echo $sql;
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Untitled Document</title>
        <?php
            if(isset($_SESSION['id'])==""){
        ?>
                <link href="style.css" rel="stylesheet" type="text/css">
                <link href="themes/6/js-image-slider.css" rel="stylesheet" type="text/css" />
                <script src="themes/6/mcVideoPlugin.js" type="text/javascript"></script>
                <script src="themes/6/js-image-slider.js" type="text/javascript"></script>
                <link href="generic.css" rel="stylesheet" type="text/css" />
        <?php
            }else{
        ?>
                <link href="../style.css" rel="stylesheet" type="text/css">
                <link href="../themes/6/js-image-slider.css" rel="stylesheet" type="text/css" />
                <script src="../themes/6/mcVideoPlugin.js" type="text/javascript"></script>
                <script src="../themes/6/js-image-slider.js" type="text/javascript"></script>
                <link href="../generic.css" rel="stylesheet" type="text/css" />
        <?php
            }
        ?>           
    </head>
    <body>
    	<div id="sliderFrame">
            <div id="slider">

                <?php
                    while($row=mysql_fetch_array($sql)){
                        if($row['news_type']=="0"){
                            $link="/new_training/list_course.php";
                        }elseif($row['news_type']=="1") {
                            $link="news_content.php?news_id=$row[0]";
                        }elseif($row['news_type']=="2") {
                            $link="news_content.php?news_id=$row[0]";
                        }else {
                            $link=$row['news_type'];
                        }                  
                ?>
                        <a href="<?php echo $link; ?>" target="_blank" >
                            <?php
                                if(isset($_SESSION['id'])==""){
                            ?>
                                    <img class="img-responsive" style='width:700;' height='306' src="images/banner/<?=$row['banner'];?>">
                            <?php
                                }else{
                            ?> 
                                    <img class="img-responsive" style='width:700;' height='306' src="../images/banner/<?=$row['banner'];?>">
                            <?php
                                }
                            ?>
                        </a>
                <?php
                    }
                ?>
            </div>
        </div>
    </body>
</html>