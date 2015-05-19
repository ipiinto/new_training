<?php
	session_start();
?>
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
<table cellspacing="0" cellpadding="0" width="80%" align="center" border="#000000">
	<tr>
		<td colspan="11"><img src="../images/bill_header1.jpg" width="100%" height="100px" border="1"></td>
	</tr>
    <!--|||||||||||||||-->
	<tr>
	    <td>
	        <table cellpadding="1" cellspacing="1" border="1" align="center" width="100%" class="table-condensed">
	        	<div class="panel-heading">
		        	<tr bgcolor="#F2F0F0">
		        		<td align="center" colspan="6"><strong> บัตรลงทะเบียนของคุณ &nbsp; <?php $callmem = call_member($member_id); echo ($callmem['name']); ?>&nbsp;&nbsp;<?php echo ($callmem['surname']) ?></strong></td>
		        	</tr>
		        </div>
	            <tr align="center" bgcolor="#F2F0F0">
	                <!-- <td width="17%"><strong>หลักสูตร</strong></td> -->
	                <td width="16%"><strong>รายวิชา</strong></td>
	                <td width="8%"><strong>กลุ่มเรียน</strong></td>
	                <td width="18%"><strong>ผู้สอน</strong></td>
	                <td width="20%"><strong>เวลา/ห้อง</strong></td>
	                <!-- <td width="8%"><strong>ส่วนลด</strong></td> -->
	                <td width="17%"><strong>จำนวนเงิน</strong></td>
	            </tr>
<?php
	check_member_regis_in_course ($member_id);
	function call_member($member_id){
		include('../config/config.php');
		mysql_connect($host,$hostuser,$hostpass);
		mysql_query("SET NAMES UTF8");
		$sql_name = "SELECT name, surname FROM member WHERE member_id = $member_id";
		$results = mysql_db_query($database,$sql_name);
		$rows = mysql_fetch_array($results);
		return $rows;
		//echo $sql_name;
	}

	function check_member_regis_in_course ($member_id){
		global $price_1;
		global $price_2;
		global $discount;
		#นับจำนวนรายวิชาที่ลงทะเบียนไปในแต่ละหลักสูตร
		include('../config/config.php');
        $cos_id=$_GET['cos_id'];
/*		mysql_connect($host,$hostuser,$hostpass);
		mysql_query("SET NAMES UTF8");
		$sql_select_course_in_member = "SELECT DISTINCT cos_id FROM learn WHERE member_id = $member_id";
		$results_4 = mysql_db_query($database,$sql_select_course_in_member);*/
		//while($rows = mysql_fetch_array($results_4)){
			//$cos_id = $rows['cos_id'];
			$sql_count_subject_in_course = "SELECT COUNT( sub_id ) FROM  learn WHERE cos_id = $cos_id AND member_id = $member_id";								
			$results_5 = mysql_db_query($database,$sql_count_subject_in_course);
			echo "<font color='#e31e1e'>";
			$row = mysql_fetch_array($results_5);
			$var_1 = $row[0];
			echo "</font>";
			$sql_select_course_in_course_item = "SELECT COUNT( sub_id ) FROM course_item WHERE cos_id = $cos_id";
			$results_5 = mysql_db_query($database,$sql_select_course_in_course_item);
			echo "<font color='#7B52E3'>";
			$row = mysql_fetch_array($results_5);
			$var_2 = $row[0];
            $sql_course_name="SELECT course.cos_name FROM course WHERE cos_id = $cos_id";
            $results_5 = mysql_db_query($database,$sql_course_name);
            $row = mysql_fetch_array($results_5);
            $var_name = $row[0];
			echo "</font>";
			$i = 0;
			if ($var_1 == $var_2) {
				# code...
				//echo $var_1," ",$var_2," หลักสูตร","</br>";
				echo "<tr>";
				echo "<td colspan = '5' bgcolor = '#ccccff'><strong>หลักสูตร&nbsp;",$var_name,"&nbsp;จำนวน ",$var_1," วิชา","</strong></td>";
				echo "</tr>";
				$sql_base = "SELECT learn.sub_id, learn.sec_id, learn.cos_id
								FROM  learn
								INNER JOIN member
								ON learn.member_id = member.member_id
								WHERE learn.member_id = $member_id
								AND learn.cos_id = $cos_id";
				$results = mysql_db_query($database,$sql_base);
				while ($rows = mysql_fetch_array($results)) {
					echo "<tr>";
					//print_r($rows);
					//echo "</br>";
					$cos_id = $rows['cos_id'];
					$sec_id = $rows['sec_id'];
					$sub_id = $rows['sub_id'];		
					$sql_final = "SELECT course.cos_name, section.sec_name, subject.sub_name, teacher.name AS tName,teacher.surname AS tsName, section.day AS sDay, section.since AS sSnc, section.until AS sUnt, section.room AS sRm, subject.price AS sPrice
									FROM course, section, subject, member, teacher
									WHERE course.cos_id = $cos_id
									AND section.sec_id = $sec_id
									AND subject.sub_id = $sub_id
									AND member.member_id = $member_id
									AND teacher.teacher_id = section.teacher_id";
					$results_2 = mysql_db_query($database,$sql_final);
					$rows = mysql_fetch_array($results_2);
					$strDay = getDay($rows["sDay"]);
					$strSince = getSince($rows["sSnc"]);
					$strUntil = getUntil($rows["sUnt"]);
					$Date = $strDay.$strSince."-".$strUntil."/".$rows["sRm"];
					/*echo "<td align='center'>",$rows['cos_name'],"</td>";*/
					echo "<td align='center'>",$rows['sub_name'],"</td>";
					echo "<td align='center'>",$rows['sec_name'],"</td>";
					echo "<td align='center'>",$rows['tName'],"&nbsp;&nbsp;",$rows['tsName'],"</td>";
					echo "<td align='center'>",$Date,"</td>";
					echo "<td align='center'>",$rows['sPrice'],"</td>";
					/*echo "<td align='center'>","-","</td>";  */
					echo "</tr>";	
					//print_r($rows);
					//echo "</br>";
				}
				$sql_select_price_n_discount = "SELECT price, discount 
														FROM  course 
														WHERE cos_id = $cos_id";
				$results = mysql_db_query($database,$sql_select_price_n_discount);
				$row = mysql_fetch_array($results);
/*				echo "<tr bgcolor = '#FF9999'>";
				echo "<td colspan = '5'>รวมราคาจ่ายแบบหลักสูตร","</td>";
				echo "<td align='center'>",$row['discount'],"</td>";
				echo "<td align='center'>",$row['price'],"</td>";
				echo "</tr>";*/
				//$GLOBALS['price'] = $row["price"] + $GLOBALS['price'];
				//$GLOBALS['discount'] = $row["discount"] + $GLOBALS['discount'];
				$price_1 = $row["price"] + $price_1;
				$discount = $row["discount"] + $discount;
				//call_detail($member_id, $cos_id, $sub_id = -1, $i);
			} else {
				# code...
				//echo $var_1," ",$var_2," รายวิชา","</br>";
				//echo($cos_id);
				$sql_select_from_subject = "SELECT learn.sub_id AS sub_id, learn.sec_id, subject.sub_name AS sNme, subject.price AS price, learn.cos_id
												FROM subject, learn
												WHERE learn.sub_id = subject.sub_id
												AND learn.cos_id = $cos_id
												AND learn.member_id = $member_id";
				$results = mysql_db_query($database,$sql_select_from_subject);
				while ($rows = mysql_fetch_array($results)) {
					echo "<tr>";
					//print_r($rows);
					//echo "</br>";
					//$cos_id = $rows['cos_id'];
					$sub_id = $rows['sub_id'];	
					$sec_id = $rows['sec_id'];	
					$sql_final = "SELECT course.cos_name, section.sec_name, subject.sub_name, teacher.name AS tName,teacher.surname AS tsName, section.day AS sDay, section.since AS sSnc, section.until AS sUnt, section.room AS sRm, subject.price AS price
									FROM course, section, subject, member, teacher
									WHERE subject.sub_id = $sub_id
									AND section.sec_id = $sec_id
									AND member.member_id = $member_id
									AND teacher.teacher_id = section.teacher_id";
					$results_2 = mysql_db_query($database,$sql_final);
					$rows = mysql_fetch_array($results_2);
					$strDay = getDay($rows["sDay"]);
					$strSince = getSince($rows["sSnc"]);
					$strUntil = getUntil($rows["sUnt"]);
					$Date = $strDay.$strSince."-".$strUntil."/".$rows["sRm"];
					/*echo "<td align='center'>","-","</td>";*/
					echo "<td align='center'>",$rows['sub_name'],"</td>";
					echo "<td align='center'>",$rows['sec_name'],"</td>";
					echo "<td align='center'>",$rows['tName'],"&nbsp;&nbsp;",$rows['tsName'],"</td>";
					echo "<td align='center'>",$Date,"</td>";
					/*echo "<td align='center'>","-","</td>";*/
					echo "<td align='center'>",$rows['price'],"</td>";  
					echo "</tr>";	
					$price_2 = $rows["price"] + $price_2;
					//print_r($rows);
					//echo "</br>";
				}
			}
		//}
/*		echo "<tr bgcolor = '#FF9999'>";
		echo "<td colspan = '5'>รวมราคาจ่ายแบบรายวิชา","</td>";
		echo "<td align='center'>","-","</td>";
		echo "<td align='center'>",$price_2,"</td>";
		echo "</tr>";*/
	}
	
echo "<tr bgcolor = '#F2F0F0'>";
echo "<td colspan = '3' align='right'><strong>รวม","</strong></td>";
if($discount==""){
    $discount="-";
}
echo "<td align='center'><strong>ส่วนลด</strong>&nbsp;&nbsp;",$discount,"</td>";
echo "<td align='center'>",$price_1+$price_2,"</td>";
echo "</tr>";
echo "<tr bgcolor = '#b7adad'>";
echo "<td colspan = '3' align='right'><strong>รวมราคาทั้งสิ้น","<strong></td>";
echo "<td align='center' colspan = '2'>",$price_1+$price_2-$discount,"</td>";
echo "</tr>";
echo "</table>";
echo "</table>";
?>
</div>
<br /> 
<div align="center">
	<!-- <input type="button" value="พิมพ์บัตรลงทะเบียน" class="btn btn-primary" onclick="printDiv('print_bill')"> -->
	<button type="button" onclick="printDiv('print_bill')" class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span><span>&nbsp;พิมพ์บัตรลงทะเบียน</span></button>
</div>
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
			$si='8:30';	
		}elseif($s==2){
			$si='9:30';	
		}elseif($s==3){
			$si='10:30';	
		}elseif($s==4){
			$si='11:30';	
		}elseif($s==5){
			$si='12:30';	
		}elseif($s==6){
			$si='13:30';	
		}elseif($s==7){
			$si='14:30';	
		}elseif($s==8){
			$si='15:30';	
		}elseif($s==9){
			$si='16:30';	
		}elseif($s==10){
			$si='17:30';	
		}elseif($s==11){
			$si='18:30';	
		}else{
			$si='19:30';	
		}
		return $si;	
	}
	
	function getUntil($u){
		if($u==2){
			$ut='9:30';	
		}elseif($u==3){
			$ut='10:30';	
		}elseif($u==4){
			$ut='11:30';	
		}elseif($u==5){
			$ut='12:30';	
		}elseif($u==6){
			$ut='13:30';	
		}elseif($u==7){
			$ut='14:30';	
		}elseif($u==8){
			$ut='15:30';	
		}elseif($u==9){
			$ut='16:30';	
		}elseif($u==10){
			$ut='17:30';	
		}elseif($u==11){
			$ut='18:30';	
		}else{
			$ut='19:30';	
		}
		return $ut;	
	}
?>