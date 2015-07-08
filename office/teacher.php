<?php
  session_start();
	include('../config/config.php');
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	$opt='';
  $find='';
  if (empty($page)){
    $page=1;
  } else {
    $page=$_GET["page"];
  }
  if (empty($opt)){
    $opt='';
  } else {
    $opt=$_GET["opt"];
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<link href="../bootstrap-3.2.0-dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function submitform(){
	if(confirm('ท่านต้องการลบข้อมูลที่เลือกไว้หรือไม่ !')==true){
  		document.form2.submit();
	}
}
</script>
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
  <tr>
    <?php include '../office/header.php'?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td align="left" valign="bottom" style="margin-top:10px"><img src="../images/teach_bar.png" /><hr /></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><?php include('member_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td valign="top">
        <?php
          require("teacher_detail.php");
        ?>
    </td>
  </tr>
  <tr>
    <td height="74">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
	mysqli_close($dbcon);
?>