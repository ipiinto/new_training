<?php
	session_start();
	include('../config/config.php');
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
  $action = 0;
	if(!empty($_GET["cos_id"])){
    $cos_id=$_GET["cos_id"];
		$sql="SELECT * FROM course WHERE cos_id = $cos_id ";
		$result=mysqli_query($dbcon,$sql);
		$row=mysqli_fetch_array($result);
		$cos_name=$row["cos_name"];
		$cos_max=$row["cos_max"];
		$detail=$row["detail"];
		$begin_day=$row["begin_day"];
		$end_day=$row["end_day"];
		$begin_reg=$row["begin_reg"];
		$end_reg=$row["end_reg"];
	} else {
    $cos_name="";
    $cos_max="";
    $detail="";
    $begin_day="";
    $end_day="";
    $begin_reg="";
    $end_reg="";
  }
	if(!empty($_POST["action"]) && ($_POST["action"] == 1)){
    $action=$_POST["action"];
		$cos_id=$_POST["cos_id"];
		$cos_name=$_POST["cos_name"];
		$cos_max=$_POST["cos_max"];
		$detail=$_POST["detail"];
		$begin_day=$_POST["begin_day"];
		$end_day=$_POST["end_day"];
		$begin_reg=$_POST["begin_reg"];
		$end_reg=$_POST["end_reg"];
		
		$save=1;
		if($cos_name==""){
			$save=0;
		}
		
		if($cos_max==""){
			$save=0;
		}
		
		if($begin_day==""){
			$save=0;
		}
		
		if($end_day==""){
			$save=0;
		}
		if($begin_reg==""){
			$save=0;
		}
		
		if($end_reg==""){
			$save=0;
		}
		//เริ่มบันทึกข้อมูล
		if($save==1){
			if($cos_id !=""){
				$sql=" UPDATE course SET cos_name='$cos_name',cos_max='$cos_max', detail='$detail' ";
				$sql=$sql . ",begin_day='$begin_day',end_day='$end_day',begin_reg='$begin_reg',end_reg='$end_reg'";
				$sql=$sql . " WHERE cos_id=$cos_id ";
				$result=mysqli_query($dbcon,$sql);
			}else{
				$sql="INSERT INTO course(cos_name,cos_max,num_sec,price,detail,begin_day,end_day,begin_reg,end_reg) ";
				$sql=$sql . " VALUES ('$cos_name',$cos_max,0,0,'$detail','$begin_day', '$end_day','$begin_reg','$end_reg')";
				$result=mysqli_query($dbcon,$sql);
			}
			echo "<script language=\"javascript\">window.location.href = 'course.php'</script>";
			exit();
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon ?></title>
  <link href="../style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../jquery/jquery-ui.css" />
  <script src="../jquery/jquery-2.1.3.js"></script>
  <script src="../jquery/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />

  <script>

  $(function() {

    $( "#begin_day" ).datepicker({ dateFormat: "yy-mm-dd" });

  });
  
  $(function() {

    $( "#end_day" ).datepicker({ dateFormat: "yy-mm-dd" });

  });

$(function() {

    $( "#begin_reg" ).datepicker({ dateFormat: "yy-mm-dd" });

  });
  
  $(function() {

    $( "#end_reg" ).datepicker({ dateFormat: "yy-mm-dd" });

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
    <td valign="middle"><img src="../images/cos_bar.png" /><hr /></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><?php include('course_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td valign="top"><form id="form1" name="form1" method="post" action="course_frm.php">
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td align="right">หลักสูตร :</td>
              <td><input name="cos_name" type="text" id="cos_name" placeholder="ชื่อหลักสูตร" value="<?php echo $cos_name ?>" size="50" />
              <span class="t10r">*
          <?php
						if($action=="1"){
							if($cos_name == ""){
								echo "<br>กรุณากรอก <b>ชื่อหลักสูตร</b>";
							}
						}
					?>
                    </span>
              </td>
            </tr>
            <tr>
              <td align="right">ช่วงเวลาเรียน :</td>
              <td><span class="t10r">
                <input name="begin_day" type="text" id="begin_day" value="<?php echo $begin_day ?>" placeholder="ตั้งแต่"/>
              </span>ถึง<span class="t10r">
              <input name="end_day" type="text" id="end_day" value="<?php echo $end_day ?>" placeholder="ถึง" />
              * 
          <?php
						if($action=="1"){
							if($begin_day == "" or $end_day==""){
								echo "<br>กรุณากรอก <b>วันที่ด้วย</b>";
							}
						}
					?>
              </span></td>
            </tr>
            
            <tr>
              <td align="right">ช่วงเวลาที่เปิดรับ :</td>
              <td><span class="t10r">
                <input name="begin_reg" type="text" id="begin_reg" value="<?php echo $begin_reg ?>" placeholder="ตั้งแต่" />
              </span>ถึง<span class="t10r">
              <input name="end_reg" type="text" id="end_reg" value="<?php echo $end_reg ?>" placeholder="ถึง"/>
              * 
          <?php
						if($action=="1"){
							if($begin_reg==" " or $end_reg==" "){
								echo "<br>กรุณากรอก <b>วันที่ด้วย</b>";
							}
						}
					?>
              </span></td>
            </tr>
            <tr>
              <td align="right">จำนวนที่รับ :</td>
              <td><input name="cos_max" type="text" id="cos_max" value="<?php echo $cos_max ?>" size="10" placeholder="จำนวน"/> 
                คน
                <span class="t10r">*
          <?php
						if($action=="1"){
							if($cos_max == ""){
								echo "<br>กรุณากรอก <b>จำนวนที่รับได้</b>";
							}
						}
					?>
                    </span></td>
            </tr>
            <tr>
              <td align="right">รายละเอียด :</td>
              <td><label for="detail"></label>
                <textarea name="detail" cols="50" rows="5" id="detail" placeholder="รายละเอียด"><?php echo $detail ?></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="button" id="button" value="บันทึกข้อมูล"/>
                <input name="cos_id" type="hidden" id="cos_id" value="<?php echo $cos_id ?>" />
                <input name="action" type="hidden" id="action" value="1" /></td>
            </tr>
          </table>
                        </form>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
</body>
</html>
<?php
	mysqli_close($dbcon);
?>