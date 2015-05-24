<?php
	session_start();
	include('../config/config.php');
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
  if (empty($_GET["Page"])) {
    $Page = 1;
  } else {
    $Page = $_GET["Page"];
  }
	$sub_id=$_GET["sub_id"];
	$sql="select sub_name , time_sub from subject where sub_id=$sub_id ";
	$result=mysqli_query($dbcon,$sql);
	$row=mysqli_fetch_array($result);
	$sub_name=$row["sub_name"];
	$time_sub=$row["time_sub"];
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

<script language="javascript" type="text/javascript" >
	<!--
		
	function goDel(id){
		if(confirm("คุณต้องการที่จะลบข้อมูล นี้หรือไม่?")){
			window.location="document_del.php?sub_id=<?php echo $sub_id ?>&id="+ id;
		}
	}
	
// -->
</script>
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <?php include "../teacher/header.php";?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('../teacher/menu.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong><?php echo $sub_name ?></strong>( <?php echo $time_sub ?> ชั่วโมง )</td>
  </tr>
  <tr>
  	<td><hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><?php include('teach_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td width="759" valign="top">
        
        
        <table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td><table width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#5F7AC3">
                  <tr bgcolor="#5F7AC3">
                    <td colspan="2"><strong><font color="#FFFFFF">รายการ</font></strong></td>
                    <td width="50">&nbsp;</td>
                  </tr>
                  <?php
			  	$sql="select  *  from document  where sub_id=$sub_id order by autoid ";
				$result=mysqli_query($dbcon,$sql);
				$nRow=mysqli_num_rows($result);
				$tr=$nRow%$list_page;
				if($tr!=0) { 
					$totalpage = floor($nRow/$list_page)+1; 
				}else {
					$totalpage = floor($nRow/$list_page)+1; 
				}
				$goto = ($Page-1)*$list_page;
				$sql=$sql . " limit $goto,$list_page";
				$result=mysqli_query($dbcon,$sql);
				while($row=mysqli_fetch_array($result)){
			  ?>
                  <tr>
                    <td width="30" align="center" bgcolor="#FFFFFF">
                    <?php
						switch($row["file_type"]){
							case "application/pdf" :
								$img="pdf.png";
								break;
								
							case "application/msword" :
								$img="word.png";
								break;
								
							case "application/vnd.openxmlformats-officedocument.spre" :
								$img="excel.png";
								break;
								
							case "application/vnd.openxmlformats-officedocument.pres" :
								$img="powerpoint.png";
								break;
								
							case "application/x-rar-compressed" :
								$img="winrar.png";
								break;
								
							case "application/zip" :
								$img="zip.png";
								break;
								
							default:
								$img="other.png";
						}
					?>
                    <img src="../images/<?php echo $img ?>" width="30" height="30" /></td>
                    <td bgcolor="#FFFFFF"><strong><a href='upload/<?php echo $row["file_name"] ?>' target="_blank"><?php echo $row["title"] ?></a><br />
                    </strong><span class="t10">ลงโดย
                    <?php
						$sql="select name , surname from teacher where teacher_id=$row[2] ";
						$result_teacher=mysqli_query($dbcon,$sql);
						$row_teacher=mysqli_fetch_array($result_teacher);
						echo "$row_teacher[0]  $row_teacher[1]";
					?>
                     เมื่อว้นที่ <?php echo $row["day_in"] ?> <?php echo $row["time_in"] ?></span></td>
                    <td align="center" bgcolor="#FFFFFF"><a href="javascript:goDel(<?php echo $row[0] ?>)"><img src="../images/edit_remove.png" width="16" height="16" border="0" /></a></td>
                  </tr>
                  <?php
				}
			  ?>
                  <tr bgcolor="#5F7AC3">
                    <td colspan="3"><form action="upload.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                      <table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr bgcolor="#5F7AC3">
                          <td width="50">ชื่อไฟล์ :</td>
                          <td width="180"><input type="text" name="title" id="title" /></td>
                          <td width="30">file :</td>
                          <td><input type="file" name="fileupload" id="fileupload" />
                            <input type="submit" name="button" id="button" value="upload" />
                            <input name="sub_id" type="hidden" id="sub_id" value="<?php echo $sub_id ?>" /></td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                    </form></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><?php
					if($nRow!=0){
						echo "<table width=100% border=0 bordercolor=black cellspacing=0 cellpadding=2>\n";
						echo "<tr><td align=right>\n";
						echo "<font size='2'>\n";
						if($page>1 && $page<=$totalpage) {
							$prevpage = $page-1;
							echo "\t<a href='document.php?page=$prevpage&sub_id=$sub_id'>[Back = $prevpage]</a>\n";
						}
						echo "\t Display $page/$totalpage \n";
	
						if($page!=$totalpage) {
							$nextpage = $page+1;
							echo "\t<a href='document.php?page=$nextpage&sub_id=$sub_id'>[Next = $nextpage]</a>\n";
						}
						echo "</td></tr>\n";
						echo "<tr><td align=right>\n";
	
						// วนลูปแสดงเลขหน้าทั้งหมด
						for($i=1 ; $i<$page ; $i++) {
							echo "\t<a href='document.php?page=$i&sub_id=$sub_id'>$i</a> \n";
						}
						echo "\t<font size=2 color=red><b>$page</b></font> \n";
						for($i=$page+1 ; $i<=$totalpage ; $i++) {
							echo "\t<a href='document.php?page=$i&sub_id=$sub_id'>$i</a> \n";
						}
						echo "</font></td></tr>\n";
						echo "</table>\n";
					}
				?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><strong>หมายเหตุ</strong></td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
                  <tr>
                    <td width="50">&nbsp;</td>
                    <td width="20"><img src="../images/edit_remove.png" width="16" height="16" /></td>
                    <td>ลบเอกสาร</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
        
        
        </td>
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