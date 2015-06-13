<?php
	session_start();
	
	include('../config/config.php');
	
	
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
<link href="../bootstrap-3.2.0-dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
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
    <td valign="middle"><img src="../images/stu_bar.png" alt=""/><hr /></td>
  </tr>
  <tr>
    <td>
	    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
			<tr>
		        <td width="10" valign="top">&nbsp;</td>
		        <td width="250" valign="top"><?php include('member_menu.php') ?></td>
		        <td width="5" valign="top">&nbsp;</td>
		        <td valign="top">
			        <table width="100%" border="0" cellspacing="2" cellpadding="2" >
			    		<tr>
			            	<td><strong>รายการลงทะเบียน</strong></td>
			    		</tr>
						<tr>
				            <td>&nbsp;</td>
						</tr>
						<tr>
			            	<td>
			              		<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#5F7AC3" >
			                		<tr>
			                  			<td>
			                  			<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#5F7AC3" class="table table-hover">
			                  				<thead>
								              	<tr>
									                <th bgcolor="#5F7AC3"><span class="style1">รายการ</span></th>
									                <th width="100" bgcolor="#5F7AC3">&nbsp;</th>
								              	</tr>
								            </thead>
								              <?php
											  	$sql="select distinct member_id from learn where approve=0 order by member_id ";
												$result=mysqli_query($dbcon,$sql);
												$nRow=mysqli_num_rows($result);
												$tr=$nRow%$list_page;
												if($rt!=0) { 
													$totalpage = floor($nRow/$list_page)+1; 
												}else {
													$totalpage = floor($nRow/$list_page)+1; 
												}
												$goto = ($page-1)*$list_page;
												$sql=$sql . " limit $goto,$list_page";
												$result=mysqli_query($dbcon,$sql);
												while($row=mysqli_fetch_array($result)){
													$sql="select name , surname from member where member_id=$row[0] ";
													$result_member=mysqli_query($dbcon,$sql);
													$row_member=mysqli_fetch_array($result_member);
											  ?>
											  	<thead>
				              						<tr>
										                <th bgcolor="#FFFFFF"><strong><?php echo $row_member[0] ?>&nbsp;&nbsp;
										                <?php echo $row_member[1] ?></strong></th>
				              						</tr>
				              					</thead>
								                <?php
											  		//หลักสูตร
													$sql="select  distinct learn.cos_id ,  course.cos_name , learn.day_reg , learn.time_reg  from learn , course ";
													$sql=$sql . " where learn.cos_id = course.cos_id and learn.member_id=$row[0] ";
													$sql=$sql . " and learn.approve = 0 ";
													$result_course=mysqli_query($dbcon,$sql);
													while($row_course=mysqli_fetch_array($result_course)){
											    ?>
								              	<tr>
									                <td bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>หลักสูตร :</strong> <?php echo $row_course[1] ?> <br />
									                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style3">ลงทะเบียนเมื่อ : <font color="#336600"><?php echo $row_course[2] ?> &nbsp;&nbsp;<?php echo $row_course[3] ?></font></span></td>
									                <td align="center" bgcolor="#FFFFFF" rowspan="2"><a href="registered_course_action.php?cos_id=<?php echo  $row_course[0] ?>&member_id=<?php echo $row[0] ?>"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
									            </tr>
			              <?php
						  		}
								
								//รายวิชา
								$sql="select learn.autoid , learn.sub_id , subject.sub_name , learn.day_reg , learn.time_reg from learn , subject ";
								$sql=$sql . " where learn.sub_id = subject.sub_id and learn.member_id=$row[0] and learn.cos_id=0 and learn.approve=0 ";
								$result_subject=mysqli_query($dbcon,$sql);
								while($row_subject=mysqli_fetch_array($result_subject)){
						  ?>
			              <tr>
			                <td bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>วิชา : </strong> <?php echo $row_subject[2] ?><br />
			                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style3">ลงทะเบียนเมื่อ : <font color="#336600"><?php echo $row_subject[3] ?> &nbsp;&nbsp;<?php echo $row_subject[4] ?></font></span></td>
			                <td align="center" bgcolor="#FFFFFF"><a href="registered_subject_action.php?id=<?php echo  $row_subject[0] ?>">อนุมัติ</a></td>
			              </tr>
			              <?php
								}
						  }
						  ?>
			              <tr>
			                <td colspan="2" bgcolor="#5F7AC3">
			                <?php
								if($nRow!=0){
									echo "<table width=100% border=0 bordercolor=black cellspacing=0 cellpadding=2>\n";
									echo "<thead><tr><th align=right>\n";
									echo "<font size='2'>\n";
									if($page>1 && $page<=$totalpage) {
										$prevpage = $page-1;
										echo "\t<a href='registered_list.php?page=$prevpage'>[Back = $prevpage]</a>\n";
									}
									echo "\t Display $page/$totalpage \n";
				
									if($page!=$totalpage) {
										$nextpage = $page+1;
										echo "\t<a href='registered_list.php?page=$nextpage'>[Next = $nextpage]</a>\n";
									}
									echo "</th></tr></thead>\n";
									echo "<tr><td align=right>\n";
				
									// วนลูปแสดงเลขหน้าทั้งหมด
									for($i=1 ; $i<$page ; $i++) {
										echo "\t<a href='registered_list.php?page=$i'>$i</a> \n";
									}
									echo "\t<font size=2 color=red><b>$page</b></font> \n";
									for($i=$page+1 ; $i<=$totalpage ; $i++) {
										echo "\t<a href='registered_list.php?page=$i'>$i</a> \n";
									}
									echo "</font></td></tr>\n";
									echo "</table>\n";
								}
							?></td>
			                </tr>
			            </table></td>
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
	mysqli_close($dbcon);
?>