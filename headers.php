<?php 
    session_start();
  include('config/config.php');
  mysql_connect($host,$hostuser,$hostpass);
  mysql_query("SET NAMES UTF8");
?>
<link href="style.css" rel="stylesheet" type="text/css">
<?php
  if(isset($_SESSION['id'])==""){
?>
  <td height="81" background="images/bg_banner.jpg">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="446"><a href="index.php"><img src="images/top_logo1.png" width="446" height="75" /></a></td>
        <td width="265">&nbsp;</td>
        <td width="357">
          <form name='form1' method='post' action='chklogin.php'>
          <table width='100%' border='0' cellspacing='2' cellpadding='2'>
           	<tr>
              <td><font color='#FFFFFF'>ชื่อผู้ใช้</font></td>
              <td><font color='#FFFFFF'>รหัสผ่าน</font></td>
            </tr>
            <tr>
              <td><input name='username' type='text' autofocus id='username' size='15' placeholder="กรอกชื่อผู้ใช้"></td>
              <td><input name='pass' type='password' id='pass' size='15' placeholder="กรอกรหัสผ่าน"></td>
              <td><input type="submit" name="button" id="button" value="เข้าสู่ระบบ" class="" /></td>
            </tr>
            <tr>
              <td>
                <input type='checkbox' name='remember' id='remember'><label for='remember'>
                <font color='#FFFFFF'>จำชือผู้ใช้</font></label>
              </td>
              <td>
                <a href='forgot_pwd.php'><font color='#FFFFFF'>ลืมรหัสผ่าน ?</font></a></td>
              <td>
                <a href='registered.php'><font color='#FFFFFF' size='2'>สมัครสมาชิก</font></a>
              </td>
            </tr>
  		    </table>
          </form>
        </td>
      </tr>
  	</table>
  </td>
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
            $result=mysql_db_query($database,$sql);
            $rows=mysql_fetch_array($result);
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