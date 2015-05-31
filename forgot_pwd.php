<?php
	session_start();
	
	include('config/config.php');
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0"  >
  <tr>
    <?php include "header.php"; ?>
  </tr>
  <tr>
    <td height="46" background="images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td>
    	<table width="100%" border="0">
        	<tr>
				<td>
                	
                </td>
  			</tr>
            <hr />
		</table>

    </td>
  </tr>
</table>
</body>
</html>
<?php
	mysqli_close($dbcon);
?>