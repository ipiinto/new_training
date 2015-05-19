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
<title><? echo $ribon; ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <? include "header.php"; ?>
      </tr>
    </table>      <a href="index.php"></a></td>
  </tr>
  <tr>
    <td height="46" background="images/bg_menu.png"><? include('menu.php') ?></td>
  </tr>
  <tr>
    <td height="400" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td valign="middle"><a href="student/list_subject.php"><img src="images/reg_bar.png" width="300" height="27"  alt=""/></a>          <hr size="5" />
        </td>
      </tr>
      <tr>
      	<td align="center" valign="top" width="100%"><img src="images/regstep.jpg" width="1020" height="1285"  alt=""/></td>
      </tr>
    </table></td>
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