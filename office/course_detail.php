<?php
	session_start();
	
	include('../config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	$cos_id=$_GET["cos_id"];
	$page=$_GET["page"];
	if (empty($page)){
		$page=1;
	}
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

<script type="text/javascript">

function DelCourse(id){
	if(confirm('ท่านต้องการลบข้อมูลที่เลือกไว้หรือไม่ !')==true){
  		window.location="course_del.php?cos_id="+ id;
	}
}

function Delsubject(cos_id,id){
	if(confirm('ท่านต้องการลบข้อมูลที่เลือกไว้หรือไม่ !')==true){
  		window.location="subject_remove.php?id="+ id + "&cos_id=" + cos_id;
	}
}

function DelSec(cos_id , id){
	if(confirm('ท่านต้องการลบข้อมูลที่เลือกไว้หรือไม่ !')==true){
  		window.location="section_del.php?sec_id="+ id + "&cos_id=" + cos_id;
	}
}
</script>
</head>

<body>
<table width="1024" bgcolor="#FFFFFF" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <?php include '../office/header.php'?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td valign="middle"><img src="../images/cos_bar.png" /><hr /></td>
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
            <td>
              <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#5F7AC3">
                <tr bgcolor="#5F7AC3">
                  <td><div align="center"><span class="style1">รายการ</span></div></td>
                  <td width="100">&nbsp;</td>
                  </tr>
                  <?php
				  	$sql="select cos_id , cos_name from course where cos_id=$cos_id ";
					$result=mysql_db_query($database,$sql);
					$nRow=mysql_num_rows($result);
					$tr=$nRow%$list_page;
					if($rt!=0) { 
						$totalpage = floor($nRow/$list_page)+1; 
					}else {
						$totalpage = floor($nRow/$list_page)+1; 
					}
					$goto = ($page-1)*$list_page;
					$sql=$sql . " limit $goto,$list_page";
					$result=mysql_db_query($database,$sql);
					while($row=mysql_fetch_array($result)){
				  ?>
                <tr>
                  <td bgcolor="#FFFFFF"><b><?php echo $row[1] ?></b>&nbsp;(<a href="discount.php?cos_id=<?php echo $row[0] ?>">ส่วนลด</a>)</td>
                  <td align="center" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                    <tr>
                      <td align="center"><a href="coures_subject_add.php?cos_id=<?php echo $row[0] ?>"><img src="../images/edit_add.png" alt="เพิ่มรายวิชา" width="16" height="16" border="0" /></a></td>
                      <td align="center"><a href="course_frm.php?cos_id=<?php echo $row[0] ?>"><img src="../images/edit_16.png" alt="แก้ไขหลักสูตร" width="16" height="16" border="0" /></a></td>
                      <td align="center"><a href="javascript:DelCourse(<?php echo $row[0] ?>)"><img src="../images/edit_remove.png" alt="ลบหลักสูตร" width="16" height="16" border="0" /></a></td>
                    </tr>
                  </table></td>
                  </tr>
                  <?php
				  	$sql="select subject.sub_id , subject.sub_name , subject.time_sub from subject , course_item  ";
					$sql=$sql . " where course_item.cos_id = $row[0] and subject.sub_id = course_item.sub_id";
					$sql=$sql . " order by course_item.autoid ";
					$result_sub=mysql_db_query($database,$sql);
					while($row_sub=mysql_fetch_array($result_sub)){
				  ?>
                   <tr>
                  <td bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;<?php echo $row_sub[1] ?>&nbsp;&nbsp;( จำนวน <?php echo $row_sub[2] ?> ชั่วโมง )<br />
                  <?php
				  		$sql="select sec_id , sec_name from section where sub_id= $row_sub[0] and cos_id=$row[0] ";
						$sql=$sql . " order by sec_id ";
						$result_sec=mysql_db_query($database,$sql);
						while($row_sec=mysql_fetch_array($result_sec)){
							echo "<a href='subject_section_frm_edit.php?sec_id=$row_sec[0]&sub_id=$row_sub[0]&cos_id=$row[0]'>sec.$row_sec[1]</a> ";
							echo "<a href='javascript:DelSec($row[0] , $row_sec[0])'><img src='../images/edit_remove.png' border='0' /></a>  | ";
						}
				  ?>
                  <a href="subject_section_frm.php?sub_id=<?php echo $row_sub[0] ?>&cos_id=<?php echo $row[0] ?>"><img src="../images/edit_add.png" width="16" height="16" border="0" /></a>
                  </td>
                  <td align="center" bgcolor="#FFFFFF"><a href="javascript:Delsubject(<?php echo $row[0] ?>,<?php echo $row_sub[0] ?>)"><img src="../images/edit_remove.png" alt="ลบรายวิชาออกจากหลักสูตร" width="16" height="16" border="0" /></a></td>
                  </tr>
                  <?php
				  	}
				  }
				  ?>
                <tr>
                  <td colspan="2" bgcolor="#5F7AC3"><?php
					if($nRow!=0){
						echo "<table width=100% border=0 bordercolor=black cellspacing=0 cellpadding=2>\n";
						echo "<tr><td align=right>\n";
						echo "<font size='2'>\n";
						if($page>1 && $page<=$totalpage) {
							$prevpage = $page-1;
							echo "\t<a href='course.php?page=$prevpage'>[Back = $prevpage]</a>\n";
						}
						echo "\t Display $page/$totalpage \n";
	
						if($page!=$totalpage) {
							$nextpage = $page+1;
							echo "\t<a href='course.php?page=$nextpage'>[Next = $nextpage]</a>\n";
						}
						echo "</td></tr>\n";
						echo "<tr><td align=right>\n";
	
						// วนลูปแสดงเลขหน้าทั้งหมด
						for($i=1 ; $i<$page ; $i++) {
							echo "\t<a href='course.php?page=$i'>$i</a> \n";
						}
						echo "\t<font size=2 color=red><b>$page</b></font> \n";
						for($i=$page+1 ; $i<=$totalpage ; $i++) {
							echo "\t<a href='course.php?page=$i'>$i</a> \n";
						}
						echo "</font></td></tr>\n";
						echo "</table>\n";
					}
				?></td>
                  </tr>
              </table>

            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
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
	mysql_close();
?>