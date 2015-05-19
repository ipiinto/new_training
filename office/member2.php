<?php
  session_start();
	
	include('../config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	$page=$_GET["page"];
	if (empty($page)){
		$page=1;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $ribon ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>

<script type="text/javascript">

function DelCourse(id){
	if(confirm('ท่านต้องการลบข้อมูลที่เลือกไว้หรือไม่ !')==true){
  		window.location="course_del.php?cos_id="+ id;
	}
}

function Delsubject(cos_id,id){
	if(confirm('ท่านต้องการลบข้อมูลที่เลือกไว้หรือไม่ !')==true){
  		window.location="subject_remove.php?id="+ id + "&cos_id=" + cos_id;
	}
}

function DelSec(cos_id , id){
	if(confirm('ท่านต้องการลบข้อมูลที่เลือกไว้หรือไม่ !')==true){
  		window.location="section_del.php?sec_id="+ id + "&cos_id=" + cos_id;
	}
}
</script>
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
    <td align="left" valign="middle"><img src="../images/user_manage.png" /><hr /></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolor="#efefef">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><?php include('member_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2" bordercolor="#efefef">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="144">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
	mysql_close();
?>