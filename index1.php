<?php
    session_start();
    $_SESSION['login']="";
    include('config/config.php');
    mysql_connect($host,$hostuser,$hostpass);
    mysql_query("SET NAMES UTF8");
    $sql=mysql_db_query($database,"select * from news  where banner !='' order by news_id ") or die(mysql_error());
    //echo $sql;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $ribbon;?></title>
  <link rel="stylesheet" type="text/css" href="bootstrap-3.2.0-dist/css/bootstrap.css">
  <script type="text/javascript" src="style.css"></script>
  <script src="jquery/jquery-2.1.3.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
  <nav id="iNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
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
            <li><a href="register_form.php">สมัครสมาชิก</a></li>
            <li><a href="howto-regis.php">การสมัครเรียน</a></li>
          </ul>
          <form class="navbar-form navbar-right" method='post' action='chklogin.php'>
            <div class="form-group">
              <label>ชื่อผู้ใช้</label>
              <input name="username" type="text" autofocus="autofocus" class="form-control input-sm" id="username" placeholder="กรอกชื่อผู้ใช้"  />
            </div>
            <div class="form-group">
              <label>รหัสผ่าน</label>
              <input name="pass" type="password" class="form-control input-sm" id="pass" placeholder="รหัสผ่าน"  />
            </div>
            <button class="btn btn-primary btn-sm" type="submit" >เข้าสู่ระบบ</button>
          </form>   
      </div>
    </div>  
  </nav>
  <br><br><br><br>
  <!-- Content -->
  <?php
    include('slide_news.php');
  ?>
</html>