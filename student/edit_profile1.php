<?php
  session_start();
	
	include('../config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
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
		$parents_name=$_POST["parents_name"];
		$parents_tels=$_POST["parents_tels"];
		$d=$_POST["d"];
		$m=$_POST["m"];
		$y=$_POST["y"];
				
		$birthday="$y-$m-$d";
	}else{
		$sql="select * from member where member_id=".$_SESSION['id'];
		$result=mysql_db_query($database,$sql);
		$rows=mysql_fetch_array($result);
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
		$parents_name=$rows["parents_name"];
		$parents_tel=$rows["parents_tel"];
		
	}
	
	if($action==1){
		if($name !="" and $surname !="" and $nickname !="" and $email !="" and $gender !="" and $telephone !="" and $address !="" and $parents_name !="" and $parents_tel !=""){
			$sql="update member set name='$name' , surname='$surname' , nickname='$nickname' , email='$email' , gender='$gender' , telephone='$telephone' , address='$address' , parents_name='$parents_name' , parents_tel='$parents_tel ' ";
				$sql=$sql . " where member_id=".$_SESSION["id"];
				$result=mysql_db_query($database,$sql);
				echo "<script language=\"javascript\">window.location.href = 'index.php'</script>";
				exit();
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <title><?php echo $ribbon;?></title>
   <link rel="stylesheet" type="text/css" href="../bootstrap-3.2.0-dist/css/bootstrap.css">
    <script type="text/javascript" src="style.css"></script>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top">
       <div class="navbar-header">
          <button class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#id_nav1"
          >
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index1.php">
            <div class="logo-xs visible-xs"></div>
            <div class="logo-lg hidden-xs"></div>
          </a>
       </div>
       <div class="collapse navbar-collapse navbar-ex1-collapse" id="id_nav1">
          <ul class="nav navbar-nav">
            <li><a href="index1.php">หน้าหลัก</a></li>
            <li><a href="list_subject.php">รายวิชาที่เปิดสอน</a></li>
            <li><a href="schedule.php">ตารางเรียน</a></li>
            <li><a href="../forum/forum.php">กระดานถามตอบ</a></li>
          </ul>
          <ul class="nav navbar-right">
            <?php
              $sql="select * from member where username='".$_SESSION['login']."'";
              $result=mysql_db_query($database,$sql);
              $rows=mysql_fetch_array($result);
            ?>
            <li class="dropdown" style="margin-top:1px" style="margin-right:15px">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                  if($rows['fileupload']!=''){
                ?>
                    <img src="../images/profile/<?=$rows['fileupload'];?>" class="profile-image img-rounded"  >&nbsp;&nbsp;<?=$rows['username'];?> <span class="caret"></span>
                <?php
                  }else{
                ?>
                    <img src="../images/avatar.jpg" class="profile-image img-rounded"  >&nbsp;&nbsp;<?=$rows['username'];?> <span class="caret"></span>
                <?php
                
                  }
                ?>
              </a>
              <ul class="dropdown-menu">
                <li sytle="width:100px"><a href="change_pwd.php">เปลี่ยนรหัสผ่าน</a></li>
                <li><a href="edit_profile.php">แก้ไขข้อมูลส่วนตัว</a></li>
                <li><a href="logout.php">ออกจากระบบ</a></li>
              </ul>
            </li> 
          </ul>   
       </div>
    </nav>
  <div class="col-md-12"> 
        <div style="margin:auto;width:80%;">  
          <form class="form" id="myform1" name="form1" method="post" action="edit_profile.php" enctype="multipart/form-data">
            <table class="table" width="100%" border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><input name="action" type="hidden" id="action" value="1" /></td>
              </tr>
              <tr>
                <td colspan="2"><input name="id" type="hidden" id="id" value="<?php echo $id; ?>" /></td>
              </tr>
              <tr>
                <td width="25%" align="right">ชื่อผู้ใช้</td>
                <td align="left">
                  <div class="form-group has-feedback" style="width:250px;">
                    <input name="username" type="text" class="form-control css-require" id="username" placeholder="กรอกชื่อผู้ใช้" value="<?php echo $username ?>"  disabled/>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <span class="t10r">
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
                  </div>       
                </td>
              </tr>
              <tr>
                <td width="25%" align="right">ชื่อ นามสกุล </td>
                <td align="left">
                  <div class="form-inline">
                    <div class="form-group has-feedback" style="width:220px;">
                      <input name="name" type="text" class="form-control css-require" id="name" value="<?php echo $name ?>" placeholder="กรอกชื่อ"  />
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                     <div class="form-group has-feedback" style="width:220px;">
                      <input name="surname" type="text" class="form-control css-require" id="surname" value="<?php echo $surname ?>" placeholder="กรอกสกุล"  />
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                  </div>        
                </td>
              </tr>
              <tr>
                <td width="25%" align="right">ชื่อเล่น</td>
                <td align="left">
                  <div class="form-group has-feedback" style="width:250px;">
                    <input name="nickname" type="text" class="form-control css-require" id="nickname" value="<?php echo $nickname ?>" placeholder="กรอกนามสกุล"  />
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>       
                </td>
              </tr>
              <tr>
                <td width="25%" align="right">รูปภาพ</td>
                <td align="left">
                  <div class="form-group has-feedback" style="width:250px;">
                    <input name="fileupload" type="file" id="fileupload" class="form-control css-require"/>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>  
                </td>
              </tr>
              <tr>
              <tr>
                <td align="right">เพศ</td>
                <td align="left">
                  <div class="form-group has-feedback" style="width:200px;">     
                    <div class="form-control css-require">
                    <label><input name="gender" type="radio" value="ชาย" <?php if($gender=='ชาย') echo " checked='checked'"; ?> /> ชาย</label>
                    &nbsp;
                    <label><input name="gender" type="radio" value="หญิง" <?php if($gender=='หญิง') echo " checked='checked'"; ?> /> หญิง</label>
                    </div>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>    
                </td>
              </tr>
              <tr>
                <td width="25%" align="right">วันเกิด</td>
                <td align="left">
                  <div class="form-inline">     
                    <select class="form-control css-require" name="d" id="d" >
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
                    <select class="form-control css-require" name="m" id="m" >
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
                    <select class="form-control css-require" name="y" id="y" >
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
                    </div>
                  </div>     
                </td>
              </tr>
              <tr>
                <td align="right">ที่อยู่ติดต่อ</td>
                <td align="left">
                  <div class="form-group  has-feedback" style="width:350px;">      
                    <textarea name="address" cols="50" rows="4" class="form-control css-require" id="address" value="<?php echo $address ?>" placeholder="ที่อยู่ติดต่อ.."></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>              
                </td>
              </tr>
              <tr>
                <td align="right">อีเมล</td>
                <td align="left">
                  <div class="form-group has-feedback" style="width:250px;">
                    <input name="email" type="text" class="form-control css-require" id="email" value="<? echo $email ?>" placeholder="อีเมล" />
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <span class="t10r"> 
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
                  </div>                  
                </td>
              </tr>
              <tr>
                <td width="25%" align="right">เบอร์โทรศัพท์</td>
                <td align="left">
                  <div class="form-group has-feedback" style="width:250px;">
                    <input name="telephone" type="text" class="form-control css-require" id="telephone" value="<?php echo $telephone ?>" placeholder="กรอกเบอร์โทรศัพท์"  />
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <span class="t10r">        
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
                  </div>       
                </td>
              </tr>
              <tr>
                <td width="25%" align="right">ชื่อผู้ปกครอง</td>
                <td align="left">
                  <div class="form-group has-feedback" style="width:250px;">
                    <input name="parents_name" type="text" class="form-control css-require" id="parents_name" value="<?php echo $parents_name ?>" placeholder="ชื่อผู้ปกครอง"  />
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>       
                </td>
              </tr>
              <tr>
                <td width="25%" align="right">เบอร์โทรผู้ปกครอง</td>
                <td align="left">
                  <div class="form-group has-feedback" style="width:250px;">
                    <input name="parents_tel" type="text" class="form-control css-require" id="parents_tel" value="<?php echo $parents_tel ?>" placeholder="เบอร์โทรผู้ปกครอง"  />
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>       
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center"><button type="submit" class="btn btn-primary" name="submit" />สมัครสมาชิก</button></td>
              </tr>
              <tr>
                <td> </td>
                <td align="left"></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
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