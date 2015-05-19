<?php
	session_start();
	
	include('../config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	$page=$_GET["page"];
	if (empty($page)){
		$page=1;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $ribon ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../bootstrap-3.2.0-dist/css/bootstrap.css">
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
<table width="1024" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
            <td>
              <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#5F7AC3" class="table table-hover ">
              	<thead>
	                <tr>
	                  <th bgcolor="#5F7AC3"><div align="center"><span class="style1">รายการ</span></div></th>
	                  <th width="100" align="center" bgcolor="#5F7AC3"><a href="subject_frm.php">เปิดวิชาใหม่</a></th>
	                </tr>
	            </thead>
                <?php
				  	$sql="select cos_id , cos_name , price ,discount from course order by cos_id ";
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
					$disc=$row[2]-$row[3];
				  ?>
				<thead>
	                <tr>
	                  <th bgcolor="#FFFFFF"><b><a href='course_detail.php?cos_id=<?php echo $row[0]?>'><?php echo $row[1] ?></a></b>
	                    &nbsp;&nbsp;( <a href='course_price.php?cos_id=<?php echo $row[0] ?>'><?php echo $row[2] ?></a> บาท )
						&nbsp; ลดเหลือ <font color="#FF0000"><b><?php echo $disc ?></b></font>
	                  </th>
	                  <th align="center" bgcolor="#FFFFFF">
	                  	<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table-hover table-condensed">
	                  		<thead>
			                    <tr>
			                      <th align="center"><a href="coures_subject_add.php?cos_id=<?php echo $row[0] ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></th>
			                      <th align="center"><a href="course_frm.php?cos_id=<?php echo $row[0] ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></th>
			                      <th align="center"><a href="javascript:DelCourse(<?php echo $row[0] ?>)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></th>
			                    </tr>
			                </thead>
	                    </table>
	                  </th>
	                 </tr>
	            </thead>
                <?php
				  	$sql="select subject.sub_id , subject.sub_name , subject.time_sub from subject , course_item  ";
					$sql=$sql . " where subject.sub_id = course_item.sub_id and course_item.cos_id = $row[0] ";
					$sql=$sql . " order by course_item.autoid ";
					$result_sub=mysql_db_query($database,$sql);
					while($row_sub=mysql_fetch_array($result_sub)){
				  ?>
                <tr>
                  <td bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;<?php echo $row_sub[1] ?>&nbsp;&nbsp;<br />
                    
                    
                    </td>
                  <td align="center" bgcolor="#FFFFFF"><a href="javascript:Delsubject(<?php echo $row[0] ?>,<?php echo $row_sub[0] ?>)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
                  </tr>
                <?php
				  	}
				  }
				  ?>
                <tr bgcolor="#5F7AC3">
                  <td colspan="2"><?php
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