<?php 
  session_start();
  include('config/config.php');
  mysql_connect($host,$hostuser,$hostpass);
  mysqli_query("SET NAMES UTF8");
?>
<link href="style.css" rel="stylesheet" type="text/css">
<?php
  if(isset($_SESSION['id'])==""){
?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="container">
            <a href="index2.php">
              <img src="images/top_logo.png" alt="">
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="container">
            &nbsp;
          </div>
        </div>
        <div class="col-md-5">
          <div class="container">
            <form class="form-inline">
            <div class="form-group">
              <label for="username" class="wh" >ชื่อผู้ใช้</label>
              <input type="text" class="form-control" id="username" placeholder="ชื่อผู้ใช้">
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php
  }else{
?>
    <td background="../images/bg_banner.jpg" height="81">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="446"><a href="index.php"><img src="../images/top_logo1.png" width="446" height="75" /></a></td>
          <td width="256">&nbsp;</td>
          <td width="366">
          <?php
            $sql="select * from member where username='".$_SESSION['login']."'";
            $result=mysqli_query($dbcon,$sql);
            $rows=mysqli_fetch_array($result);
            echo "<font color='#FFFFFF'>ยินดีต้อนรับคุณ </font><a href='edit_profile.php'><font color='#FFFFFF'>$rows[3]&nbsp;&nbsp;$rows[4]</a>&nbsp;&nbsp;(".$_SESSION['state'].")</font>";
            echo "<br>[<a href='change_pwd.php'><font color='#FFFFFF'>เปลี่ยนรหัสผ่าน</font></a>]";
            echo "[<a href='logout.php'><font color='#FFFFFF'>ออกจากระบบ</font></a>]";  
          ?>
          </td>
        </tr>
      </table>
    </td>
<?php
  }
?>