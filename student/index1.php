<?php
  session_start();
  
  include('../config/config.php');
  mysql_connect($host,$hostuser,$hostpass);
  mysql_query("SET NAMES UTF8");
  
  if($_SESSION["login"]==""){
    echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
    exit();
  }
?>
<html lang="en">
  <meta charset="UTF-8">
  <title><?php echo $ribbon;?></title>
   <link rel="stylesheet" type="text/css" href="../bootstrap-3.2.0-dist/css/bootstrap.css">
    <script type="text/javascript" src="../style.css"></script>
    <script src="../jquery/jquery-2.1.3.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <?php
    if(isset($_SESSION['id'])==""){
  ?>
    <nav class="navbar navbar-default navbar-fixed-top">
       <div class="navbar-header">
          <button class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#id_nav1"
          >
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index1.php">
            <div class="logo-xs visible-xs"></div>
            <div class="logo-lg hidden-xs"></div>
          </a>
       </div>
       <div class="collapse navbar-collapse navbar-ex1-collapse" id="id_nav1">
          <ul class="nav navbar-nav">
            <li><a href="index1.php">หน้าหลัก</a></li>
            <li><a href="registered.php">สมัครสมาชิก</a></li>
            <li><a href="howto-regis.php">การสมัครเรียน</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <label>Username</label>
              <input name="username" type="text" class="form-control input-sm" id="username" placeholder="กรอกชื่อผู้ใช้"  />
            </div>
            <div class="form-group">
              <label>Password</label>
              <input name="pass" type="password" class="form-control input-sm" id="pass" placeholder="รหัสผ่าน"  />
            </div>
            <button class="btn btn-primary btn-sm" type="button" >เข้าสู่ระบบ</button>
          </form>   
       </div>
    </nav>
  <?php
    }else{
  ?>
    <nav class="navbar navbar-default navbar-fixed-top">
       <div class="navbar-header">
          <button class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#id_nav1"
          >
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index1.php">
            <div class="logo-xs visible-xs"></div>
            <div class="logo-lg hidden-xs"></div>
          </a>
       </div>
       <div class="collapse navbar-collapse navbar-ex1-collapse" id="id_nav1">
          <ul class="nav navbar-nav">
            <li><a href="index1.php">หน้าหลัก</a></li>
            <li><a href="list_course.php">รายวิชาที่เปิดสอน</a></li>
            <li><a href="schedule.php">ตารางเรียน</a></li>
            <li><a href="../forum/forum.php">กระดานถามตอบ</a></li>
          </ul>
          <ul class="nav navbar-right">
          	<?php
              $sql="select * from member where username='".$_SESSION['login']."'";
              $result=mysql_db_query($database,$sql);
              $rows=mysql_fetch_array($result);
            ?>
            <li class="dropdown" style="margin-top:1px" style="margin-right:15px">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                  if($rows['fileupload']!=''){
                ?>
                    <img src="../images/profile/<?=$rows['fileupload'];?>" class="profile-image img-rounded"  >&nbsp;&nbsp;<?=$rows['username'];?> <span class="caret"></span>
                <?php
                  }else{
                ?>
                    <img src="../images/avatar.jpg" class="profile-image img-rounded"  >&nbsp;&nbsp;<?=$rows['username'];?> <span class="caret"></span>
                <?php
                
                  }
                ?>
              </a>
              <ul class="dropdown-menu">
                <li sytle="width:100px"><a href="change_pwd.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;เปลี่ยนรหัสผ่าน</a></li>
                <li><a href="edit_profile.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;แก้ไขข้อมูลส่วนตัว</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;ออกจากระบบ</a></li>
              </ul>
            </li> 
          </ul>   
       </div>
    </nav>
    <br><br><br><br>
  <?php
    }
    // include('../news_slide.php');
    include('../slide_news.php');
  ?>
