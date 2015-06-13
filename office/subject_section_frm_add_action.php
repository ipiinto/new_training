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
<title><?php echo $ribon ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">

</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <?php include '../office/header.php'?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><?php include('course_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td><strong>รายวิชาที่เปิดสอน</strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><div align="center">
              <p>
                <?php
			  	
				$cos_id=$_POST["cos_id"];
				if($cos_id==""){
					$cos_id=0;
				}
				$action=$_POST["action"];
				if($action=="add"){
					//เพิ่มข้อมูล
					$sub_id=$_POST["sub_id"];
					$num=$_POST["num"];
					$start=$_POST["start"];
					$end=$_POST["end"];
					
					for($i=$start;$i<$end;$i++){
						$teacher_id=$_POST["teacher$i"];
						$sec_name=$_POST["sec_name$i"];
						$max_sec=$_POST["max_sec$i"];
						$day=$_POST["day$i"];
						$since=$_POST["since$i"];
						$until=$_POST["until$i"];
						$room=$_POST["room$i"];
						if($max_sec==""){
							$max_sec=20;
						}
						
						$sql="select * from section where day='$day' and since=$since";
						$sql=$sql."and until=$until and room=$room and teacher=$teacher_id";
						$result=mysqli_query($dbcon,$sql);
						$nRow=mysqli_num_rows($result);
						if($since == $since && $until == $until && $teacher_id != $teacher_id && $room != $room){
							echo "ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลใหม่";	
						}else{
						$sql="insert into section(sec_name , sub_id , teacher_id , max_sec , num_sec , sec_count , cos_id  , day , since, until , room) ";
						$sql=$sql . " values('$sec_name' , $sub_id , $teacher_id , $max_sec  , 0, $i , $cos_id , '$day' , '$since' , '$until' , '$room')";
						}
						$result=mysqli_query($dbcon,$sql);
						
						
					}
				}else{
					$sec_id=$_POST["sec_id"];
					$teacher_id=$_POST["teacher"];
					$max_sec=$_POST["max_sec"];
					$day=$_POST["day"];
					$since_h=$_POST["since"];
					$until_m=$_POST["until"];
					$room=$_POST["room"];
					
					$sql="update section set max_sec=$max_sec ,teacher_id=$teacher_id , day=$day , since=$since ,  until=$until , room=$room";
					$sql=$sql." where sec_id=$sec_id ";
					$result=mysqli_query($dbcon,$sql);
					
					
					
				}
				
				if($cos_id==0){
					echo "<script language=\"javascript\">window.location.href = 'subject.php'</script>";
				}else{
					echo "<script language=\"javascript\">window.location.href = 'course.php'</script>";
				}
			  ?>
              </p>
              <p>กำลังทำการบันทึกข้อมูล<br />
                กรุณารอสักครู่......... </p>
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
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
	mysqli_close($dbcon);
?>