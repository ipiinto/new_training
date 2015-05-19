<?php
  session_start();
	
	include('../config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	$sub_id=$_POST["sub_id"];
	$num=$_POST["num"];
	$cos_id=$_POST["cos_id"];
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
				$result=mysql_db_query($database,$sql);
				$row=mysql_fetch_array($result);
				echo $row[0];
			  ?></td>
            </tr>
            <tr>
              <td><strong>รายละเอียดกลุ่มเรียน</strong></td>
              <td>&nbsp;</td>
            </tr>
            <?php
				//หาเลขเริ่มต้น
				$sql="select sec_count from section where sub_id=$sub_id ";
				if($cos_id !=""){
					$sql=$sql . "  and cos_id=$cos_id ";
				}
				$sql=$sql . " order by sec_count desc ";
				$result=mysql_db_query($database,$sql);
				$nRow=mysql_num_rows($result);
				if($nRow==0){
					$start=1;
					$end=1;
				}else{
					$row=mysql_fetch_array($result);
					$start=$row[0]+1;
					$end=$row[0]+1;
				}
					
				for($i=1;$i<=$num;$i++){
					$items = (string)$end;
					if(strlen($items)>1){
						$value= $items;
					}else{
						$value="0$items";
					}		
			?>
            <tr>
              <td align="right">กลุ่มเรียน :</td>
              <td><input name="sec_name<?php echo $end ?>" type="text" id="sec_name<?php echo $end ?>" value="<?php echo $value ?>" size="10" readonly="readonly" /></td>
            </tr>
            <tr>
              <td align="right">อาจารย์ผู้สอน :</td>
              <td><select name="teacher<?php echo $end ?>" id="teacher<?php echo $end ?>">
              <?php
			  	$sql="select teacher_id , name , surname from teacher  order by teacher_id ";
				$result=mysql_db_query($database,$sql);
				while($row=mysql_fetch_array($result)){
					echo "<option value='$row[0]'>$row[1]</option>";
				}
			  ?>
                
              </select>
              </td>
            </tr>
            <tr>
              <td align="right">จำนวนที่รับได้ :</td>
              <td><input name="max_sec<?php echo $end ?>" type="text" id="max_sec<?php echo $end ?>" placeholder="จำนวน" size="5" maxlength="2" /> 
                คน</td>
            </tr>
            <tr>
            	<td align="right">วัน/เวลาเรียน :</td>
                <td> <select name="day<?php echo $end ?>" id="day<?php echo $end ?>">
            	  	<option selected="selected">-- วัน  --</option>
                    <option value="1">อาทิตย์</option>
                    <option value="2">จันทร์</option>
                    <option value="3">อังคาร</option>
                    <option value="4">พุธ</option>
                    <option value="5">พฤหัสบดี</option>
                    <option value="6">ศุกร์</option>
                    <option value="7">เสาร์</option>
                </select>
                &nbsp;&nbsp;&nbsp; ตั้งแต่&nbsp;
                
                <select name="since<?php echo $end ?>" id="since<?php echo $end ?>">
                	<option selected="selected"> 00:00 </option>
                	<option value="1">08:30</option>
                	<option value="2">09:30</option>
                	<option value="3">10:30</option>
                	<option value="4">11:30</option>
                	<option value="5">12:30</option>
                	<option value="6">13:30</option>
                	<option value="7">14:30</option>
                	<option value="8">15:30</option>
                	<option value="9">16:30</option>
                	<option value="10">17:30</option>
                	<option value="11">18:30</option>
                	<option value="12">19:30</option>
                </select>
                &nbsp;&nbsp;&nbsp;ถึง&nbsp;&nbsp;&nbsp;                
                <select name="until<?php echo $end ?>" id="until<?php echo $end ?>">
                  <option selected="selected"> 00:00 </option>
                  <option value="2">09:30</option>
                  <option value="3">10:30</option>
                  <option value="4">11:30</option>
                  <option value="5">12:30</option>
                  <option value="6">13:30</option>
                  <option value="7">14:30</option>
                  <option value="8">15:30</option>
                  <option value="9">16:30</option>
                  <option value="10">17:30</option>
                  <option value="11">18:30</option>
                  <option value="12">19:30</option>
                </select>                
                </tr>
            <tr>
              <td align="right">ห้อง :</td>
              <td><input name="room<?php echo $end ?>" type="text" id="room<?php echo $end ?>" placeholder="ห้อง" size="8" maxlength="4" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><hr /></td>
            </tr>
            <?php
				$sec_id++;
				$end++;	
			}
			?>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="button" id="button" value="บันทึกข้อมูล" />
                <input name="sub_id" type="hidden" id="sub_id" value="<?php echo $sub_id ?>" />
                <input name="num" type="hidden" id="num" value="<?php echo $num ?>" />
                <input name="action" type="hidden" id="action" value="add" />
                <input name="start" type="hidden" id="start" value="<?php echo $start ?>" />
                <input name="end" type="hidden" id="end" value="<?php echo $end ?>" />
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
	mysql_close();
?>