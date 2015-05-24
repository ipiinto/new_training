<?php
	session_start();
	include('../config/config.php');
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
  $save = 0;
  if (!empty($_POST["save"])) {
    $save=$_POST["save"];
    $pass=$_POST["pass"];
    $new=$_POST["new"];
    $confirm_new=$_POST["confirm_new"];
    if($save==1){
      if($pass!="" and $new!="" and $confirm_new!=""){
        if($new==$confirm_new){
          $sql="select * from teacher where teacher_id=" . $_SESSION['id'];
          $sql=$sql. " and pass='$pass'";
          $result=mysqli_query($dbcon,$sql);
          $nRow=mysqli_num_rows($result);
          if($nRow!=0){
            $sql="update teacher set pass='$new' ";
            $sql=$sql . " where teacher_id=" . $_SESSION['id'];
            $result=mysqli_query($dbcon,$sql);
            echo "<script language=\"javascript\">window.location.href = 'index.php'</script>";
            exit();
          }
        }
      }
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
    <td height="46" background="../images/bg_menu.png"><?php include('../teacher/menu.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="400" align="center" valign="top">
    
   	  <table width="60%" border="0">
      <form action="change_pwd.php" method="post">
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td width="50%" align="right">รหัสผ่านเดิม :&nbsp;</td>
    <td width="50%">&nbsp;<input name="pass" type="password" maxlength="12" />
      <?php
		if($save==1){
			if($pass==""){
				echo "<font color='red'>คุณยังไม่ได้รหัสผ่านเดิม</font>";
			}else{
					
			}
		}
	?></td>
  </tr>
  <tr>
    <td align="right">รหัสผ่านใหม่ :&nbsp;</td>
    <td>&nbsp;<input name="new" type="password" maxlength="12" />
      <?php
		if($save==1){
			if($new==""){
				echo "<font color='red'>ไม่ได้กรอกรหัสผ่าน</font>";
			}elseif($confirm_new!=$new){
				echo "<font color='red'>รหัสผ่านไม่ตรงกัน</font>";
			}
		}
	?></td>
  </tr>
  <tr>
    <td align="right">ยืนยันรหัสผ่าน :&nbsp;</td>
    <td>&nbsp;<input name="confirm_new" type="password" maxlength="12" />
      <?php
		if($save==1){
			if($confirm_new==""){
				echo "<font color='red'>ไม่ได้กรอกรหัสผ่าน</font>";
			}elseif($confirm_new!=$new){
				echo "<font color='red'>รหัสผ่านไม่ตรงกัน</font>";
			}
		}
	?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="" type="submit" value="ยืนยัน" />
      <input name="save" type="hidden" id="save" value="1" />
      <input name="username" type="hidden" id="username" value="<?php echo $username ?>" /></td>
    </tr>
    </form>
</table>

    
    </td>
  </tr>
  </table>
</body>
</html>
<?php
	mysqli_close($dbcon);
?>