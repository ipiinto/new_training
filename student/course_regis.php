<?php
  session_start();
  
  include('../config/config.php');
  mysql_connect($host,$hostuser,$hostpass);
  mysql_query("SET NAMES UTF8");
  
  if($_SESSION["login"]==""){
    echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
    exit();
  }
?>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <title><?php echo $ribbon;?></title>
   <link rel="stylesheet" type="text/css" href="../bootstrap-3.2.0-dist/css/bootstrap.css">
    <script type="text/javascript" src="../style.css"></script>
    <script src="../jquery/jquery-2.1.3.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript"><!--
 
var formblock;
var forminputs;
 
function prepare() {
  formblock= document.getElementById('form1');
  forminputs = formblock.getElementsByTagName('input');
}
 
function select_all(name, value) {
  for (i = 0; i < forminputs.length; i++) {
    // regex here to check name attribute
    var regex = new RegExp(name, "i");
    if (regex.test(forminputs[i].getAttribute('name'))) {
      if (value == '1') {
        forminputs[i].checked = true;
      } else {
          forminputs[i].checked = false;
      }
    }
  }
}
 
if (window.addEventListener) {
  window.addEventListener("load", prepare, false);
} else if (window.attachEvent) {
  window.attachEvent("onload", prepare)
} else if (document.getElementById) {
  window.onload = prepare;
}
 
//--></script>
  </head>
  <body>
  <?php
    if(isset($_SESSION['id'])==""){
  ?>
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
            <li><a href="registered.php">สมัครสมาชิก</a></li>
            <li><a href="howto-regis.php">การสมัครเรียน</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <label>Username</label>
              <input name="username" type="text" class="form-control input-sm" id="username" placeholder="กรอกชื่อผู้ใช้"  />
            </div>
            <div class="form-group">
              <label>Password</label>
              <input name="pass" type="password" class="form-control input-sm" id="pass" placeholder="รหัสผ่าน"  />
            </div>
            <button class="btn btn-primary btn-sm" type="button" >เข้าสู่ระบบ</button>
          </form>   
       </div>
    </nav>
  <?php
    }else{
  ?>
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
                <li sytle="width:100px"><a href="change_pwd.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;เปลี่ยนรหัสผ่าน</a></li>
                <li><a href="edit_profile.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;แก้ไขข้อมูลส่วนตัว</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;ออกจากระบบ</a></li>
              </ul>
            </li> 
          </ul>   
       </div>
    </nav>
  <?php
    }
  ?>
      <form id="form1" name="form1" method="post" action="../student/course_reg_action.php">
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
            	<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table table-hover table-bordered">
                <tr>
              <td colspan="3" align="left"><a href="#" onclick="select_all('sub_id', '1');"><i class="glyphicon glyphicon-check"></i>&nbsp;เลือกทั้งหมด</a> | <a href="#" onclick="select_all('sub_id', 
'0');"><i class="glyphicon glyphicon-unchecked"></i>&nbsp;ไม่เลือกเลย</a></td>
              </tr>
            <?php
        $i=1;
        $j=0;
        $sql="select subject.sub_id , subject.sub_name from subject , course_item ";
        $sql=$sql . " where subject.sub_id=course_item.sub_id and course_item.cos_id=$cos_id order by sub_id ";
        $result=mysql_query($sql);
        while($row=mysql_fetch_array($result)){
        //print_r($row);
        echo"<br/>";
      ?>
              <tr>
                <!-- Subjects -->
                        <td width="87" rowspan="2" align="center" valign="middle"><input type="checkbox" name="sub_id[<?php echo $j; ?>]" id="sub_id[<?php echo $j; ?>]" value="<?php echo $row[0] ?>" /></td>
                        <td width="95" align="right"><strong>ชื่อวิชา :</strong></td>
                        <td>
                          <?php
                            echo $row[1];
                          ?>
                        </td>
                        </tr>
                      <tr>
                      <td align="right" valign="middle"><strong>กลุ่มเรียน : </strong></td>
                      <td><!--<select name="sec_id[]" id="sec_id[]">-->
                        <?php
                  $sql_sec="select sec_id,sec_name,day,since,until from section where sub_id=$row[0] and cos_id=$cos_id ";
                  $sql_sec=$sql_sec . "order by sec_id";
                  $result_sec=mysql_query($sql_sec);
                  while($row_sec=mysql_fetch_array($result_sec)){
                    $strDay=getDay($row_sec[2]);
                    $strSince=getSince($row_sec[3]);
                    $strUntil=getUntil($row_sec[4]);
                    //echo "<option value='$row_sec[0]'>$row_sec[1] - วัน$strDay &nbsp;ตั้งแต่&nbsp;$strSince&nbsp;ถึง&nbsp;$strUntil</option>";
                    echo "<input type='radio' name='sec_id[$j]' id='sec_id[$j]' value='$row_sec[0]'>$row_sec[1]- วัน$strDay &nbsp;ตั้งแต่&nbsp;$strSince&nbsp;ถึง&nbsp;$strUntil";
                    echo "</br>";
                  }
                ?>
                        </td><!--</select>-->
              </tr>
            
            <?php
          $i++;
          $j++;
        }
      ?>
            <tr>
              <td colspan="2" align="right"></td>
              <td><input type="submit" name="button" id="button" class="btn btn-primary" value="ลงทะเบียนเรียน" />
                <input name="cos_id" type="hidden" id="cos_id" value="<?php echo $cos_id ?>" />
                <input name="end" type="hidden" id="end" value="<?php echo $i ?>" /></td>
                
              </tr>
            </table>
          </form>
  </body>
</html>
<?php
  function getDay($d){
      if($d==1){
        $da='อาทิตย์';  
      }elseif($d==2){
        $da='จันทร์';
      }elseif($d==3){
        $da='อังคาร';
      }elseif($d==4){
        $da='พุธ';
      }elseif($d==5){
        $da='พฤหัสบดี';
      }elseif($d==6){
        $da='ศุกร์';
      }else{
        $da='เสาร์';
      }
      
      return $da;
  }
  
  function getSince($s){
    if($s==1){
      $si='8.30'; 
    }elseif($s==2){
      $si='9.30'; 
    }elseif($s==3){
      $si='10.30';  
    }elseif($s==4){
      $si='11.30';  
    }elseif($s==5){
      $si='12.30';  
    }elseif($s==6){
      $si='13.30';  
    }elseif($s==7){
      $si='14.30';  
    }elseif($s==8){
      $si='15.30';  
    }elseif($s==9){
      $si='16.30';  
    }elseif($s==10){
      $si='17.30';  
    }elseif($s==11){
      $si='18.30';  
    }else{
      $si='19.30';  
    }
    return $si; 
  }
  
  function getUntil($u){
    if($u==2){
      $ut='9.30'; 
    }elseif($u==3){
      $ut='10.30';  
    }elseif($u==4){
      $ut='11.30';  
    }elseif($u==5){
      $ut='12.30';  
    }elseif($u==6){
      $ut='13.30';  
    }elseif($u==7){
      $ut='14.30';  
    }elseif($u==8){
      $ut='15.30';  
    }elseif($u==9){
      $ut='16.30';  
    }elseif($u==10){
      $ut='17.30';  
    }elseif($u==11){
      $ut='18.30';  
    }else{
      $ut='19.30';  
    }
    return $ut; 
  }

  mysql_close();
?>