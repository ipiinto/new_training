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
<link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <?php include "../student/header.php";?>
      </tr>
    </table><a href="../index.php"></a></td>
  </tr>
  <tr>
    <td height="46" valign="top" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
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
        <td>
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" align="right">&nbsp;</td>
              </tr>
            <tr>
              <td colspan="2" align="left">&nbsp;</td>
              </tr>
            <tr>
              <td colspan="2" align="center">
           			 <p>กำลังบันทึกข้อมูล<br />
          กรุณารอสักครู่...........
        </p>
    <?php
			$cos_id=$_POST["cos_id"];
			$end=$_POST["end"];
			
			$day_in=date("Y-m-d");
			$time_in=date('h:i:s A');
			$sub_id=$_POST["sub_id$i"];
			$sec_id=$_POST["sec_id$i"];
			
			foreach($sub_id as $i => $val_sub) {
				foreach($sec_id as $j => $val_sec) {
					if ($i == $j) {
						$day_in=date("Y-m-d");
						$time_in=date('h:i:s A');
						echo "$sub_id[$i] = $sec_id[$j]<br />";
						$sql="insert into learn(sub_id , sec_id , member_id , cos_id , day_reg , time_reg , approve ) ";
						$sql=$sql . " values($sub_id[$i] , $sec_id[$j] , " . $_SESSION["id"] .", '$cos_id' ";
						$sql=$sql . " , '$day_in' , '$time_in' , 0)";
						$result=mysql_db_query($database,$sql) or die($sql);
						echo "Insert Complete!!</br>";
					}
				}
			}
			$sql="update course set num_sec=num_sec+1 where cos_id=$cos_id";
			$result=mysql_db_query($database,$sql) or die($sql);
					
			//echo "<script language=\"javascript\">window.location.href = 'list_subject.php'</script>";
		?>   
              </td>
           </tr>
             <tr>
              <td colspan="2" align="right">&nbsp;</td>
              </tr>
          </table>
		</td>
      </tr>
    </table></td>
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