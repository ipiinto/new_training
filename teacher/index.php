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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <?php include "../teacher/header.php";?>
  </tr>
  <tr>
    <td height="46"  background="../images/bg_menu.png"><?php include('../menu1.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="400" align="center" valign="top" bgcolor="#FFFFFF"><table width="350" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td align="center"><a href="../teacher/subject.php"><img src="../images/subject_icon.jpg" width="80" height="81" border="0" /></a></td>
        <td align="center"><a href="../teacher/timetable.php"><img src="../images/timetable_icon.jpg" width="80" height="81" border="0" /></a></td>
        <td align="center"><a href="../forum/forum.php"><img src="../images/social_icon.png" width="80" height="81"  alt=""/></a></td>
      </tr>
      <tr>
        <td align="center">รายวิชาที่สอน</td>
        <td align="center">ตารางสอน</td>
        <td align="center">กระดานถาม-ตอบ</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><a href="../student/logout.php"></a></td>
        <td align="center"><a href="../student/logout.php"><img src="../images/logout_icon.jpg" width="80" height="81" border="0" /></a></td>
        <td align="center"><a href="logout.php"></a></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center">ออกจากระบบ</td>
        <td align="center">&nbsp;</td>
      </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</td></tr></table>
</body>
</html>
<?php
	mysql_close();
?>