<?php
	session_start();
	
	include('config/config.php');
	
	
	$action=$_POST["action"];
	$username=$_POST["username"];
	$pass=$_POST["pass"];
	$re_pass=$_POST["re_pass"];
	$name=$_POST["name"];
	$surname=$_POST["surname"];
	$nickname=$_POST["nickname"];
  $gender=$_POST["gender"];
  $stat=$_POST["stat"];
  $nation=$_POST["nation"]; 
  $d=$_POST["d"];
  $m=$_POST["m"];
  $y=$_POST["y"];
	$address=$_POST["address"];
  $email=$_POST["email"];
	$telephone=$_POST["telephone"];
  $subj=$_POST["subj"];
	
	if($action=="1"){
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
		
		//เริ่มบันทึกข้อมูล
		if($save==1){
			$birthday="$y-$m-$d";
			if($gender==0){
				$gender="ชาย";
			}else{
				$gender="หญิง";
			}
			
			$sql="insert into jobs(username , pass , name , surname ,nickname , gender , stat , nation , birthday , address , email , telephone , subj )";
			$sql=$sql . " values('$username' , '$pass' , '$name' , '$surname' ,'$nickname' , '$gender' , '$stat' , '$nation' , '$birthday' , '$address' , '$email' , '$telephone' , '$subj')";
			$result=mysqli_query($dbcon,$sql);
      echo $sql;
			echo "<script language=\"javascript\">window.location.href = 'index.php'</script>";
			//$result=mysqli_query($dbcon,$sql);
			exit();
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $ribon; ?></title>
  <link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <?php include "header.php"; ?>
      </tr>
      <tr>
        <td height="46" background="images/bg_menu.png"><?php include('menu.php') ?></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
      	      <tr>
        <td valign="middle"><a href="student/list_subject.php"><img src="images/reg_bar.png" width="300" height="27"  alt=""/></a>          <hr size="5"  /></td>
      </tr>
        <tr>
          <td><strong>ลงทะเบียนเพื่อเข้าใช้งานระบบ</strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>
          <form id="form2" name="form2" method="post" action="jobs_regis.php" enctype="multipart/form-data">
            <table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td colspan="2" bgcolor="#0099ff"><strong class="wh"><img src="images/arrow_right.gif" width="4" height="6"  alt=""/>&nbsp;ข้อมูลเข้าระบบ</strong></td>
              </tr>
			  <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="180" align="right">ชื่อผู้ใช้ระบบ :</td>
                <td>
                  <input name="username" type="text" id="username" value="<?php echo $username ?>" placeholder="ชื่อผู้ใช้" /> 
                  <span class="t10r">*
                  <?php
                    $str=$_POST['username'];
                    $chk4='/^[a-zA-Z0-9]{4}+/';
                    if($save==1){
                      if(!preg_match($chk4,$str,$regs)){
                        echo 'กรอกข้อมูล 4 ตัวอักษรขึ้นไปและไม่ใช่ภาษาไทย'; 
                      }
                      if($action=="1"){
                        if($username==""){
                          echo "<br>กรุณากรอก <b>ชื่อผู้ใช้ระบบ</b> ด้วย";
                        }
                      }
                    }
                  ?>
                  </span>
                </td>
              </tr>
              <tr>
                <td align="right">รหัสผ่าน :</td>
                <td><input type="password" name="pass" id="pass" placeholder="รหัสผ่าน" /> 
                  <span class="t10r">*
                  <?php
                    $str=$_POST['pass'];
                    $chk4='/^[a-zA-Z0-9]{4}+/';
                    if($save==1){
                      if(!preg_match($chk4,$str,$regs)){
                         echo 'กรอกข้อมูล 4 ตัวอักษรขึ้นไปและไม่ใช่ภาษาไทย'; 
                      }
                      if($action=="1"){
                        if($pass==""){
                          echo "<br>กรุณากรอก <b>รหัสผ่าน </b> ด้วย";
                        }elseif($pass != $re_pass){
                          echo "<br>รหัสผ่านไม่ถูกต้อง";
                        }
                      }
                    }
                  ?>
                  </span>
                </td>
              </tr>
              <tr>
                <td align="right">ยืนยันรหัสผ่าน :</td>
                <td>
                  <input type="password" name="re_pass" id="re_pass" placeholder="ยืนยันรหัสผ่าน" /> 
                  <span class="t10r">*</span>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr bgcolor="#0066FF">
                <td colspan="2" bgcolor="#0099ff"><strong class="wh"><img src="images/arrow_right.gif" width="4" height="6"  alt=""/>&nbsp;ข้อมูลทั่วไป</strong></td>
              </tr>
			  <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="right">ชื่อ-สกุล :</td>
                <td>
                  <input name="name" type="text" id="name" value="<?php echo $name ?>" placeholder="ชื่อ" />
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
                <td><input name="nickname" type="text" id="nickname" value="<?php echo $nickname ?>" placeholder="ชื่อเล่น" /></td>
              </tr>
              <tr>
                <td align="right">เพศ :</td>
                <td><input name="gender" type="radio" id="radio" value="0" <?php if($gender==0) echo " checked='checked'"; ?> />
                  ผู้ชาย 
                    <input type="radio" name="gender" id="radio2" value="1" <?php if($gender==1) echo " checked='checked'"; ?>/> 
                    ผู้หญิง</td>
              </tr>
              <tr>
                <td align="right">สถานะภาพ :</td>
                <td><input name="stat" type="radio" id="radio" value="0" <?php if($stat==0) echo " checked='checked'"; ?> />
                โสด
                  <input type="radio" name="stat" id="radio2" value="1" <?php if($stat==1) echo " checked='checked'"; ?>/>
                  สมรส</td>
              </tr>
              <tr>
                <td align="right">สัญชาติ :</td>
                <td><input name="nation" type="text" id="nation" value="<?php echo $nation ?>" placeholder="สัญชาติ" /></td>
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
                    <option value="1" selected <?php if($m==1) echo "selected='selected'"; ?>>มกราคม</option>
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
                <td align="right">รูปภาพ :</td>
                <td>
                  <input name="profile" type="file" id="profile" >&nbsp;<font class="t10r">ขนาด 354*472 px</font>
                </td>
              </tr>
			<tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
			</tr>
              <tr>
                <td colspan="2" bgcolor="#0099ff" class="wh"><strong class="wh"><img src="images/arrow_right.gif" width="4" height="6"  alt=""/>&nbsp;</strong><strong>สถานที่ติดต่อ</strong></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="right">ที่อยู่ :</td>
                <td>
                  <!-- <input name="address" type="text" id="address" value="<?php echo $address ?>" size="60" placeholder="ที่อยู่" /> -->
                  <textarea name="address" id="address" value="<?php echo $address; ?>" cols="30" rows="5" placeholder="ที่อยู่.." >
                    
                  </textarea>
                </td>
              </tr>
              <tr>
                <td align="right">อีเมล :</td>
                <td><input name="email" type="text" id="email" value="<?php echo $email ?>" placeholder="อีเมล" />
                <span class="t10r">*
                  <?php
                    $str=$_POST['email'];
                    $chkEmail='/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9._-])+\.([a-zA-Z])+$/';//Patern ตรวจสอบอีเมล เช่น 123-abc_@hotmail.co.th  
                    if($save==1){ 
                      if(!preg_match($chkEmail,$str,$regs)){
                        echo 'สามารถใช้ได้เฉพาะ a-z,A-Z,0-9,_,- เท่านั้นเช่น 123-abc_@hotmail.co.th'; 
                      }
                    }
                  ?>
                </span>
                </td>
              </tr>
              <tr>
                <td align="right">เบอร์โทรศัพท์ :</td>
                <td><input name="telephone" type="text" id="telephone" value="<?php echo $telephone ?>" placeholder="เบอร์โทรศัพท์" />
                <span class="t10r">*       
                <?php  
                  $str=$_POST['telephone'];
                  if($save==1){
                    $chkNumb='/^\d+$/';//Pattern ตรวจสอบข้อมูลที่เป็นตัวเลขเท่านั้น  
                    if(!preg_match($chkNumb,$str,$regs)){
                       echo 'เป็นตัวเลขเท่านั้น'; 
                    }
                  }
                ?>
                </span>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="#0099ff"><strong class="wh"><img src="images/arrow_right.gif" width="4" height="6"  alt=""/>&nbsp;ความถนัดทางวิชาชีพ</strong></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="right">รายวิชาที่ถนัด :</td>
                <td>
                    <select name="subj" id="subj">
                        <option value="math" <?php if($subj=="math") echo "selected='selected'"; ?>>คณิตศาสตร์</option>
                        <option value="science" <?php if($subj=="science") echo "selected='selected'"; ?>>วิทยาศาสตร์</option>
                        <option value="english" <?php if($subj=="english") echo "selected='selected'"; ?>>ภาษาอังกฤษ</option>
                        <option value="physics" <?php if($subj=="physics") echo "selected='selected'"; ?>>ฟิสิกส์</option>
                        <option value="chemistry" <?php if($subj=="chemistry") echo "selected='selected'"; ?>>เคมี</option>
                    </select>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input name="action" type="hidden" id="action" value="1" />
                <input name="id" type="hidden" id="id" value="<?php echo $id; ?>" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="button" id="button" value="ยืนยัน" class="btn-primary"/></td>
              </tr>
            </table>
          </form></td>
        </tr>
    </table>
  </body>
</html>

<?php
	mysqli_close($dbcon);
?>