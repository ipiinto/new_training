<?php
  session_start();
	
	include('../config/config.php');
	
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	$sql="select * from teacher where teacher_id=".$_SESSION['id'];
	$result=mysqli_query($dbcon,$sql);
	$rows=mysqli_fetch_array($result);
	$action=$_POST["action"];
	if($action==1){
		$username=$_POST["username"];
		$name=$_POST["name"];
		$surname=$_POST["surname"];
		$nickname=$_POST["nickname"];
		$email=$_POST["email"];
		$gender=$_POST["gender"];
		$telephone=$_POST["telephone"];
		$address=$_POST["address"];
		$d=$_POST["d"];
		$m=$_POST["m"];
		$y=$_POST["y"];		
		$birthday="$y-$m-$d";
	}else{
		
		$username=$rows["username"];
		$name=$rows["name"];
		$surname=$rows["surname"];
		$nickname=$rows["nickname"];
		$email=$rows["email"];
		$telephone=$rows["telephone"];
		$gender=$rows["gender"];
		$address=$rows["address"];
		$d=$rows["d"];
		$m=$rows ["m"];
		$y=$rows["y"];
		
	}
	
	if($action==1){
		if($name !="" and $surname !="" and $nickname !="" and $email !="" and $gender !="" and $telephone !="" and $address !=""){
			$sql="update teacher set name='$name' , surname='$surname' , nickname='$nickname' , email='$email' , gender='$gender' , telephone='$telephone' , address='$address' ";
				$sql=$sql . " where teacher_id=".$_SESSION['id'];
				$result=mysqli_query($dbcon,$sql);
				
				echo "<script language=\"javascript\">window.location.href = 'index.php'</script>";
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
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <?php include "../teacher/header.php";?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        
        <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>ลงทะเบียนเพื่อเข้าใช้งานระบบ</strong></td>
      </tr>
      <tr>
        <td>
        <form id="form2" name="form2" method="post" action="edit_profile.php">
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td width="180"><strong>ข้อมูลผู้ใช้งานระบบ</strong></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right">ชื่อผู้ใช้ระบบ :</td>
              <td><?php echo $username ?></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td><strong>ข้อมูลทั่วไป</strong></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right">ชื่อ-สกุล :</td>
              <td><input name="name" type="text" id="name" value="<?php echo $name ?>" />
                <input name="surname" type="text" id="surname" value="<?php echo $surname ?>" /> 
                <span class="t10r">*
                <?php
                  if($action=="1"){
                    if($name==""){
                      echo "<br>กรุณากรอก <b>ชื่อ</b> ด้วย";
                    }
						
                    if($surname==""){
                      echo "<br>กรุณากรอก <b>สกุล</b> ด้วย";
                    }
                  }
                ?>
                </span></td>
            </tr>
            <tr>
              <td align="right">ชื่อเล่น :</td>
              <td><input name="nickname" type="text" id="nickname" value="<?php echo $nickname ?>" /></td>
            </tr>
            <tr>
              <td align="right">เพศ :</td>
              <td><input name="gender" type="radio" id="radio" value="0" <?php if($gender==0) echo " checked='checked'"; ?> />
                ผู้ชาย 
                  <input type="radio" name="gender" id="radio2" value="1" <?php if($gender==1) echo " checked='checked'"; ?>/> 
                  ผู้หญิง</td>
            </tr>
            <tr>
              <td align="right">วันเกิด :</td>
              <td>
              <select name="d" id="d">
              <?php
      			  	for($i=1;$i<=31;$i++){
                  echo "<option value='$i' ";
        					if($d==$i){
        						echo " selected='selected'";
        					}
                  echo ">$i</option>";
                }
              ?>
              </select>
                <select name="m" id="m">
      
                  <option value="1" <?php if($m==1) echo "selected='selected'"; ?>>มกราคม</option>
                  <option value="2" <?php if($m==2) echo "selected='selected'"; ?>>กุมภาพันธ์</option>
                  <option value="3" <?php if($m==3) echo "selected='selected'"; ?>>มีนาคม</option>
                  <option value="4" <?php if($m==4) echo "selected='selected'"; ?>>เมษายน</option>
                  <option value="5" <?php if($m==5) echo "selected='selected'"; ?>>พฤษภาคม</option>
                  <option value="6" <?php if($m==6) echo "selected='selected'"; ?>>มิถุนายน</option>
                  <option value="7" <?php if($m==7) echo "selected='selected'"; ?>>กรกฎาคม</option>
                  <option value="8" <?php if($m==8) echo "selected='selected'"; ?>>สิงหาคม</option>
                  <option value="9" <?php if($m==9) echo "selected='selected'"; ?>>กันยายน</option>
                  <option value="10" <?php if($m==10) echo "selected='selected'"; ?>>ตุลาคม</option>
                  <option value="11" <?php if($m==11) echo "selected='selected'"; ?>>พฤศจิกายน</option>
                  <option value="12" <?php if($m==12) echo "selected='selected'"; ?>>ธันวาคม</option>
                </select>
                <select name="y" id="y">
                <?php
          				$now_y=date("Y");
          				$now_y=$now_y+543;
                    for($i=1;$i<=50;$i++){
                      echo "<option value='$now_y' ";
                      if($m==$now_y){
                        echo " selected='selected'";
                      }
              				echo ">$now_y</option>";
          					$now_y--;
          				}
                ?>
                </select></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><strong>สถานที่ติดต่อ</strong></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right">ที่อยู่ :</td>
              <td><input name="address" type="text" id="address" value="<?php echo $address ?>" size="60" /></td>
            </tr>
            <tr>
              <td align="right">อีเมล :</td>
              <td><input name="email" type="text" id="email" value="<?php echo $email ?>" readonly></td>
            </tr>
            <tr>
              <td align="right">เบอร์โทรศัพท์ :</td>
              <td><input name="telephone" type="text" id="telephone" value="<?php echo $telephone ?>" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="action" type="hidden" id="action" value="1" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="button" id="button" value="บันทึกข้อมูล" /></td>
            </tr><br />
          </table>
        </form></td>
      </tr>
        
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