<?php
	session_start();
	include('../config/config.php');
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	if (empty($page)){
    $page=1;
  } else {
    $page=$_GET["page"];
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function submitform(){
	if(confirm('ท่านต้องการลบข้อมูลที่เลือกไว้หรือมัย !')==true){
  		document.form1.submit();
	}
}

function DelSec(id){
	if(confirm('ท่านต้องการลบข้อมูลที่เลือกไว้หรือมัย !')==true){
  		window.location="section_del.php?sec_id="+ id;
	}
}
</script>
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <?php include '../office/header.php' ?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td valign="middle"><img src="../images/sub_bar.png"><hr /></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><?php include('course_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td><strong>รายวิชาที่เปิดสอน</strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><form id="form1" name="form1" method="post" action="subject_del.php">
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="35"><a href="#" onclick="submitform()"><img src="../images/delete.jpg" width="30" height="30" border="0" /></a></td>
                      <td><strong><a href="#" onclick="submitform()">ลบข้อมูล</a></strong></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
                    <tr>
                      <td colspan="3"><hr /></td>
                      </tr>
          <?php
					  $sql="SELECT sub_id , sub_name , time_sub  FROM subject ";
						$sql=$sql . " ORDER by sub_id ";
						$result=mysqli_query($dbcon,$sql);
						$nRow=mysqli_num_rows($result);
						$tr=$nRow%$list_page;
						if($tr!=0) { 
							$totalpage = floor($nRow/$list_page)+1; 
						}else {
							$totalpage = floor($nRow/$list_page)+1; 
						}
						$goto = ($page-1)*$list_page;
						$sql=$sql . " limit $goto,$list_page";
						$result=mysqli_query($dbcon,$sql);
						while($row=mysqli_fetch_array($result)){
					 ?>
                    <tr>
                      <td width="20"><div align="center">
                        <input name="ch<?php echo $row[0] ?>" type="checkbox" id="ch<?php echo $row[0] ?>" value="1" />
                      </div></td>
                      <td width="20"><div align="center"><a href="subject_frm.php?id=<?php echo $row[0] ?>"><img src="../images/edit.png" width="20" height="20" border="0" /></a></div></td>
                      <td><b><?php echo $row[1] ?></b> ( จำนวนชั่วโมง <?php echo $row[2] ?> ) </td>
                    </tr>
                    <tr>
                      <td colspan="3">
          <?php
					  $sql="SELECT sec_id , sec_name FROM section WHERE sub_id= $row[0] AND cos_id=0 ";
						$sql=$sql . " ORDER by sec_id ";
						$result_sec=mysqli_query($dbcon,$sql);
						while($row_sec=mysqli_fetch_array($result_sec)){
							echo "<a href='subject_section_frm_edit.php?sec_id=$row_sec[0]&sub_id=$row[0]'>sec.$row_sec[1]</a> ";
							echo "<a href='javascript:DelSec($row_sec[0])'><img src='../images/edit_remove.png' border='0' /></a>  | ";
						}
					 ?>
                       <!--<a href="subject_section_frm.php?sub_id=<?php echo $row[0] ?>"><img src="../images/edit_add.png" width="16" height="16" border="0" /></a>--></td>
                      </tr>
                    <tr>
                      <td colspan="3"><hr /></td>
                      </tr>
          <?php
					  }
					 ?>
                  </table></td>
                </tr>
                <tr>
                  <td><input name="sql" type="hidden" id="sql" value="<?php echo $sql ?>" />
        <?php
					if($nRow!=0){
						echo "<table width=100% border=0 bordercolor=black cellspacing=0 cellpadding=2>\n";
						echo "<tr><td align=right>\n";
						echo "<font size='2'>\n";
						if($page>1 && $page<=$totalpage) {
							$prevpage = $page-1;
							echo "\t<a href='subject.php?page=$prevpage'>[Back = $prevpage]</a>\n";
				}
						echo "\t Display $page/$totalpage \n";
	
						if($page!=$totalpage) {
							$nextpage = $page+1;
							echo "\t<a href='subject.php?page=$nextpage'>[Next = $nextpage]</a>\n";
						}
						echo "</td></tr>\n";
						echo "<tr><td align=right>\n";
	
						// วนลูปแสดงเลขหน้าทั้งหมด
						for($i=1 ; $i<$page ; $i++) {
							echo "\t<a href='subject.php?page=$i'>$i</a> \n";
						}
						echo "\t<font size=2 color=red><b>$page</b></font> \n";
						for($i=$page+1 ; $i<=$totalpage ; $i++) {
							echo "\t<a href='subject.php?page=$i'>$i</a> \n";
						}
						echo "</font></td></tr>\n";
						echo "</table>\n";
					}
				?></td>
                </tr>
              </table>
                        </form>            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>หมายเหตุ</strong></td>
          </tr>
          <tr>
            <td><img src="../images/edit_add.png" width="16" height="16" border="0" /> เพิ่มกลุ่มเรียน</td>
          </tr>
          <tr>
            <td><img src="../images/edit_remove.png" width="16" height="16" border="0" /> ลบกลุ่มเรียน</td>
          </tr>
          <tr>
            <td><img src="../images/edit.png" width="20" height="20" /> แก้ไขข้อมูล</td>
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