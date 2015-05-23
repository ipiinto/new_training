<?php
	if($_SESSION['state']=='นักเรียน'){
?>	
	<table width='100%' border='0' cellspacing='2' cellpadding='2'>
		<tr>
			<td width='79' align="center" valign='middle'><div align='center'><a href='../student/index.php'><strong>หน้าหลัก</strong></a></div></td>
		  <td width="137" align="center" valign="middle"><div align="center"><strong><a href="../student/list_subject.php">รายวิชาที่เปิดสอน</a></strong></div></td>
		  <td width="111" align="center" valign="middle"><div align="center"><strong><a href="../student/schedule.php">ตารางสอน</a></strong></div></td>
    	  <td width="111" align="center" valign="middle"><div align="center"><strong><a href="../student/logout.php"></a></strong><strong><a href="../student/logout.php">ออกจากระบบ</a></strong></div></td>
			<td width="628" align="center" valign="middle">&nbsp;</td>
  		</tr>
	</table>
<?php	
	}elseif($_SESSION['state']=='อาจารย์'){
?>
	<table width="100%" border="0" cellspacing="2" cellpadding="2">
		<tr>
			<td width="85" align="center" valign="middle"><div align="center"><a href="../teacher/index.php"><strong>หน้าหลัก</strong></a></div></td>
		  <td width="143" align="center" valign="middle"><div align="center"><strong><a href="../teacher/subject.php">รายวิชาที่สอน</a></strong></div></td>
		  <td width="47" align="center" valign="middle"><div align="center"><strong><a href="../teacher/#">ติดต่อ</a></strong></div></td>
   		  <td width="134" align="center" valign="middle"><div align="center"><strong><a href="../teacher/logout.php">ออกจากระบบ</a></strong></div></td>
    		<td width="627" align="center" valign="middle">&nbsp;</td>
  		</tr>
	</table>

<?php
	}elseif($_SESSION['state']=='ผู้ดูแลระบบ'){
?>

	<link href="../style.css" rel="stylesheet" type="text/css">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="83" align="center" valign="middle" class="tab"><div align="center" class="tab"><a href="../office/index.php"><strong>หน้าหลัก</strong></a></div></td>
		  <td width="100" align="center" valign="middle" class="tab"><div align="center" class="tab"><strong><a href="../office/member.php">จัดการสมาชิก</a></strong></div></td>
		  <td width="116" align="center" valign="middle" class="tab"><div align="center" class="tab"><strong><a href="../office/course.php">จัดการหลักสูตร</a></strong></div></td>
		  <td width="126" align="center" valign="middle" class="tab"><div align="center" class="tab"><strong><a href="../office/news_frm.php"><strong>ข่าวประชาสัมพันธ์</strong></a></strong></div></td>
		  <td width="105" align="center" valign="middle" class="tab"><div align="center" class="tab"><strong><a href="../office/log_off.php">ออกจากระบบ</a></strong></div></td>
			<td width="558" align="center" valign="middle" class="tab">&nbsp;</td>
		</tr>
	</table>


<?php
	}
?>