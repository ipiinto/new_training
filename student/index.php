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
<title><?php echo $ribon ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../themes/6/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="../themes/6/js-image-slider.js" type="text/javascript"></script>
    <link href="../generic.css" rel="stylesheet" type="text/css" />

</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <?php include "../student/header.php";?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('../student/menu.php') ?></td>
  </tr>
  <tr>
    <td align="center" valign="top">
      <table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td width="70%">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td width="100%" align="left" valign="top">
                  <!--Slide Banner-->
                    <?php include "news_slide.php"; ?>
                  <!-- End Slide Banner -->
                </td>
              </tr>           
            </table></td>
          <td width="30%">
            <div class="scrollit" >
              <table width="100%" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
                <tr>
                  <td bgcolor="#5f7ac3"><img src="../images/news.png" width="187" height="33"  alt="ข่าวประชาสัมพันธ์"/></td>
                </tr>
                <tr>
                  <td><?php include "news_show.php"; ?></td> 
                </tr>
              </table>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
<?php
	mysql_close();
?>