<?php
    session_start();
  
  include('config/config.php');
  mysql_connect($host,$hostuser,$hostpass);
  mysql_query("SET NAMES UTF8");
    
  $page=$_GET["page"];
  if (empty($page)){
    $page=1;
  }
  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $ribon; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <? include "header.php";?>
  </tr>
  <tr>
    <td height="46" background="images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top">&nbsp;</td>
        <td width="5" valign="top">&nbsp;</td>
        <td width="759" valign="top">

       <table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center"></td>
      </tr>
      <tr>
        <td align="center"><p>กำลังอัปโหลด<br />
          กรุณารอสักครู่..........</p>
                  <p>
        <?php
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
            $file = $_FILES['profile']['name'];
            $jobs_reg=date("Y-m-d");
            $tempfile = $jobs_reg."-".$file;
            
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

            if ($nickname=="") {
              $save=0;
            }

            if ($gender=="") {
              $save=0;
            }

            if ($stat=="") {
              $save=0;
            }

            if ($nation=="") {
              $save=0;
            }

            if ($address=="") {
              $save=0;
            }

            if ($email=="") {
              $save=0;
            }

            if ($telephone=="") {
              $save=0;
            }

            if ($subj=="") {
              $save=0;
            }



          //เริ่มบันทึก
          if($save==1){
            if($id !=""){
              $sql="update jobs set username='$username' , pass='$pass' , name='$name' , surname='$surname' , nickname='$nickname' , gender='$gender' , stat='$stat' , nation='$nation' , address='$address' , email='$email' , telephone='$telephone' , subj='$subj' ";
              $sql=$sql." where jobs_id=$id";
            }else{
              $target_path = "images/profile/";
              $target_path = $target_path . basename($tempfile);
              @chmod($target_path,0777);
              if(move_uploaded_file($_FILES['profile']['tmp_name'], $target_path)) {
                $sql="insert into jobs(username , pass , name , surname ,nickname , gender , stat , nation , birthday , address , email , telephone , subj )";
                $sql=$sql . " values('$username' , '$pass' , '$name' , '$surname' ,'$nickname' , '$gender' , '$stat' , '$nation' , '$birthday' , '$address' , '$email' , '$telephone' , '$subj')";
                $result=mysql_db_query($database,$sql);
              }else{
                echo "There was an error uploading the file, please try again!";
              }
            }
              $result=mysql_db_query($database,$sql);
              echo "<script language=\"javascript\">window.location.href = 'news_frm.php'</script>";
              exit();
            }
        }

          ?>
                  </p></td>
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
  mysql_close();
?>