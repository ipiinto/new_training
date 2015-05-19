<?php
	session_start();
	include('config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
  mysql_select_db($database);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon; ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <?php include("header.php");?>
      </tr>
    </table><a href="index.php"></a></td>
  </tr>
  <tr>
    <td height="46" valign="middle" background="images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td height="400" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td valign="middle"><a href="student/list_subject.php"><img src="images/reg_bar.png" width="300" height="27"  alt=""/></a>          <hr size="5" /></td>
      </tr>
      <tr>
        <td><u><h1 align="center">การสมัครเรียน</h1></u></td>
      </tr>
      <tr>
        <td>
          <ol type="1">
            <li>ตรวจสอบ<a href="list_course.php">หลักสูตร/รายวิชา</a>ที่เปิดสอน
              <br />
              <br />
              <a href="images/regis/1.jpg"  onclick="window.open('images/regis/1.jpg', 'newwindow', 'width=600, height=400'); return false;"><img src="images/regis/1.jpg" width="30%" alt="" /></a>
              <!-- <a href="images/regis/1.jpg" target="_blank"><img src="images/regis/1.jpg" width="30%" alt="" /></a> -->
              <br />
              <br />
            </li>
            <li>เลือกรายวิชา/กลุ่มเรียนที่ต้องการลงทะเบียน<br />
              <br />
              <!-- <a href="images/regis/2.jpg" target="_blank"><img src="images/regis/2.jpg" width="338" height="184"  alt=""/></a> -->
              <a href="images/regis/2.jpg"  onclick="window.open('images/regis/2.jpg', 'newwindow', 'width=600, height=400'); return false;"><img src="images/regis/2.jpg" width="30%" alt="" /></a>
              
              <br />
              **หมายเหตุ** หลังจากการยืนยันการเลือกลงทะเบียนตามกลุ่มเรียนของรายวิชาในหลักสูตรเสร็จเรียบร้อย ระบบจะทำการตรวจสอบ ว่าคุณได้ทำการเข้าสู่ระบบหรือสมัครสมาชิกระบบหรือไม่ หากไม่ ระบบจะให้คุณทำการเข้าระบบ/สมัครสมาชิกก่อน<br />
              <br />
              <!-- a href="images/regis/3.jpg" target="_blank"><img src="images/regis/3.jpg" width="321" height="147"  alt=""/></a> -->
              <a href="images/regis/3.jpg"  onclick="window.open('images/regis/3.jpg', 'newwindow', 'width=600, height=400'); return false;"><img src="images/regis/3.jpg" width="30%" alt="" /></a>              </li>
            <li><br />
  <br />
            </li>
          </ol> 
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
	mysql_close();
?>