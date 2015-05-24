<?php
  session_start();
	include('../config/config.php');
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
  if (!empty($_SESSION["id"])) {
      $id = $_SESSION["id"];
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
    <td height="400" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>รายวิชาที่สอน</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
        <?php
    			// $sql="select subject.sub_id , subject.sub_name , subject.time_sub , detail from subject , subject_list ";
    			// $sql=$sql . " where subject.sub_id=subject_list.sub_id and subject_list.teacher_id=" . $_SESSION["id"] ;
    			// $sql=$sql . " order by subject.sub_name";
          $sql = "SELECT section.sub_id, subject.sub_name, subject.time_sub, subject.detail, section.day, section.since, section.until, section.room
                  FROM section
                  LEFT JOIN subject
                  ON section.sub_id = subject.sub_id
                  WHERE section.teacher_id = '$id'"; 
    			$result=mysqli_query($dbcon,$sql);
    			while($row=mysqli_fetch_array($result)){
            $sub_id = $row['sub_id'];
            $sub_name = $row['sub_name'];
            $time_sub = $row['time_sub'];
            $detail = $row['detail'];
            $day = $row['day'];
            $since = $row['since'];
            $until = $row['until'];
            $room = $row['room'];
    		?>
        <tr>
          <td width="50" align="center"><img src="../images/education.png" width="50" height="50" /></td>
          <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td><strong><a href='document.php?sub_id=<?php echo $row[0] ?>'><?php echo $sub_name ?></a></strong><br>(<?php echo $row[2] ?> ชั่วโมง)</td>
            </tr>
            <tr>
              <td>
                <?php 
                echo ("รายละเอียด : ").$detail.("<br>"); 
                echo ("วัน : ").getDay($day).("<br>");
                echo ("เวลา : ").getSince($since).(" - ").getUntil($until);
                ?>
              </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="2"><hr /></td>
          </tr>
          <?php
    			 }
    			?>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>

</table>
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
  mysqli_free_result($result);
	mysqli_close($dbcon);
?>