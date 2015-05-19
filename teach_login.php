<?
	session_start();
	
	include('config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $ribon ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <? include "header.php"; ?>
  </tr>
  <tr>
    <td height="46" background="images/bg_menu.png"><? include('menu.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="300" align="center">
    <?
		$username=$_POST["username"];
		$pass=$_POST["pass"];
		
		
		$sql="select * from teacher where username='$username' and pass='$pass' ";
		$result=mysql_db_query($database,$sql);
		$nRow=mysql_num_rows($result);
		if($nRow !=0){
			$row=mysql_fetch_array($result);
			$_SESSION["teach_login"] =$row[1];
			$_SESSION["id"] =$row[0];
			echo "<script language=\"javascript\">window.location.href = 'teacher/index.php'</script>";
		}else{
			echo "<font color='red'>ไม่สามารถเข้าสู่ระบบได้  กรุณาตรวจสอบข้อมูลการ Login อีกครั้ง</font>";
			echo "<br><font color='red'><a href='index.php'>Login </a></font>";
		}
	?>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?
	mysql_close();
?>