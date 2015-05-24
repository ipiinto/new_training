<link href="style.css" rel="stylesheet" type="text/css">
<link href="bootstrap-3.2.0-dist/css/bootstrap.css" rel="stylesheet" type="text/css">
<td height="81" background="images/bg_banner.jpg">
<?php
  if(isset($_SESSION['login'])==""){
?>  
    <div class="table-responsive">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="446"><a href="index.php"><img src="images/top_logo1.png" width="446" height="75" /></a></td>
          <td width="265">&nbsp;</td>
          <td width="357">
            <form name='form1' method='post' action='chklogin.php'>
            <table width='100%' border='0' cellspacing='2' cellpadding='2'>
             	<tr>
                <td><font color='#FFFFFF'>ชื่อผู้ใช้</font></td>
                <td><font color='#FFFFFF'>รหัสผ่าน</font></td>
              </tr>
              <tr>
                <td><input name='username' type='text' autofocus id='username' size='15' placeholder="กรอกชื่อผู้ใช้"></td>
                <td><input name='pass' type='password' id='pass' size='15' placeholder="กรอกรหัสผ่าน"></td>
                <td><button type="submit" class="btn btn-primary btn-xs" >เข้าสู่ระบบ</button></td>
              </tr>
              <tr>
                <td>
                  <input type='checkbox' name='remember' id='remember'><label for='remember'>
                  <font color='#FFFFFF'>จำชือผู้ใช้</font></label>
                </td>
                <td>
                  <a href='forgot_pwd.php'><font color='#FFFFFF'>ลืมรหัสผ่าน ?</font></a></td>
                <td>
                  <a href='registered.php'><font color='#FFFFFF' size='2'>สมัครสมาชิก</font></a>
                </td>
              </tr>
    		    </table>
            </form>
          </td>
        </tr>
    	</table>
    </div>
  </td>
<?php
  }else{
    if (!empty($_SESSION['state']) && !empty($_SESSION['login'])) {
      $state = $_SESSION['state'];
      $login = $_SESSION['login'];
      if ($state == 'ผู้ดูแลระบบ') {
        $state = 'office';
        $sele = "name";
      } elseif ($state == 'อาจารย์') {
        $state = 'teacher';
        $sele = "name, surname";
      } elseif ($state == 'นักเรียน') {
        $state = 'member';
        $sele = "name, surname";
      }
    }
    $sql = "SELECT $sele FROM $state WHERE username = '$login'";
    $result = mysqli_query($dbcon,$sql);
    while ($rows = mysqli_fetch_array($result)) {
      $name = $rows['name'];
      @$surname = $rows['surname'];
    }
?>
  <div class="table-responsive">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="446"><a href="index.php"><img src="images/top_logo1.png" width="446" height="75" /></a></td>
        <td width="256">&nbsp;</td>
        <td width="366">
        <font color='#FFFFFF'>ยินดีต้อนรับคุณ </font><a href='edit_profile.php'><font color='#FFFFFF'><?php echo $name ?>&nbsp;&nbsp;<?php echo $surname ?></a>&nbsp;&nbsp;(<?php echo $state ?>)</font>
        <br><a href='change_pwd.php'><font color='#FFFFFF'>เปลี่ยนรหัสผ่าน</font></a>
        <a href='logout.php'><font color='#FFFFFF'>ออกจากระบบ</font></a>
        </td>
      </tr>
    </table>
  </div>
<?php
  }
?>
</td>