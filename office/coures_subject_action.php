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
<table width="1024" bgcolor="#FFFFFF" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <?php include('../office/header.php') ?>
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
            <td><strong>หลักสูตร</strong></td>
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
					
					$sql="delete from course_item where cos_id=$cos_id ";
					$result=mysqli_query($dbcon,$sql);
					
					$i=1;
					$sql="select sub_id , sub_name from subject  order by sub_id ";
					$result=mysqli_query($dbcon,$sql);
					while($row=mysqli_fetch_array($result)){
						$ch=$_POST["ch_$i"];
						if($ch==1){
							$sql="insert into course_item(cos_id , sub_id ) values($cos_id , $row[0])";
							$result_add=mysqli_query($dbcon,$sql);
						}
						$i++;
						
					}
					
					//คำนวณราคา
					$sql="select sum(subject.price) from subject , course_item ";
					$sql=$sql . " where course_item.sub_id=subject.sub_id and course_item.cos_id=$cos_id ";
					$result=mysqli_query($dbcon,$sql);
					$row=mysqli_fetch_array($result);
					if($row[0]==""){
						$price=0;
					}else{
						$price=$row[0];
					}
				
				$sql="update course set price=$price where cos_id=$cos_id ";
				$result=mysqli_query($dbcon,$sql);
				echo "<script language=\"javascript\">window.location.href = 'course.php'</script>";
			?>
              </p>
              <p>กำลังทำการบันทึกข้อมูล<br />
                กรุณารอสักครู่......... </p>
              <p><img src="../images/loading.gif" width="32" height="32"  alt=""/></p>
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