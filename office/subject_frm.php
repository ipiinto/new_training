<?php
	session_start();
	
	include('../config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	$id=$_GET["id"];
	if($id !=""){
		$sql="select * from subject where sub_id=$id ";
		$result=mysql_db_query($database,$sql);
		$row=mysql_fetch_array($result);
		
		$sub_name=$row["sub_name"];
		$price=$row["price"];
		$time_sub=$row["time_sub"];
		$detail=$row["detail"];
	}
	
	$action=$_POST["action"];
	if($action=="1"){
		$id=$_POST["id"];
		$action=$_POST["action"];
		$sub_name=$_POST["sub_name"];
		$price=$_POST["price"];
		$time_sub=$_POST["time_sub"];
		$detail=$_POST["detail"];
		
		$save=1;
		if($sub_name==""){
			$save=0;
		}
		
		if($price==""){
			$save=0;
		}
		
		if($time_sub==""){
			$save=0;
		}
		
		//เริ่มบันทึก
		if($save==1){
						
			if($id !=""){
				$sql="update subject set sub_name='$sub_name' , price=$price , time_sub='$time_sub' , detail='$detail' ";
				$sql=$sql . " where sub_id=$id ";
			}else{
				$sql="insert into subject(sub_name , price , time_sub , detail ) ";
				$sql=$sql . " values('$sub_name' , $price , '$time_sub' , '$detail')";
			}
			$result=mysql_db_query($database,$sql);
			echo "<script language=\"javascript\">window.location.href = 'subject.php'</script>";
			
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
    <td valign="middle"><img src="../images/sub_bar.png"><hr /></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><?php include('course_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td valign="top"><form id="form1" name="form1" method="post" action="subject_frm.php">
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td width="180"><strong>ข้อมูลรายวิชา</strong></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right">วิชา :</td>
              <td><input name="sub_name" type="text" autofocus="autofocus" id="sub_name" placeholder="ชื่อวิชา" value="<?php echo $sub_name ?>" size="50" />
                  <span class="t10r">*
                    <?php
					if($action=="1"){
						if($sub_name==""){
							echo "<br>กรุณากรอก <b>ชื่อรายวิชา</b> ด้วย";
						}
					}
				?>
                </span></td>
            </tr>
            <tr>
              <td align="right">จำนวนชั่วโมง :</td>
              <td><input name="time_sub" type="text" id="time_sub" placeholder="จำนวน" value="<?php echo $time_sub ?>" size="10" />
                ชั่วโมง <span class="t10r">*
                  <?php
					if($action=="1"){
						if($time_sub==""){
							echo "<br>กรุณากรอก <b>จำนวนชั่วโมง</b> ด้วย";
						}
					}
				?>
                </span></td>
            </tr>
            <tr>
              <td align="right">ราคา :</td>
              <td><input name="price" type="text" id="price" placeholder="ราคา" value="<?php echo $price ?>" size="10" />
                  <span class="t10r">*
                    <?php
					if($action=="1"){
						if($price==""){
							echo "<br>กรุณากรอก <b>ราคา</b> ด้วย";
						}
					}
				?>
                </span></td>
            </tr>
            <tr>
              <td align="right" valign="top">คำอธิบายรายวิชา :</td>
              <td><textarea name="detail" cols="50" rows="5" id="detail" placeholder="คำอธบายรายวิชา"><?php echo $detail ?></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="action" type="hidden" id="action" value="1" />
                  <input name="id" type="hidden" id="id" value="<?php echo $id ?>" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="button" id="button" value="บันทึกข้อมูล" /></td>
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