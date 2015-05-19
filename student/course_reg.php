<?php
  session_start();
	
	include('../config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	$cos_id=$_GET["cos_id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon; ?></title>
<link href="file:///C|/AppServ/www/training/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <? include "../student/header.php";?>
      </tr>
    </table>      <a href="file:///C|/AppServ/www/training/student/index.php"></a></td>
  </tr>
  <tr>
    <td height="46" valign="top" background="../images/bg_menu.png"><?php include('../student/menu.php') ?></td>
  </tr>
  <tr>
    <td height="400" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>ลงทะเบียนเรียน</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><form id="form1" name="form1" method="post" action="../student/course_reg_action.php">
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td width="180"><strong>รายวิชาในหลักสูตร</strong></td>
              <td>&nbsp;</td>
            </tr>
      <?php
				$i=1;
				$sql="select subject.sub_id , subject.sub_name from subject , course_item ";
				$sql=$sql . " where subject.sub_id=course_item.sub_id and course_item.cos_id=$cos_id ";
				$result=mysql_db_query($database,$sql);
				while($row=mysql_fetch_array($result)){
			?>
            <tr>
              <td align="right"><strong>ชื่อวิชา :</strong></td>
              <td><? echo $row[1] ?>
                <input name="sub_id<? echo $i ?>" type="hidden" id="sub_id<? echo $i ?>" value="<? echo $row[0] ?>" /></td>
            </tr>
            <tr>
              <td align="right"><strong>กลุ่มเรียน : </strong></td>
              <td>
              	<select name="sec_id<? echo $i ?>" id="sec_id<? echo $i ?>">
        <?php
					$sql_sec="select sec_id , sec_name from section where sub_id=$row[0] and cos_id=$cos_id ";
					$sql_sec=$sql_sec . "order by sec_id";
					$result_sec=mysql_db_query($database,$sql_sec);
					
					while($row_sec=mysql_fetch_array($result_sec)){
						echo "<option value='$row_sec[0]'>$row_sec[1]</option>";
					}
				?>
              </select>
              </td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td><hr /></td>
            </tr>
           
      <?php
					$i++;
				}
			?>
             <tr>
              <td align="right">&nbsp;</td>
              <td><input type="submit" name="button" id="button" value="ลงทะเบียนเรียน" />
                <input name="cos_id" type="hidden" id="cos_id" value="<?php echo $cos_id ?>" />
                <input name="end" type="hidden" id="end" value="<?php echo $i ?>" /></td>
            </tr>
          </table>
        </form></td>
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
	mysql_close();
?>