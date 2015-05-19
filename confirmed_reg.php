<?
	session_start();
	
	include('config/config.php');
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
<link href="style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
	alert('คุณได้ทำการลงทะเบียนเรียบร้อยแล้ว กรุณาตรวจสอบวัน-เวลาการชำระเงินตามกำหนด');
	window.location = 'index.php';
</script>

</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <? include "student/header.php";?>
  </tr>
  <tr>
    <td height="46" background="images/bg_menu.png"><? include('student/menu.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="400" align="center" valign="top">
		<?
		print_r($_SESSION);
		$sub_id = $_SESSION["sub_id"];
		$sec_id = $_SESSION["sec_id"];
		echo "<font color='#EE0000'>";
		print_r ($sub_id);
		print_r ($sec_id);
		echo "</font></br>";
		
	foreach($sub_id as $i => $val_sub) {
		foreach($sec_id as $j => $val_sec) {
			if ($i == $j) {
				$day_in=date("Y-m-d");
				$time_in=date('h:i:s A');
				echo "$sub_id[$i] = $sec_id[$j]<br />";
				$sql="insert into learn(sub_id , sec_id , member_id , cos_id , day_reg , time_reg , approve ) ";
				$sql=$sql . " values($sub_id[$i] , $sec_id[$j] , " . $_SESSION["id"] .",". $_SESSION["cos_id"];
				$sql=$sql . " , '$day_in' , '$time_in' , 0)";
				$result=mysql_db_query($database,$sql);
				echo "Insert Complete!!</br>";
			}
    	}
	}
	$sql="update course set num_sec=num_sec+1 where cos_id=". $_SESSION["cos_id"];
	$result=mysql_db_query($database,$sql);
	
		?>
    </td>
  </tr>
</table>
<? 
echo '<script type="text/javascript">'.'chkConfirm();'.'</script>';
?>
</body>
</html>
<?
	mysql_close();
?>