<?php
    session_start();
  $_SESSION['login']="";
  include('config/config.php');
  mysql_connect($host,$hostuser,$hostpass);
  mysql_query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
    <link rel="stylesheet" type="text/css" href="bootstrap-3.2.0-dist/css/bootstrap.css">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
  <?php
      if(isset($_SESSION['id'])==""){
  ?>
    <div class="container-fluid" style="height:75px;background-color:#003366;" >
        <?php
          include('header.php');
        ?>
      </div>
  <?php
    }
  ?>
    <div class="container-fluid">
      <div class="row">
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
          <div class="container">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">WAC</a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index2.php">หน้าแรก</a></li>
              <li><a href="registered.php">สมัครสมาชิก</a></li>
              <li><a href="howto-regis.php">การสมัครเรียน</a></li>
              <li><a href="#">User</a></li>
            </ul>
          </div>
        </div>
          </nav>
      </div>
    </div>
    <div class="container-fluid">
      <div class="container">
        <form id="form2" name="form2" method="post" action="registered.php" class="form-horizontal">
          <div class="form-group">
              <label for="username" class="col-sm-3 control-label">ชื่อผู้ใช้งาน</label>
              <div class="col-sm-3">
                <input type="username" class="form-control" id="username" placeholder="ชื่อผู้ใช้งานระบบ">
              </div>
            <div class="col-sm-6"></div>
          </div>
          <div class="form-group">
              <label for="pass" class="col-sm-3 control-label">รหัสผ่าน</label>
              <div class="col-sm-3">
                <input type="password" class="form-control" id="pass" placeholder="รหัสผ่าน">
              </div>
            <div class="col-sm-6"></div>
          </div>
          <div class="form-group">
              <label for="re_pass" class="col-sm-3 control-label">ยืนยันรหัสผ่าน</label>
              <div class="col-sm-3">
                <input type="password" class="form-control" id="re_pass" placeholder="ยืนยันรหัสผ่าน">
              </div>
            <div class="col-sm-6"></div>
          </div>
          <div class="form-inline">
            <div class="form-group">
                <label for="re_pass" class="col-sm-7 control-label">ชื่อ-สกุล</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="name" placeholder="ชื่อ">
                </div>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="re_pass" placeholder="สกุล">
                </div>
              <!-- <div class="col-sm-3"></div> -->
            </div>
          </div>
        </form>   
      </div>
    </div>
</body>
</html>