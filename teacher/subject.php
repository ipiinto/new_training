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
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <?php include "../teacher/header.php";?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
   <tr>
    <td height="400" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>รายวิชาที่สอน</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
        <?php
			$sql="select subject.sub_id , subject.sub_name , subject.time_sub , detail from subject , subject_list ";
			$sql=$sql . " where subject.sub_id=subject_list.sub_id and subject_list.teacher_id=" . $_SESSION["id"] ;
			$sql=$sql . " order by subject.sub_name";
			$result=mysql_db_query($database,$sql);
			echo $sql;
			while($row=mysql_fetch_array($result)){
		?>
          <tr>
            <td width="50" align="center"><img src="../images/education.png" width="50" height="50" /></td>
            <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td><strong><a href='document.php?sub_id=<?php echo $row[0] ?>'><?php echo $row[1] ?></a></strong>( <?php echo $row[2] ?> ชั่วโมง )</td>
              </tr>
              <tr>
                <td><?php echo $row[3] ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="2"><hr /></td>
            </tr>
            <?php
			}
			?>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>

</table>
</body>
</html>
<?php
	mysql_close();
?>