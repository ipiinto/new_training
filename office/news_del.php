<?php
  session_start();
	
	include('../config/config.php');
	
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
function submitform(){
  document.form2.submit();
}
</script>
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <?php include '../office/header.php'?>
      </tr>
    </table><a href="../index.php"></a></td>
  </tr>
  <tr>
    <td height="46" valign="middle" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td height="400" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td width="250">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td valign="top"><?php include('member_menu.php') ?></td>
        <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td><strong>ข่าวประชาสัมพันธ์</strong><hr /></td>
            <td align="right" class="t10r">ลบข้อมูล</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center">
              <p>
                <?php
          				$sql=$_POST["sql"];
          				$result=mysqli_query($dbcon,$sql);
          				while($row=mysqli_fetch_array($result)){
          					$ch=$_POST["ch$row[0]"];
          					if($ch==1){
          						$sql="delete from news where news_id=$row[0]";
          						$result1=mysqli_query($dbcon,$sql);
          						echo $sql . "<br>";
          					}
          				}
          				echo "<script language=\"javascript\">window.location.href = 'news_frm.php'</script>";
                ?>
              </p>
              <p>กำลังทำการลบข้อมูล<br />
                กรุณารอสักครู่.........              </p></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
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
	mysqli_close($dbcon);
?>