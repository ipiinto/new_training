<?php
  session_start();
	
	include('../config/config.php');
	
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	$sub_id=$_GET["sub_id"];
	$sec_id=$_GET["sec_id"];
	$cos_id=$_GET["cos_id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

  <link rel="stylesheet" href="/resources/demos/style.css" />

  <script>

  $(function() {

    $( "#begin_day" ).datepicker({ dateFormat: "yy-mm-dd" });

  });
  
  $(function() {

    $( "#end_day" ).datepicker({ dateFormat: "yy-mm-dd" });

  });

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
        <td valign="top"><form id="form1" name="form1" method="post" action="subject_section_frm_add_action.php">
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td width="200" align="right">รายวิชา :</td>
              <td><?php
			  	$sql="select sub_name from subject  where sub_id=$sub_id ";
				$result=mysqli_query($dbcon,$sql);
				$row=mysqli_fetch_array($result);
				echo $row[0];
			  ?></td>
            </tr>
            <?php
				$sql="select * from section where sec_id=$sec_id ";
				$result=mysqli_query($dbcon,$sql);
				$row=mysqli_fetch_array($result);
				$sec_name=$row["sec_name"];
				$teacher_id=$row["teacher_id"];
				$max_sec=$row["max_sec"];
				$day=$row["day"];
				$since=$row["since"];
				$until=$row["until"];
				$room=$row["room"];
			?>
            <tr>
              <td><strong>รายละเอียดกลุ่มเรียน</strong></td>
              <td>&nbsp;</td>
            </tr>
           
            <tr>
              <td align="right">กลุ่มเรียน :</td>
              <td><input name="sec_name" type="text" id="sec_name" value="<?php echo $sec_name ?>" size="10" readonly="readonly" /></td>
            </tr>
            <tr>
              <td align="right">อาจารย์ผู้สอน :</td>
              <td><select name="teacher" id="teacher">
              <?php
			  	$sql="select teacher_id , name , surname from teacher  order by teacher_id ";
				$result=mysqli_query($dbcon,$sql);
				while($row=mysqli_fetch_array($result)){
					echo "<option value='$row[0]' ";
					if($row[0]==$teacher_id){
						echo " selected='selected' ";
					}
					echo ">$row[1]</option>";
				}
			  ?>
                
              </select>
              </td>
            </tr>
            <tr>
              <td align="right">จำนวนที่รับได้ :</td>
              <td><input name="max_sec" type="text" id="max_sec" value="<?php echo $max_sec ?>" size="5" maxlength="2" /> 
                คน</td>
            </tr>
            <tr>
            	<td align="right">วัน/เวลาเรียน :</td>
            	<td> <select name="day" id="day">
            	  	<option selected="selected">-- วัน  --</option>
                    <option value="1" <?php if($day==1) echo "selected='selected'"; ?>>อาทิตย์</option>
                    <option value="2" <?php if($day==2) echo "selected='selected'"; ?>>จันทร์</option>
                    <option value="3" <?php if($day==3) echo "selected='selected'"; ?>>อังคาร</option>
                    <option value="4" <?php if($day==4) echo "selected='selected'"; ?>>พุธ</option>
                    <option value="5" <?php if($day==5) echo "selected='selected'"; ?>>พฤหัสบดี</option>
                    <option value="6" <?php if($day==6) echo "selected='selected'"; ?>>ศุกร์</option>
                    <option value="7" <?php if($day==7) echo "selected='selected'"; ?>>เสาร์</option>
                </select>
                &nbsp;&nbsp;&nbsp; ตั้งแต่&nbsp;
                <select name="since" id="since">
                  <option selected="selected"> 00:00 </option>
                  <option value="1" <?php if($since==1) echo "selected='selected'"; ?>>08:30</option>
                  <option value="2" <?php if($since==2) echo "selected='selected'"; ?>>09:30</option>
                  <option value="3" <?php if($since==3) echo "selected='selected'"; ?>>10:30</option>
                  <option value="4" <?php if($since==4) echo "selected='selected'"; ?>>11:30</option>
                  <option value="5" <?php if($since==5) echo "selected='selected'"; ?>>12:30</option>
                  <option value="6" <?php if($since==6) echo "selected='selected'"; ?>>13:30</option>
                  <option value="7" <?php if($since==7) echo "selected='selected'"; ?>>14:30</option>
                  <option value="8" <?php if($since==8) echo "selected='selected'"; ?>>15:30</option>
                  <option value="9" <?php if($since==9) echo "selected='selected'"; ?>>16:30</option>
                  <option value="10" <?php if($since==10) echo "selected='selected'"; ?>>17:30</option>
                  <option value="11" <?php if($since==11) echo "selected='selected'"; ?>>18:30</option>
                  <option value="12" <?php if($since==12) echo "selected='selected'"; ?>>19:30</option>
                </select>                &nbsp;&nbsp;&nbsp;ถึง&nbsp;&nbsp;&nbsp;
                <select name="until" id="until">
                  <option selected="selected"> 00:00 </option>
                  <option value="2" <?php if($until==2) echo "selected='selected'"; ?>>09:30</option>
                  <option value="3" <?php if($until==3) echo "selected='selected'"; ?>>10:30</option>
                  <option value="4" <?php if($until==4) echo "selected='selected'"; ?>>11:30</option>
                  <option value="5" <?php if($until==5) echo "selected='selected'"; ?>>12:30</option>
                  <option value="6" <?php if($until==6) echo "selected='selected'"; ?>>13:30</option>
                  <option value="7" <?php if($until==7) echo "selected='selected'"; ?>>14:30</option>
                  <option value="8" <?php if($until==8) echo "selected='selected'"; ?>>15:30</option>
                  <option value="9" <?php if($until==9) echo "selected='selected'"; ?>>16:30</option>
                  <option value="10" <?php if($until==10) echo "selected='selected'"; ?>>17:30</option>
                  <option value="11" <?php if($until==11) echo "selected='selected'"; ?>>18:30</option>
                  <option value="12" <?php if($until==12) echo "selected='selected'"; ?>>19:30</option>
                </select></td>
            </tr>
            <tr>
              <td align="right">ห้อง :</td>
              <td><input name="room" type="text" id="room>" value="<?php echo $room ?>" size="8" maxlength="4" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><hr /></td>
            </tr>
           
			
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="button" id="button" value="บันทึกข้อมูล" />
                <input name="sub_id" type="hidden" id="sub_id" value="<?php echo $sub_id ?>" />
                <input name="action" type="hidden" id="action" value="edit" />
                <input name="sec_id" type="hidden" id="sec_id" value="<?php echo $sec_id ?>" />
                <input name="cos_id" type="hidden" id="cos_id" value="<?php echo $cos_id ?>" /></td>
            </tr>
          </table>
                </form>
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