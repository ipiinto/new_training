<?php
	session_start();
	
	include('config/config.php');
	
	mysql_select_db($dbcon);
	
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
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <?php include "student/header.php";?>
  </tr>
  <tr>
    <td height="46" background="images/bg_menu.png"><?php include('student/menu.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="400" align="center" valign="top">
    <?php
		//print_r($_SESSION);
		$sub_id = $_SESSION["sub_id"];
		$sec_id = $_SESSION["sec_id"];
	
	?>
		<table width='60%' align='center' cellpadding='1' cellspacing='1'>
			<tr class="wh">
                <th width="17%" bgcolor="#52679F"><div align="center" class="wh">กลุ่มเรียน</div></th>
                <th width="27%" bgcolor="#52679F"><div align="center" class="wh">รายวิชา</div></th>
              <th width="32%" bgcolor="#52679F"><div align="center" class="wh">วัน - เวลา</div></th>
			</tr>
            
        <?php
			$sql= "select course.cos_id,course.cos_name,section.sec_id,section.sec_name,subject.sub_id,subject.sub_name,section.day,section.since,section.until from subject,section where subject.sub_id=$sub_id and section.sec_id=$sec_id";
				$result=mysqli_query($sql);
				echo $sql;
				while($row=mysqli_fetch_array($result)){
					$strDay=getDay($row[4]);
					$strSince=getSince($row[5]);
					$strUntil=getUntil($row[6]);
		?>
	    			<tr>
	    				<td align="center" valign="middle" bgcolor="#dae4ff"><?php echo $row[1];?></td>
	                    <td align="center" valign="middle" bgcolor="#dae4ff"><?php echo $row[3];?></td>
	                    <td align="center" valign="middle" bgcolor="#dae4ff"><?php echo $strDay."&nbsp;่&nbsp;".$strSince."&nbsp;-&nbsp;".$strUntil ?></td>
	                </tr>
	    <?php
				}
		?>
    </table>
		<br />
        <button onclick="window.location.href='list_course.php'">ยกเลิก</button>&nbsp;
		<button onclick="window.location.href='detail_reg.php'">ลงทะเบียน</button>
    </td>
  </tr>
</table>
</body>
</html>
<?php
	function getDay($d){
			if($d==1){
				$da='อา.';	
			}elseif($d==2){
				$da='จ.';
			}elseif($d==3){
				$da='อ.';
			}elseif($d==4){
				$da='พ.';
			}elseif($d==5){
				$da='พฤ.';
			}elseif($d==6){
				$da='ศ.';
			}else{
				$da='ส.';
			}
			
			return $da;
	}
	
	function getSince($s){
		if($s==1){
			$si='8.30';	
		}elseif($s==2){
			$si='9.30';	
		}elseif($s==3){
			$si='10.30';	
		}elseif($s==4){
			$si='11.30';	
		}elseif($s==5){
			$si='12.30';	
		}elseif($s==6){
			$si='13.30';	
		}elseif($s==7){
			$si='14.30';	
		}elseif($s==8){
			$si='15.30';	
		}elseif($s==9){
			$si='16.30';	
		}elseif($s==10){
			$si='17.30';	
		}elseif($s==11){
			$si='18.30';	
		}else{
			$si='19.30';	
		}
		return $si;	
	}
	
	function getUntil($u){
		if($u==2){
			$ut='9.30';	
		}elseif($u==3){
			$ut='10.30';	
		}elseif($u==4){
			$ut='11.30';	
		}elseif($u==5){
			$ut='12.30';	
		}elseif($u==6){
			$ut='13.30';	
		}elseif($u==7){
			$ut='14.30';	
		}elseif($u==8){
			$ut='15.30';	
		}elseif($u==9){
			$ut='16.30';	
		}elseif($u==10){
			$ut='17.30';	
		}elseif($u==11){
			$ut='18.30';	
		}else{
			$ut='19.30';	
		}
		return $ut;	
	}

	mysqli_close($dbcon);
?>