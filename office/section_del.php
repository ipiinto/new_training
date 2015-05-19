<?
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
<title><? echo $ribon ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">

</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <?php include '../office/header.php'?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><? include('menu.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><? include('course_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td><strong>รายวิชาที่เปิดสอน</strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><div align="center">
              <p>
                <?php
          				$sec_id =$_GET["sec_id"];
          				$cos_id=$_GET["cos_id"];
          				
          				$sql="delete from section  where sec_id =$sec_id ";
          				$result1=mysql_db_query($database,$sql);
          						
          				if($cos_id !=""){
          					echo "<script language=\"javascript\">window.location.href = 'course.php'</script>";
          				}else{
          					echo "<script language=\"javascript\">window.location.href = 'subject.php'</script>";
          				}
                ?>
              </p>
              <p>กำลังทำการลบข้อมูล<br />
                กรุณารอสักครู่......... </p>
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
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