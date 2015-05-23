<?php
	session_start();
	include('../config/config.php');
	$member_id = $_SESSION['id'];
	$sql_select_course_in_member = "SELECT DISTINCT cos_id FROM learn WHERE member_id = $member_id";
	//เดึงหลักสูตรที่สมาชิกเรียนออกมาก่อน
	$results_4 = mysqli_query($dbcon,$sql_select_course_in_member);
	while($rows = mysqli_fetch_array($results_4))
	{
		$cos_id = $rows['cos_id'];
		$sql_count_subject_in_course = "SELECT COUNT( sub_id ) 
										FROM  learn 
										WHERE cos_id = $cos_id AND member_id = $member_id";
										
		$results_5 = mysqli_query($dbcon,$sql_count_subject_in_course);
		echo "<font color='#e31e1e'>";
		$row = mysqli_fetch_array($results_5);
		$var_1 = $row[0];
		echo "</font>";
		$sql_select_course_in_course_item = "SELECT COUNT( sub_id ) 
												FROM course_item
												WHERE cos_id = $cos_id";
		$results_5 = mysqli_query($dbcon,$sql_select_course_in_course_item);
		echo "<font color='#7B52E3'>";
		$row = mysqli_fetch_array($results_5);
		$var_2 = $row[0];
		echo "</font>";
		$i = 0;
		if ($var_1 == $var_2) {
			# คิดแบบหลักสูตร
			//echo $var_1," ",$var_2,"หลักสูตร";
			$sql="SELECT price,discount from course where cos_id=$cos_id";
			$result=mysqli_query($dbcon,$sql);
			$rowss=mysqli_fetch_array($result);
			$totals=$rowss[0]-$rowss[1];
		} else {
			# คิดแบบรายวิชา
			//echo $var_1," ",$var_2,"รายวิชา";
			$sql="SELECT SUM(subject.price) AS Total FROM subject,learn where subject.sub_id=learn.sub_id and learn.member_id=".$_SESSION['id'];
            $result=mysqli_query($dbcon,$sql) or die($sql);
			$rws=mysqli_fetch_array($result);
			
		}
	}
	
	
?>
<link href="../bootstrap-3.2.0-dist/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<link href="../bootstrap-3.2.0-dist/css/bootstrap.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	function printDiv(print_bill) {
     var printContents = document.getElementById(print_bill).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;
     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<div id="print_bill">
<table cellpadding="0" cellspacing="0" border="1" align="center" width="80%">
	<tr>
		<td><img src="../images/bill_header1.jpg" width="100%" height="100px"></td>
	</tr>
<?php
	$sql="select name,surname from member where member_id=".$_SESSION['id'];
	$results=mysqli_query($dbcon,$sql);
	$rows=mysqli_fetch_array($results);
?>

	<br/>
	<tr>
		<td>
        <div class="panel-default">
         <div class="panel-heading">บัตรลงทะเบียน ของ <b><?=$rows["name"]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$rows["surname"]?></b></div>
			<table cellpadding="1" cellspacing="1" border="0" align="center" width="70%" class="table">
				<tr align="center" bgcolor="#F2F0F0">
					<td><strong>หลักสูตร</strong></td>
					<td><strong>กลุ่มเรียน</strong></td>
					<td><strong>รายวิชา</strong></td>
					<td><strong>ผู้สอน</strong></td>
					<td><strong>เวลา/ห้อง</strong></td>
					<td><strong>จำนวนเงิน(บาท)</strong></td>
				</tr>

				<?php
					$sql= "SELECT course.cos_name, section.sec_name,subject.sub_name,teacher.name,section.day,section.since,section.until,section.room,subject.price,course.discount,course.price AS cPrice FROM course
     						inner join course_item
          					ON course.cos_id = course_item.cos_id 
     						inner join subject
          					ON course_item.sub_id = subject.sub_id
     						inner join section
          					ON subject.sub_id=section.sub_id
          					inner join teacher
          					on section.teacher_id=teacher.teacher_id
     						inner join learn
          					ON section.sec_id=learn.sec_id
     						inner join member
          					ON member.member_id=learn.member_id
					where learn.member_id=".$_SESSION['id'];
					$result=mysqli_query($dbcon,$sql) or die($sql);
					while($row=mysqli_fetch_array($result)){
						$strDay=getDay($row[4]);
						$strSince=getSince($row[5]);
						$strUntil=getUntil($row[6]);
				?>
				<tr>
		            <td align="center" valign="middle"><?=$row[0];?></td>
		            <td align="center" valign="middle"><?=$row[1];?></td>
		            <td align="center" valign="middle"><?=$row[2];?></td>
		            <td align="center" valign="middle"><?=$row[3];?></td>
		            <td align="center" valign="middle"><?=$strDay?>&nbsp;<?=$strSince?>-<?=$strUntil?> /
					<?=$row[7]?>
		            </td>
		             <td align="center" valign="middle"><?=$row[8];?></td>
		        </tr>
				<?php	
					}	
				?>
                <tr>
                	<td colspan="5" align="right"><strong>รวม</strong></td>
                    <?php
                    	$sql="SELECT SUM(subject.price) AS TotalPrice FROM subject,learn where subject.sub_id=learn.sub_id and learn.member_id=".$_SESSION['id'];
                    	$result=mysqli_query($dbcon,$sql) or die($sql);
						$rw=mysqli_fetch_array($result);
					?>
                    <td><u><b><?=$rw["TotalPrice"];?> </b>&nbsp;</u>บาท</td>
                </tr>
                <tr>
                	<?php
                    	$sql_dis="select course.discount,course.cos_id from learn,course where learn.cos_id=course.cos_id and learn.member_id=".$_SESSION['id'];
						$results=mysqli_query($dbcon,$sql_dis) or die($sql_dis);
						$roww=mysqli_fetch_array($results);
						//echo $sql_dis;
					?>
                	<td colspan="3" align="right">
                    	ส่วนลด
                    </td>
                    <td align="center">
                    	<b><?=$roww[0];?></b>
                    </td>
                    <td align="right">
                    	<b>คงเหลือ</b>
                    </td>
                    <td>
                    <u>
                    	<?php
                    		$dis=$rw["TotalPrice"]-$roww[0];
                    	?>
                    	<b><?=$dis?></b>
                    </u>
                    บาท
                    </td>
                </tr>
			</table>
            </div>
	  </td>
	</tr>
</table>
</div>
<br>
<div align="center"><input type="button" value="พิมพ์บัตรลงทะเบียน" onclick="printDiv('print_bill')"></div>
<hr>
<table>
<?php
	$sql="SELECT course.cos_name, subject.sub_name
			FROM course
			INNER JOIN course_item ON course.cos_id = course_item.cos_id
			INNER JOIN subject ON course_item.sub_id = subject.sub_id
			WHERE course.cos_id =$roww[1]";
	$result=mysqli_query($dbcon,$sql) or die($sql);
	while($row=mysqli_fetch_array($result)){
?>
	<tr>
		<td>
			<?=$row[0];?>
		</td>
		<td>
			<?=$row[1]?>
		</td>
	</tr>
<?php
	}
?>
</table>
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