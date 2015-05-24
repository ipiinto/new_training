<?php
	session_start();
	
	include('../config/config.php');
	
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	$page=$_GET["page"];
	if (empty($page)){
		$page=1;
	}
	
	$sub_id=$_GET["sub_id"];
	$id=$_GET["id"];
	
	$sql="select sub_name , time_sub from subject where sub_id=$sub_id ";
	$result=mysqli_query($dbcon,$sql);
	$row=mysqli_fetch_array($result);
	$sub_name=$row["sub_name"];
	$time_sub=$row["time_sub"];
	
	$sql="delete from document where autoid=$id ";
	$result=mysqli_query($dbcon,$sql);
	
	echo "<script language=\"javascript\">window.location.href = 'document.php?sub_id=$sub_id'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>

</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <?php include "../teacher/header.php";?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('../teacher/menu.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong><?php echo $sub_name ?></strong>( <?php echo $time_sub ?> ชั่วโมง )</td>
  </tr>
  <tr>
  	<td><hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><?php include('../office/course_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td width="759" valign="top">
            
       <table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="center">
                <?php
					
				?>
                </td>
              </tr>
              <tr>
                <td align="center"><p>กำลัง Upload<br />
                  กรุณารอสักครู่..........</p>
                  <p>
                  <?php
				  	$title=$_POST["title"];
					$file = $_FILES['fileupload']['name'];
					$typefile = $_FILES['fileupload']['type']; 
					$tempfile = date("Y-m-d")."-".$file;
					$day_in=date("Y-m-d");
					$time_in=date('h:i:s A');
					if($file !=""){
						copy($_FILES['fileupload']['tmp_name'],"upload/" . $tempfile);
						
						$sql="insert into document(sub_id , teacher_id , day_in , time_in , file_name , title , file_type ) ";
						$sql=$sql . " values($sub_id , " . $_SESSION["teach_login"] . " , '$day_in' , '$time_in' , '$tempfile' " ;
						$sql=$sql . " , '$title' , '$typefile' )";
						$result=mysqli_query($dbcon,$sql);
					}
					echo "<script language=\"javascript\">window.location.href = 'document.php?sub_id=$sub_id'</script>";
				  ?>
                  </p></td>
              </tr>
            </table>        
        
        </td>
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