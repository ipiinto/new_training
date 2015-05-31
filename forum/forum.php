<?php
	session_start();
	if($_SESSION["login"]=="")echo "<script language=\"javascript\">window.location.href = 'index.php'</script>";
	include("../config/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon; ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="../style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
@import url("../bootstrap-3.2.0-dist/css/bootstrap.css");
</style>
</head>
<body>
<table width="1024" border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" bordercolor="#EEEEEE" >
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <?php 
			if ($_SESSION['state']=='นักเรียน'){
				include "../student/header.php"; 
			}elseif($_SESSION['state']=='อาจารย์'){
				include "../teacher/header.php";
			}elseif($_SESSION['state']=='ผู้ดูแลระบบ'){
				include "../office/header.php";
			}
		 ?>
      </tr>
    </table><a href="../index.php"></a></td>
  </tr>
  <tr>
    <td height="46" valign="middle" background="../images/bg_menu.png">
		<?php
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
		<?php
      $sql="select * from webboard";
			$result=mysqli_query($dbcon,$sql);
			$nRow=mysqli_num_rows($result);
			$Per_Page = 10;   // Per Page
			if (empty($_GET["Page"])) {
				$Page = 1;
			} else {
				$Page = $_GET["Page"];
			}
			$Prev_Page = $Page-1;
			$Next_Page = $Page+1;
			
			$Page_Start = (($Per_Page*$Page)-$Per_Page);
			if($nRow<=$Per_Page){
				$Num_Pages =1;
			}else if(($nRow % $Per_Page)==0){
				$Num_Pages =($nRow/$Per_Page) ;
			}else{
				$Num_Pages =($nRow/$Per_Page)+1;
				$Num_Pages = (int)$Num_Pages;
			}
			
			$sql=$sql . " order  by QuestionID LIMIT $Page_Start , $Per_Page";
			$result=mysqli_query($dbcon,$sql);
			
		?>
	<table width="909" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#52679F" class="table-hover">

		<tr class="wh">
			<th width="98" bgcolor="#52679F"> <div align="center" class="wh">ลำดับ</div></th>
			<th width="426" bgcolor="#52679F"> <div align="left" class="wh">หัวข้อกระทู้</div></th>
			<th width="86" bgcolor="#52679F"> <div align="center" class="wh">ผู้โพสต์</div></th>
			<th width="119" bgcolor="#52679F"> <div align="center" class="wh">สร้างเมื่อ</div></th>
			<th width="70" bgcolor="#52679F"> <div align="center" class="wh">ยอดชม</div></th>
			<th width="70" bgcolor="#52679F"> <div align="center" class="wh">ตอบกลับ</div></th>
		</tr>

        <?php
			while($row=mysqli_fetch_array($result)){
		?>
		<tr>
			<td bgcolor="#dae4ff"><div align="center"><?php echo $row["QuestionID"];?><br />
			</div></td>
			<td bgcolor="#dae4ff"><a href="reply.php?QuestionID=<?php echo $row["QuestionID"];?>"><p><?php echo $row["Question"];?></p></a></td>
    		<td align="center" valign="middle" bgcolor="#dae4ff"><?php echo $row["Name"];?></td>
    		<td align="center" valign="middle" bgcolor="#dae4ff"><div align="center"><?php echo $row["CreateDate"];?></div></td>
    		<td align="center" valign="middle" bgcolor="#dae4ff"><?php echo $row["View"];?></td>
    		<td align="center" valign="middle" bgcolor="#dae4ff"><?php echo $row["Reply"];?></td>
  			</tr>
		<?php
			}
		?>
	</table>
    <br>
	Total <?php echo $nRow; ?> Record : <?php echo $Num_Pages; ?> Page :
		<?php
			if($Prev_Page){
				echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page'><< Back</a> ";
			}
			for($i=1; $i<=$Num_Pages; $i++){
				if($i != $Page){
					echo "[ <a href='$_SERVER[SCRIPT_NAME]?Page=$i'>$i</a> ]";
				}else{
					echo "<b> $i </b>";
				}
			}
			if($Page!=$Num_Pages){
				echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page'>Next>></a> ";
			}
		?>              
                </td>
      		</tr>
    	</table>
    <p></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <form action="forum.php?Action=Save" method="post" name="frmMain" id="frmMain">
      <table width="621" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#52679F">
      	<tr>
        	<td colspan="2" bgcolor="#52679F" class="wh">:: ตั้งกระทู้ ::</td>
        </tr>
        <tr>
          <td align="center" valign="middle" bgcolor="#DAE4FF">หัวข้อกระทู้</td>
          <td width="515" bgcolor="#DAE4FF"><input name="txtQuestion" type="text" autofocus="autofocus" id="txtQuestion" value="" size="70" /></td>
        </tr>
        <tr>
          <td width="99" align="center" valign="middle" bgcolor="#DAE4FF">รายละเอียด</td>
          <td align="left" valign="middle" bgcolor="#DAE4FF"><textarea name="txtDetails" cols="50" rows="5" id="txtDetails"></textarea>
            <input name="btnSave" type="submit" id="btnSave" value="ตั้งกระทู้" /></td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p></td>
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
	if (!empty($_GET["Action"])) {
		if($_GET["Action"] == "Save"){
			$sql="insert into webboard (CreateDate,Question,Details,Name) VALUES ";
			$sql=$sql."('".date("Y-m-d H:i:s")."','".$_POST["txtQuestion"]."','".$_POST["txtDetails"]."','".$_SESSION['name']."')";
			$result=mysqli_query($dbcon,$sql);
		}
	}
?>