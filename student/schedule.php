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
<link href="../bootstrap-3.2.0-dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <?php include "../student/header.php";?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('../student/menu.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="400" align="center" valign="top">
    <table width="95%" border="1" cellspacing="0" cellpadding="0" bordercolor="#6687f2" class="table-condensed">
       <?php
        	$sql="select name,surname from member where member_id=".$_SESSION["id"];
			$result_s=mysqli_query($dbcon,$sql);
			$row_s=mysqli_fetch_array($result_s);
		?>
        
	  <tr>
      	<td colspan="12"  align="center" valign="middle" ><b>ตารางเรียนของ&nbsp;<?php echo $row_s[0]?>&nbsp;&nbsp;<?php echo $row_s[1] ?>
        <b><br /></td>
      </tr>
      <tr>
        <td width="8.3%" bgcolor="#6687f2">วัน/คาบ</td>
        <td width="8.3%" align="center" bgcolor="#6687f2"><p>-1-<br />
          08.30-09.30</p></td>
        <td width="8.3%" align="center" bgcolor="#6687f2"><p>-2-<br />
          09.30-10.30</p></td>
        <td width="8.3%" align="center" bgcolor="#6687f2">-3-<br />
          10.30-11.30 <br /></td>
        <td width="8.3%" align="center" bgcolor="#6687f2">-4-<br />
          11.30-12.30<br /></td>
        <td width="8.3%" align="center" bgcolor="#6687f2">-5-<br />
          12.30-13.30 <br /></td>
        <td width="8.3%" align="center" bgcolor="#6687f2">-6-<br />
          13.30-14.30 <br /></td>
        <td width="8.3%" align="center" bgcolor="#6687f2">-7-<br />
          14.30-15.30 <br /></td>
        <td width="8.3%" align="center" bgcolor="#6687f2">-8-<br />
          15.30-16.30 <br /></td>
        <td width="8.3%" align="center" bgcolor="#6687f2">-9-<br />
          16.30-17.30 <br /></td>
        <td width="8.3%" align="center" bgcolor="#6687f2">-10-<br />
          17.30-18.30 <br /></td>
        <td width="8.3%" align="center" bgcolor="#6687f2">-11-<br />
          18.30-19.30 <br /></td>
      </tr>
      <tr>
        <td bgcolor="#6687f2"><strong>จันทร์</strong></td>
        <?php
			$i=1;
			while($i<=11){
				$sql_1="select section.since,section.until,learn.sub_id,section.sec_name,section.room,learn.cos_id from section,learn";
				$sql_2=$sql_1." where section.sec_id=learn.sec_id and learn.member_id = ".$_SESSION["id"];
				$sql=$sql_2." and day = 2 and since = $i";
				
				$result=mysqli_query($dbcon,$sql);
				$nRow=mysqli_num_rows($result);
				if($nRow == 0 ){
					echo "<td class='bor'>&nbsp;</td>";
				}else{
					$row=mysqli_fetch_array($result);
					$sec_name=$row[3];
					
					$sql="select sub_name from subject where sub_id =$row[2]";
					$result_sub=mysqli_query($dbcon,$sql);
					$row_sub=mysqli_fetch_array($result_sub);
					$sub_name=$row_sub[0];
					
										
					$since=$i;
					$until=$row[1];
					$col=($row[1]-$i)+1;
					echo "<td colspan='$col' align='center' class='bor' bgcolor='#e7ecfe'>$row_sub[0]<br>กลุ่มเรียน.&nbsp;$sec_name&nbsp;($row[4])";
					if($row[5] !=0){
						$sql="select cos_name from course where cos_id=$row[5]";
						$result_s=mysqli_query($dbcon,$sql);
						$row_s=mysqli_fetch_array($result_s);
						echo "<br>หลักสูตร :&nbsp;$row_s[0]";
					}
					echo "</td>";
					$i=$until;
				}
				
				$i++;
			}
		?>
      </tr>
      <tr>
        <td bgcolor="#6687f2"><strong>อังคาร</strong></td>
        <?php
			$i=1;
			while($i<=11){
				$sql_1="select section.since,section.until,learn.sub_id,section.sec_name,section.room,learn.cos_id from section,learn";
				$sql_2=$sql_1." where section.sec_id=learn.sec_id and learn.member_id = ".$_SESSION["id"];
				$sql=$sql_2." and day = 3 and since = $i";
				$result=mysqli_query($dbcon,$sql);
				$nRow=mysqli_num_rows($result);
				if($nRow == 0 ){
					echo "<td class='bor'>&nbsp;</td>";
				}else{
					$row=mysqli_fetch_array($result);
					$sec_name=$row[3];
					
					$sql="select sub_name from subject where sub_id =$row[2]";
					$result_sub=mysqli_query($dbcon,$sql);
					$row_sub=mysqli_fetch_array($result_sub);
					$sub_name=$row_sub[0];
					
										
					$since=$i;
					$until=$row[1];
					$col=($row[1]-$i)+1;
					echo "<td colspan='$col' align='center' class='bor' bgcolor='#e7ecfe'>$row_sub[0]<br>กลุ่มเรียน.&nbsp;$sec_name&nbsp;($row[4])";
					if($row[5] !=0){
						$sql="select cos_name from course where cos_id=$row[5]";
						$result_s=mysqli_query($dbcon,$sql);
						$row_s=mysqli_fetch_array($result_s);
						echo "<br>หลักสูตร :&nbsp;$row_s[0]";
					}
					echo "</td>";
					$i=$until;
				}				
				$i++;
			}
		?>
      </tr>
      <tr>
        <td bgcolor="#6687f2"><strong>พุธ</strong></td>
                <?php
			$i=1;
			while($i<=11){
				$sql_1="select section.since,section.until,learn.sub_id,section.sec_name,section.room,learn.cos_id from section,learn";
				$sql_2=$sql_1." where section.sec_id=learn.sec_id and learn.member_id = ".$_SESSION["id"];
				$sql=$sql_2." and day = 4 and since = $i";
				$result=mysqli_query($dbcon,$sql);
				$nRow=mysqli_num_rows($result);
				if($nRow == 0 ){
					echo "<td class='bor'>&nbsp;</td>";
				}else{
					$row=mysqli_fetch_array($result);
					$sec_name=$row[3];
					
					$sql="select sub_name from subject where sub_id =$row[2]";
					$result_sub=mysqli_query($dbcon,$sql);
					$row_sub=mysqli_fetch_array($result_sub);
					$sub_name=$row_sub[0];
					
										
					$since=$i;
					$until=$row[1];
					$col=($row[1]-$i)+1;
					echo "<td colspan='$col' align='center' class='bor' bgcolor='#e7ecfe'>$row_sub[0]<br>กลุ่มเรียน.&nbsp;$sec_name&nbsp;($row[4])";
					if($row[5] !=0){
						$sql="select cos_name from course where cos_id=$row[5]";
						$result_s=mysqli_query($dbcon,$sql);
						$row_s=mysqli_fetch_array($result_s);
						echo "<br>หลักสูตร :&nbsp;$row_s[0]";
					}
					echo "</td>";
					$i=$until;
				}
				
				$i++;
			}
		?>
      </tr>
      <tr>
        <td bgcolor="#6687f2"><strong>พฤหัสบดี</strong></td>
        <?php
			$i=1;
			while($i<=11){
				$sql_1="select section.since,section.until,learn.sub_id,section.sec_name,section.room,learn.cos_id from section,learn";
				$sql_2=$sql_1." where section.sec_id=learn.sec_id and learn.member_id = ".$_SESSION["id"];
				$sql=$sql_2." and day = 5 and since = $i";
				$result=mysqli_query($dbcon,$sql);
				$nRow=mysqli_num_rows($result);
				if($nRow == 0 ){
					echo "<td class='bor'>&nbsp;</td>";
				}else{
					$row=mysqli_fetch_array($result);
					$sec_name=$row[3];
					
					$sql="select sub_name from subject where sub_id =$row[2]";
					$result_sub=mysqli_query($dbcon,$sql);
					$row_sub=mysqli_fetch_array($result_sub);
					$sub_name=$row_sub[0];
					
										
					$since=$i;
					$until=$row[1];
					$col=($row[1]-$i)+1;
					echo "<td colspan='$col' align='center' class='bor' bgcolor='#e7ecfe'>$row_sub[0]<br>กลุ่มเรียน.&nbsp;$sec_name&nbsp;($row[4])";
					if($row[5] !=0){
						$sql="select cos_name from course where cos_id=$row[5]";
						$result_s=mysqli_query($dbcon,$sql);
						$row_s=mysqli_fetch_array($result_s);
						echo "<br>หลักสูตร :&nbsp;$row_s[0]";
					}
					echo "</td>";
					$i=$until;
				}
				
				$i++;
			}
		?>
      </tr>
      <tr>
        <td bgcolor="#6687f2"><strong>ศุกร์</strong></td>
        <?php
			$i=1;
			while($i<=11){
				$sql_1="select section.since,section.until,learn.sub_id,section.sec_name,section.room,learn.cos_id from section,learn";
				$sql_2=$sql_1." where section.sec_id=learn.sec_id and learn.member_id = ".$_SESSION["id"];
				$sql=$sql_2." and day = 6 and since = $i";
				$result=mysqli_query($dbcon,$sql);
				$nRow=mysqli_num_rows($result);

				if($nRow == 0 ){
					echo "<td class='bor'>&nbsp;</td>";
				}else{
					$row=mysqli_fetch_array($result);
					$sec_name=$row[3];
					
					$sql="select sub_name from subject where sub_id =$row[2]";
					$result_sub=mysqli_query($dbcon,$sql);
					$row_sub=mysqli_fetch_array($result_sub);
					$sub_name=$row_sub[0];
					
										
					$since=$i;
					$until=$row[1];
					$col=($row[1]-$i)+1;
					echo "<td colspan='$col' align='center' class='bor' bgcolor='#e7ecfe'>$row_sub[0]<br>กลุ่มเรียน.&nbsp;$sec_name&nbsp;($row[4])";
					if($row[5] !=0){
						$sql="select cos_name from course where cos_id=$row[5]";
						$result_s=mysqli_query($dbcon,$sql);
						$row_s=mysqli_fetch_array($result_s);
						echo "<br>หลักสูตร :&nbsp;$row_s[0]";
					}
					echo "</td>";
					$i=$until;
				}
				
				$i++;
			}
		?>
      </tr>
      <tr>
        <td bgcolor="#6687f2"><strong>เสาร์</strong></td>
        <?php
			$i=1;
			while($i<=11){
				$sql_1="select section.since,section.until,learn.sub_id,section.sec_name,section.room,learn.cos_id from section,learn";
				$sql_2=$sql_1." where section.sec_id=learn.sec_id and learn.member_id = ".$_SESSION["id"];
				$sql=$sql_2." and day = 7 and since = $i";
				$result=mysqli_query($dbcon,$sql);
				$nRow=mysqli_num_rows($result);
				if($nRow == 0 ){
					echo "<td class='bor'>&nbsp;</td>";
				}else{
					$row=mysqli_fetch_array($result);
					$sec_name=$row[3];
					
					$sql="select sub_name from subject where sub_id =$row[2]";
					$result_sub=mysqli_query($dbcon,$sql);
					$row_sub=mysqli_fetch_array($result_sub);
					$sub_name=$row_sub[0];
					
										
					$since=$i;
					$until=$row[1];
					$col=($row[1]-$i)+1;
					echo "<td colspan='$col' align='center' class='bor' bgcolor='#e7ecfe'>$row_sub[0]<br>กลุ่มเรียน.&nbsp;$sec_name&nbsp;($row[4])";
					if($row[5] !=0){
						$sql="select cos_name from course where cos_id=$row[5]";
						$result_s=mysqli_query($dbcon,$sql);
						$row_s=mysqli_fetch_array($result_s);
						echo "<br>หลักสูตร :&nbsp;$row_s[0]";
					}
					echo "</td>";
					$i=$until;
				}
				
				$i++;
			}
		?>
      </tr>
      <tr>
        <td bgcolor="#6687f2"><strong>อาทิตย์</strong></td>
        <?php
			$i=1;
			while($i<=11){
				$sql_1="select section.since,section.until,learn.sub_id,section.sec_name,section.room,learn.cos_id from section,learn";
				$sql_2=$sql_1." where section.sec_id=learn.sec_id and learn.member_id = ".$_SESSION["id"];
				$sql=$sql_2." and day = 1 and since = $i";
				$result=mysqli_query($dbcon,$sql);
				$nRow=mysqli_num_rows($result);
				if($nRow == 0 ){
					echo "<td class='bor'>&nbsp;</td>";
				}else{
					$row=mysqli_fetch_array($result);
					$sec_name=$row[3];
					
					$sql="select sub_name from subject where sub_id =$row[2]";
					$result_sub=mysqli_query($dbcon,$sql);
					$row_sub=mysqli_fetch_array($result_sub);
					$sub_name=$row_sub[0];
					
										
					$since=$i;
					$until=$row[1];
					$col=($row[1]-$i)+1;
					echo "<td colspan='$col' align='center' class='bor' bgcolor='#e7ecfe'>$row_sub[0]<br>กลุ่มเรียน.&nbsp;$sec_name&nbsp;($row[4])";
					if($row[5] !=0){
						$sql="select cos_name from course where cos_id=$row[5]";
						$result_s=mysqli_query($dbcon,$sql);
						$row_s=mysqli_fetch_array($result_s);
						echo "<br>หลักสูตร :&nbsp;$row_s[0]";
					}
					echo "</td>";
					$i=$until;
				}
				
				$i++;
			}
		?>
      </tr>
    </table></td>
</tr>
</table>
</body>
</html>
<?php
	mysqli_close($dbcon);
?>