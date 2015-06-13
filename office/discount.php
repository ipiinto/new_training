<?php
  session_start();	
	include('../config/config.php');
	
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	
	$cos_id=$_GET["cos_id"];
	if($cos_id != ""){
		$sql="select cos_name from course where cos_id=$cos_id";
		$result=mysqli_query($dbcon,$sql);
		$row=mysqli_fetch_array($result);
		$cos_name=$row[0];
	}
	
	$action=$_POST["action"];
	if($action =="1"){
		$cos_id=$_POST["cos_id"];
		$cos_name=$_POST["cos_name"];
		$sale=$_POST["sale"];
		
		$save=1;
		if($sale==""){
			$save=0;
		}
		
		//เริ่มบันทึกข้อมูล
		if($save==1){
			$sql=" update course set discount='$sale' where cos_id=$cos_id ";
			$result=mysqli_query($dbcon,$sql);
			echo "<script language=\"javascript\">window.location.href = 'course.php'</script>";
			exit();
		}
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><?php include('course_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td><strong>รายการหลักสูตร</strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <table width="100%" border="0" cellpadding="0" cellspacing="1" >
              <form id="form1" name="form1" method="post" action="discount.php">
                <tr>
                  <td width="24%" align="right">หลักสูตร :</td>
                  <td width="76%"><strong><?php echo $cos_name ?>
                      <input name="cos_name" type="hidden" id="cos_name" value="<?php echo $cos_name ?>" />
                  </strong></td>
              </tr>
              <tr>
                  <td align="right">ส่วนลด :</td>
                  <td ><input name="sale" type="text" id="sale" value="<?php echo $sale ?>" size="10" />
                    <span class="t10r">*
                    <?php
						if($action=="1"){
							if($sale==""){
								echo "<br>กรุณากรอก <b>ส่วนลด</b> ด้วย";
							}
						}
					?>
                    </span>
                    </td>
                  </tr>
                   <tr>
                  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
                  
     
                  </td>
                  <td align="left"><input type="submit" name="button" id="button" value="บันทึกข้อมูล" />
                    <input name="action" type="hidden" id="action" value="1" />
                    <input name="cos_id" type="hidden" id="cos_id" value="<?php echo $cos_id ?>" /></td>
                  </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                  </tr>
                  </form>
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