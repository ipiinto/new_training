<?php
  session_start();
	
	include('../config/config.php');
	
	
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
   <link rel="stylesheet" type="text/css" href="../bootstrap-3.2.0-dist/css/bootstrap.css">
<link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <?php include '../office/header.php'?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="350" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td align="center"><a href="member.php"><img src="../images/member-m.png" width="80" height="80" border="0" /></a></td>
        <td align="center"><a href="course.php"><img src="../images/briefcase.png" width="80" height="80" border="0" /></a></td>
        <td align="center"><a href="news_frm.php"><img src="../images/megaphone.png" width="80" height="80" border="0" /></a></td>
      </tr>
      <tr>
        <td align="center">จัดการสมาชิก</td>
        <td align="center">จัดการหลักสูตร</td>
        <td align="center">จัดการข่าว</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><a href="../forum/forum.php"><img src="../images/social_icon.png" width="80" height="81"  alt=""/></a><a href="logout.php"></a></td>
        <td align="center"><a href="log_off.php"><img src="../images/logout_icon.jpg" width="80" height="81" border="0" /></a></td>
        <td align="center"><a href="../teacher/logout.php"></a></td>
      </tr>
      <tr>
        <td align="center">กระดานถาม-ตอบ</td>
        <td align="center">ออกจากระบบ</td>
        <td align="center">&nbsp;</td>
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
	mysqli_close($dbcon);
?>