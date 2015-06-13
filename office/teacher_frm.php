<?php
  	session_start();
	
	include('../config/config.php');
	
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	$id=$_GET["id"];
	if($id !=""){
		$sql="select * from teacher where teacher_id=$id ";
		$result=mysqli_query($dbcon,$sql);
		$row=mysqli_fetch_array($result);
		
		$username=$row["username"];
		$pass=$row["pass"];
		$name=$row["name"];
		$surname=$row["surname"];
		$nickname=$row["nickname"];
		$email=$row["email"];
		$telephone=$row["telephone"];
		if($row["gender"]=="ชาย"){
			$gender=0;
		}else{
			$gender=1;
		}
		$address=$row["address"];
		$birthday=$row["birthday"];
		
		$y=substr($birthday,0,4);
		$m=intval(substr($birthday,5,2));
		$d=intval(substr($birthday,8,2));
		
	}
	
	$action=$_POST["action"];
	if($action=="1"){
		$id=$_POST["id"];
		$action=$_POST["action"];
		$username=$_POST["username"];
		$pass=$_POST["pass"];
		$re_pass=$_POST["re_pass"];
		$name=$_POST["name"];
		$surname=$_POST["surname"];
		$nickname=$_POST["nickname"];
		$email=$_POST["email"];
		$telephone=$_POST["telephone"];
		$gender=$_POST["gender"];
		$address=$_POST["address"];
		$d=$_POST["d"];
		$m=$_POST["m"];
		$y=$_POST["y"];
		
		$save=1;
		if($username==""){
			$save=0;
		}
		
		if($pass==""){
			$save=0;
		}
		
		if($pass != $re_pass){
			$save=0;
		}
		
		if($name==""){
			$save=0;
		}
		
		if($surname==""){
			$save=0;
		}
		
		//เริ่มบันทึก
		if($save==1){
			$birthday="$y-$m-$d";
			if($gender==0){
				$gender="ชาย";
			}else{
				$gender="หญิง";
			}
			
			if($id !=""){
				$sql="update teacher set name='$name' , surname='$surname' , nickname='$nickname' , email='$email' ";
				$sql=$sql . " , telephone='$telephone' , gender='$gender' , address='$address' , birthday='$birthday' ";
				$sql=$sql . " , pass='$pass' , username='$username' where teacher_id=$id ";
			}else{
				$sql="insert into teacher(username , pass , name , surname ,nickname , email , telephone , gender , address , birthday  )";
			$sql=$sql . " values('$username' , '$pass' , '$name' , '$surname' ,'$nickname' , '$email' , '$telephone' , '$gender' , '$address' , '$birthday' )";
			}
			$result=mysqli_query($dbcon,$sql);
			echo "<script language=\"javascript\">window.location.href = 'teacher.php'</script>";
			
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
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>

<script type="text/javascript">
function submitform(){
	if(confirm('ท่านต้องการลบข้อมูลที่เลือกไว้หรือไม่ !')==true){
  		document.form2.submit();
	}
}
</script>
</head>

<body>
<table width="1024" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
  <tr>
    <?php include '../office/header.php'?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td align="left" valign="bottom"><img src="../images/teach_bar.png" /><hr /></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><?php include('member_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td><strong><a href="teacher.php">รายชื่ออาจารย์ผู้สอน</a></strong></td>
            <td align="right" class="t10r">
            <?php
				if($id !=""){
					echo "แก้ไขข้อมูล";
				}else{
					echo "ลงทะเบียน";
				}
			?>
            </td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><form id="form1" name="form1" method="post" action="teacher_frm.php">
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td width="180"><strong>ข้อมูล Login เข้าระบบ</strong></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
					<td align="right">ชื่อผู้ใช้ระบบ :</td>
					<td><input name="username" type="text" id="username" value="<?php echo $username ?>" placeholder="ชื่อผู้ใช้" />
                    <span class="t10r">*
					<?php
						if($action=="1"){
							if($username==""){
								echo "<br>กรุณากรอก <b>ชื่อผู้ใช้ระบบ</b> ด้วย";
							}
						}
					?>
                    </span>
					</td>
                </tr>
                <tr>
					<td align="right">รหัสผ่าน :</td>
					<td><input name="pass" type="password" id="pass" value="<?php echo $pass ?>" placeholder="รหัสผ่าน" />
                    <span class="t10r">*
					<?php
						if($action=="1"){
							if($pass==""){
								echo "กรุณากรอก <b>รหัสผ่าน </b> ด้วย";
							}elseif($pass != $re_pass){
								echo "รหัสผ่านไม่ถูกต้อง";
							}
						}
					?>
                    </span></td>
                </tr>
                <tr>
                  <td align="right">ยืนยันรหัสผ่าน :</td>
                  <td><input name="re_pass" type="password" id="re_pass" value="<?php echo $pass ?>" placeholder="ยืนยันรหัสผ่าน" />
                    <span class="t10r">*</span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><strong>ข้อมูลทั่วไป</strong></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
					<td align="right">ชื่อ-สกุล :</td>
                  	<td><input name="name" type="text" id="name" value="<?php echo $name ?>" placeholder="ชื่อ" />
                    <input name="surname" type="text" id="surname" value="<?php echo $surname ?>" placeholder="สกุล" />
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
                    </span>
					</td>
                </tr>
                <tr>
					<td align="right">ชื่อเล่น :</td>
					<td><input name="nickname" type="text" id="nickname" value="<?php echo $nickname ?>" placeholder="ชื่อผู้ใช้" /></td>
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
                    </select>
                    </td>
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
                  <td><input name="address" type="text" id="address" value="<?php echo $address ?>" size="60" placeholder="ที่อยู่"/></td>
                </tr>
                <tr>
                  <td align="right">อีเมล :</td>
                  <td><input name="email" type="text" id="email" value="<?php echo $email ?>" placeholder="อีเมล" /></td>
                </tr>
                <tr>
                  <td align="right">เบอร์โทรศัพท์ :</td>
                  <td><input name="telephone" type="text" id="telephone" value="<?php echo $telephone ?>" placeholder="เบอร์โทรศัพท์" /></td>
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
            </form></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table>
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