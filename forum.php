<?
	session_start();
	if($_SESSION["login"]=="")echo "<script language=\"javascript\">window.location.href = 'index.php'</script>";
	include("config/config.php");
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	if($_GET["Action"] == "Save"){
		$sql="insert into webboard (CreateDate,Question,Details,Name) VALUES ";
		$sql=$sql."('".date("Y-m-d H:i:s")."','".$_POST["txtQuestion"]."','".$_POST["txtDetails"]."','".$_SESSION['login']."') ";
		$result=mysql_db_query($database,$sql);
	}
	
?>
	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $ribon; ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <? if ($_SESSION['state']=='นักเรียน'){
			include "student/header.php"; 
			} else if ($_SESSION['state']=='อาจารย์'){
				include "teacher/header.php";
				}
				else if ($_SESSION['state']=='ผู้ดูแลระบบ'){
					include "office/header.php";
				}
		 ?>
      </tr>
    </table><a href="../index.php"></a></td>
  </tr>
  <tr>
    <td height="46" valign="top" background="images/bg_menu.png"><? include('menu.php') ?></td>
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
        	$sql="select * from webboard";
			$result=mysql_db_query($database,$sql);
			$nRow=mysql_num_rows($result);
			$Per_Page = 10;   // Per Page
			$Page = $_GET["Page"];
			if(!$_GET["Page"]){
				$Page=1;
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
			$result=mysql_db_query($database,$sql);
			
		?>
	<table width="909" border="1" align="center" cellpadding="0" cellspacing="0">

		<tr>
			<th width="98" bgcolor="#52679F"> <div align="center" class="wh">ลำดับ</div></th>
			<th width="426" bgcolor="#52679F"> <div align="left" class="wh">หัวข้อกระทู้</div></th>
			<th width="86" bgcolor="#52679F"> <div align="center" class="wh">ชื่อผู้ใช้</div></th>
			<th width="119" bgcolor="#52679F"> <div align="center" class="wh">สร้างเมื่อ</div></th>
			<th width="70" bgcolor="#52679F"> <div align="center" class="wh">ยอดชม</div></th>
			<th width="70" bgcolor="#52679F"> <div align="center" class="wh">ตอบกลับ</div></th>
		</tr>

        <?
			while($row=mysql_fetch_array($result)){

		?>
		<tr>
			<td><div align="center"><? echo $row["QuestionID"];?></div></td>
			<td><a href="reply.php?QuestionID=<? echo $row["QuestionID"];?>"><p><? echo $row["Question"];?></p></a></td>
    		<td><? echo $row["Name"];?></td>
    		<td><div align="center"><? echo $row["CreateDate"];?></div></td>
    		<td align="center"><? echo $row["View"];?></td>
    		<td align="center"><? echo $row["Reply"];?></td>
  			</tr>
		<?
			}
		?>
	</table>
    <br>
	Total <? $nRow; ?> Record : <? $Num_Pages; ?> Page :
		<?
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
    <form action="forum.php?Action=Save" method="post" name="frmMain" id="frmMain">
      <table width="621" border="1" cellpadding="1" cellspacing="1">
        <tr>
          <td>หัวข้อกระทู้</td>
          <td width="647"><input name="txtQuestion" type="text" id="txtQuestion" value="" size="70" /></td>
        </tr>
        <tr>
          <td width="78">รายละเอียด</td>
          <td><textarea name="txtDetails" cols="50" rows="5" id="txtDetails"></textarea></td>
        </tr>
      </table>
      <input name="btnSave" type="submit" id="btnSave" value="Submit" />
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