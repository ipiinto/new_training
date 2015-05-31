<?php
	session_start();
	
	include('config/config.php');
	
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	
	if($_GET["Action"] == "Save"){
		//*** Insert Reply ***//
		$sql="INSERT INTO reply (QuestionID,CreateDate,Details,Name) VALUES ";
		$sql=$sql."('".$_REQUEST["QuestionID"]."','".date("Y-m-d H:i:s")."','".$_REQUEST["txtDetails"]."','".$_SESSION['login']."')";

		//echo $sql;
		$result=mysqli_query($dbcon,$sql);
	
		//*** Update Reply ***//
		$sql="update webboard SET Reply = Reply + 1 WHERE QuestionID = '".$_GET["QuestionID"]."' ";
		$result=mysqli_query($dbcon,$sql);	
	}
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
        <?php if ($_SESSION['state']=='นักเรียน'){
			include "student/header.php"; 
			} else if ($_SESSION['state']=='อาจารย์'){
				include "teacher/header.php";
				}
				else if ($_SESSION['state']=='ผู้ดูแลระบบ'){
					include "office/header.php";
				}
		 ?>
      </tr>
    </table>      <a href="../index.php"></a></td>
  </tr>
  <tr>
    <td height="46" valign="top" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td height="400" valign="top">
    	<table width="100%" border="0" cellspacing="2" cellpadding="2">
      		<tr>
        		<td>&nbsp;</td>
      		</tr>
      		<tr>
        		<td>
					                   	
                    <?php
                    
						$sql="select * from webboard WHERE QuestionID = '".$_GET["QuestionID"]."' ";
						$result=mysqli_query($dbcon,$sql);
						$row=mysqli_fetch_array($result);
						
						$sql=" update webboard SET View = View + 1 WHERE QuestionID ='".$_GET["QuestionID"]."' ";
						$result=mysqli_query($dbcon,$sql);
						
					?>
                    <table width="738" border="1" cellpadding="1" cellspacing="1">
						<tr>
							<td colspan="2"><center><h1><?php echo $row["Question"];?></h1></center></td>
						</tr>
						<tr>
							<td height="53" colspan="2"><?php echo nl2br($row["Details"]);?></td>
						</tr>
						<tr>
							<td width="397">ผู้โพสต์ : <?php echo $row["Name"];?> Create Date : <?php echo $row["CreateDate"];?></td>
							<td width="253">View : <?php echo $row["View"];?> Reply : <?php echo $row["Reply"];?></td>
						</tr>
					</table>
                    <br>
					<br>
                    <?php
						$nRows = 0;
						$sql2 = "SELECT * FROM reply WHERE QuestionID = '".$_GET["QuestionID"]."' ";
						$result2=mysqli_query($dbcon,$sql2);
						while($rows=mysqli_fetch_array($result2)){
							$nRows++;
					?>No : <?php echo $nRows;?>
                    <table width="738" border="1" cellpadding="1" cellspacing="1">
						<tr>
							<td height="53" colspan="2"><?php echo nl2br($rows["Details"]);?></td>
						</tr>
						<tr>
							<td width="397">Name : <?php echo $rows["Name"];?></td>
							<td width="253">Create Date :<?php echo $rows["CreateDate"];?></td>
  						</tr>
					</table>
                    <br>
					<?php
						}
						echo "<pre>";
						print_r($_SERVER);
						echo "</pre>";
						exit;
					?>
                    <br>
					<a href="forum.php">Back to Webboard</a> <br>
					<br>
                    <form action="reply.php?QuestionID=<?=$_GET["QuestionID"];?>&Action=Save" method="post" name="frmMain" id="frmMain">
  					<table width="738" border="1" cellpadding="1" cellspacing="1">
						<tr>
							<td width="78">Details</td>
							<td><textarea name="txtDetails" cols="50" rows="5" id="txtDetails"></textarea></td>
						</tr>
					</table>
  
  						<input name="btnSave" type="submit" id="btnSave" value="Submit">
					</form>
                    
                </td>
      		</tr>
    	</table>
    </td>
    </tr>
    </table>
    </td>
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