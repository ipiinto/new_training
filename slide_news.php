<?php
   $sql=mysql_db_query($database,"select * from news  where banner !='' order by news_id ") or die(mysql_error());
?>

    <nav class="container">
      <div class="carousel slide" data-ride="carousel" id="carousel-ex">
        <!-- <ol class="carousel-indicators">
          <li data-target="#carousel-ex" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-ex" data-slide-to="1"></li>
          <li data-target="#carousel-ex" data-slide-to="2"></li>
        </ol> -->
        <div class="carousel-inner">
            <div class="item active" align="center">
              <?php
                if(isset($_SESSION['id'])==""){
              ?>
                <img src="images/banner/Resize/Thumbnails_2015-03-31-slide-2.jpg" alt="image">
              <?php
                }else{
              ?>
                <img src="../images/banner/Resize/Thumbnails_2015-03-31-slide-2.jpg" alt="image">
              <?php
                }
              ?>
              <div class="carousel-caption">
              </div>
            </div>
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
          <div class="item" align="center">
            <a href="<?php echo $link; ?>" target="_blank" >
              <?php
                if(isset($_SESSION['id'])==""){
              ?>
                <img class="img-responsive" src="images/banner/Resize/Thumbnails_<?=$row['banner'];?>">
              <?php
                }else{
              ?>
                <img class="img-responsive" src="../images/banner/Resize/Thumbnails_<?=$row['banner'];?>">
              <?php
                }
              ?>
            </a>
            <div class="carousel-caption">
              <h2><?=$row['title_news'];?></h2>
            </div>
          </div>
          <?php
            }
          ?>
          <a href="#carousel-ex" class="left carousel-control" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a href="#carousel-ex" class="right carousel-control" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
      </div>
    </nav>

  <!-- Latest compiled and minified JavaScript -->
  
