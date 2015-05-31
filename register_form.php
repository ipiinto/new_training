<?php
  session_start();
  
  include('config/config.php');
  mysql_connect($host,$hostuser,$hostpass);
  mysqli_query("SET NAMES UTF8");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $ribon; ?></title>
          <link rel="stylesheet" href="bootstrap-3.2.0-dist/css/bootstrap.min.css">
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">-->
    <style type="text/css">
        .form-group{ margin-bottom:0px !important;}
        .form-control-feedback{top:0px !important;}
    </style>
    <link href="bootstrap-3.2.0-dist/css/bootstrap.css" rel="stylesheet" type="text/css">
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
        </button>
        <a class="navbar-brand" href="index1.php">
          <div class="logo-xs visible-xs"></div>
          <div class="logo-lg hidden-xs"></div>
        </a>
     </div>
     <div class="collapse navbar-collapse navbar-ex1-collapse" id="id_nav1">
        <ul class="nav navbar-nav">
          <li><a href="index1.php">หน้าหลัก</a></li>
          <li><a href="regis_form.php">สมัครสมาชิก</a></li>
          <li><a href="howto-regis.php">การสมัครเรียน</a></li>
        </ul>
        <form class="navbar-form navbar-right" method='post' action='chklogin.php'>
          <div class="form-group">
            <label>ชื่อผู้ใช้</label>
            <input name="username" type="text" class="form-control input-sm" id="username" placeholder="กรอกชื่อผู้ใช้"  />
          </div>
          <div class="form-group">
            <label>รหัสผ่าน</label>
            <input name="pass" type="password" class="form-control input-sm" id="pass" placeholder="รหัสผ่าน"  />
          </div>
          <button class="btn btn-primary btn-sm" type="submit" >เข้าสู่ระบบ</button>
        </form>   
     </div>
  </nav>
      <div class="col-md-12"> 
        <div style="margin:auto;width:80%;">  
          <form class="form" id="myform1" name="form1" method="post" action="registered.php" enctype="multipart/form-data">
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
                    <input name="username" type="text" class="form-control css-require" id="username" placeholder="กรอกชื่อผู้ใช้"  />
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
                <td width="25%" align="right">รหัสผ่าน</td>
                <td align="left">
                  <div class="form-group has-feedback" style="width:250px;">
                    <input name="pass" type="password" class="form-control css-require" id="pass" placeholder="รหัสผ่าน"  />
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <span class="t10r">
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
                  </div>       
                </td>
              </tr>
              <tr>
                <td width="25%" align="right">ยืนยันรหัสผ่าน</td>
                <td align="left">
                  <div class="form-group has-feedback" style="width:250px;">
                    <input class="form-control css-require" name="re_pass" type="password" id="re_pass" placeholder="กรอกยืนยันรหัสผ่าน"  />
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>       
                </td>
              </tr>
              <tr>
                <td width="25%" align="right">ชื่อ นามสกุล </td>
                <td align="left">
                  <div class="form-inline">
                    <div class="form-group has-feedback" style="width:220px;">
                      <input name="name" type="text" class="form-control css-require" id="name" placeholder="กรอกชื่อ"  />
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                     <div class="form-group has-feedback" style="width:220px;">
                      <input name="surname" type="text" class="form-control css-require" id="surname" placeholder="กรอกสกุล"  />
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                  </div>        
                </td>
              </tr>
              <tr>
                <td width="25%" align="right">ชื่อเล่น</td>
                <td align="left">
                  <div class="form-group has-feedback" style="width:250px;">
                    <input name="nickname" type="text" class="form-control css-require" id="nickname" placeholder="กรอกนามสกุล"  />
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
                    <label><input name="gender" type="radio" value="ชาย"  /> ชาย</label>
                    &nbsp;
                    <label><input name="gender" type="radio" value="หญิง" /> หญิง</label>
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
                    <textarea name="address" cols="50" rows="4" class="form-control css-require" id="address" placeholder="ที่อยู่ติดต่อ.."></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>              
                </td>
              </tr>
              <tr>
                <td align="right">อีเมล</td>
                <td align="left">
                  <div class="form-group has-feedback" style="width:250px;">
                    <input name="email" type="text" class="form-control css-require" id="email" placeholder="อีเมล" />
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
                    <input name="telephone" type="text" class="form-control css-require" id="telephone" placeholder="กรอกเบอร์โทรศัพท์"  />
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
                    <input name="parents_name" type="text" class="form-control css-require" id="parents_name" placeholder="ชื่อผู้ปกครอง"  />
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>       
                </td>
              </tr>
              <tr>
                <td width="25%" align="right">เบอร์โทรผู้ปกครอง</td>
                <td align="left">
                  <div class="form-group has-feedback" style="width:250px;">
                    <input name="parents_tel" type="text" class="form-control css-require" id="parents_tel" placeholder="เบอร์โทรผู้ปกครอง"  />
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
    <!-- Scropt -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>      
<script type="text/javascript">
  $(function(){ 
    var obj_check=$(".css-require");
    $("#myform1").on("submit",function(){
      obj_check.each(function(i,k){
      var status_check=0;
      if(obj_check.eq(i).find(":radio").length>0 || obj_check.eq(i).find(":checkbox").length>0){
        status_check=(obj_check.eq(i).find(":checked").length==0)?0:1;    
      }else{
        status_check=($.trim(obj_check.eq(i).val())=="")?0:1;
      }
        formCheckStatus($(this),status_check);      
    });
    if($(this).find(".has-error").length>0){
      return false;
    }
  });
     
  obj_check.on("change",function(){
    var status_check=0;
    if($(this).find(":radio").length>0 || $(this).find(":checkbox").length>0){
      status_check=($(this).find(":checked").length==0)?0:1;    
    }else{
      status_check=($.trim($(this).val())=="")?0:1;
    }
      formCheckStatus($(this),status_check);       
  });
  var formCheckStatus = function(obj,status){
      if(status==1){
        obj.parent(".form-group").removeClass("has-error").addClass("has-success");
        obj.next(".glyphicon").removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");    
      }else{
        obj.parent(".form-group").removeClass("has-success").addClass("has-error");
        obj.next(".glyphicon").removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");      
      }
  }

 });
</script>   

  </body>
</html>

<?php
  mysqli_close($dbcon);
?>