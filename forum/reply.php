<?
	session_start();
	
	include('../config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	
	if($_GET["Action"] == "Save"){
		//*** Insert Reply ***//
		$sql="INSERT INTO reply (QuestionID,CreateDate,Details,Name) VALUES ";
		$sql=$sql."('".$_REQUEST["QuestionID"]."','".date("Y-m-d H:i:s")."','".$_REQUEST["txtDetails"]."','".$_SESSION['name']."')";

		//echo $sql;
		$result=mysql_db_query($database,$sql);
	
		//*** Update Reply ***//
		$sql="update webboard SET Reply = Reply + 1 WHERE QuestionID = '".$_GET["QuestionID"]."' ";
		$result=mysql_db_query($database,$sql);	
	}
?>
	


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $ribon; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <? if ($_SESSION['state']=='นักเรียน'){
			include "../student/header.php"; 
			} else if ($_SESSION['state']=='อาจารย์'){
				include "../teacher/header.php";
				}
				else if ($_SESSION['state']=='ผู้ดูแลระบบ'){
					include "../office/header.php";
				}
		 ?>
      </tr>
    </table><a href="../index.php"></a></td>
  </tr>
  <tr>
    <td height="46" valign="middle" background="../images/bg_menu.png">
		<?
			include "../menu1.php";
		?>
    </td>
  </tr>
  <tr>
    <td height="400" valign="top">
    	<table width="100%" border="0" cellspacing="2" cellpadding="2">
      		<tr>
        		<td>&nbsp;</td>
      		</tr>
      		<tr>
        		<td>
					                   	
                    <?
                    
						$sql="select * from webboard WHERE QuestionID = '".$_GET["QuestionID"]."' ";
						$result=mysql_db_query($database,$sql);
						$row=mysql_fetch_array($result);
						
						$sql=" update webboard SET View = View + 1 WHERE QuestionID ='".$_GET["QuestionID"]."' ";
						$result=mysql_db_query($database,$sql);
						
					?>
                    <table width="738" border="1" align="center" cellpadding="0" cellspacing="1" bordercolor="#52679F">
						<tr>
							<td colspan="2" bgcolor="#52679F"><h1 class="wh" align="center"><? echo $row["Question"];?></h1></td>
						</tr>
						<tr>
							<td height="53" colspan="2" bgcolor="#dae4ff"><? echo nl2br($row["Details"]);?></td>
						</tr>
						<tr>
							<td width="397" bgcolor="#52679F" class="wh">ผู้โพสต์ : <? echo $row["Name"];?> โพสต์เมื่อ : <? echo $row["CreateDate"];?></td>
							<td width="253" bgcolor="#52679F" class="wh">ยอดชม : <? echo $row["View"];?> ตอบกลับ : <? echo $row["Reply"];?></td>
						</tr>
					</table>
                    <br>
					<br>
                    <?
						$nRows = 0;
						$sql2 = "SELECT * FROM reply WHERE QuestionID = '".$_GET["QuestionID"]."' ";
						$result2=mysql_db_query($database,$sql2);
						while($rows=mysql_fetch_array($result2)){
							$nRows++;
					?>
                    <table width="738" border="1" align="center" cellpadding="0" cellspacing="1" bordercolor="#52679F">
                    	<tr>
                       	  <td colspan="4" bgcolor="#52679F" class="wh">#<? echo $nRows;?></td>
                        </tr>
						<tr>
							<td height="53" colspan="2" rowspan="2" align="center" valign="middle" bgcolor="#DAE4FF"><img src="../images/on.png" width="48" height="48"  alt=""/></td>
                            <td colspan="2" height="40"><? echo nl2br($rows["Details"]);?></td>
					  </tr>
						<tr>
							<td width="397" bgcolor="#52679F" class="wh">โดย : <? echo $_SESSION['name'];?></td>
							<td width="253" bgcolor="#52679F" class="wh">เมื่อ:<? echo $rows["CreateDate"];?></td>
					  </tr>
					</table>
					<?
						}
					?>
					<p><a href="forum.php"> << กลับ</a></a></p>
                    <form action="reply.php?QuestionID=<?=$_GET["QuestionID"];?>&Action=Save" method="post" name="frmMain" id="frmMain">
  					<table width="738" border="1" align="center" cellpadding="0" cellspacing="1" bordercolor="#52679F" >
                    	<tr>
                       	  <td colspan="2" bgcolor="#52679F" class="wh"><strong>แสดงความคิดเห็น ::</strong></td>
                        </tr>
						<tr>
							<td width="155" bgcolor="#DAE4FF" >&nbsp;&nbsp;</td>
							<td width="580" bgcolor="#DAE4FF" ><textarea name="txtDetails" cols="50" rows="5" id="txtDetails"></textarea>
						    <input name="btnSave" type="submit" id="btnSave" value="แสดงความเห็น" /></td>
						</tr>
					</table>
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
<?
	mysql_close();
?>