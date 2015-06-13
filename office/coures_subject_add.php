<?php
  session_start();
	
	include('../config/config.php');
	
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	$cos_id=$_GET["cos_id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

  <link rel="stylesheet" href="/resources/demos/style.css" />

  <script>

  $(function() {

    $( "#begin_day" ).datepicker({ dateFormat: "yy-mm-dd" });

  });
  
  $(function() {

    $( "#end_day" ).datepicker({ dateFormat: "yy-mm-dd" });

  });

  </script>
  <style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
  </style>
</head>

<body>
<table width="1024" bgcolor="#FFFFFF" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <?php include '../office/header.php'?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><?php include('course_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td valign="top">
        <form id="form1" name="form1" method="post" action="coures_subject_action.php">
          <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#5F7AC3">
            <tr bgcolor="#5F7AC3">
              <td width="20">&nbsp;</td>
              <td><span class="style1">รายชื่อวิชา</span></td>
            </tr>
            <?php
      				$i=1;
      				$sql="select sub_id , sub_name from subject  order by sub_id ";
      				$result=mysqli_query($dbcon,$sql);
      				while($row=mysqli_fetch_array($result)){
            ?>
            <tr>
              <td bgcolor="#FFFFFF"><div align="center">
                <input name="ch_<?php echo $i ?>" type="checkbox" id="ch_<?php echo $i ?>" value="1" 
            <?php
        					$sql="select * from course_item where cos_id=$cos_id and sub_id=$row[0] ";
        					$result_ch=mysqli_query($dbcon,$sql);
        					$nRow=mysqli_num_rows($result_ch);
        					if($nRow !=0){
        					echo " checked='checked'";
      				}
				    ?>
                 />
              </div>
              </td>
              <td bgcolor="#FFFFFF"><?php echo $row[1] ?></td>
            </tr>
            <?php
        				$i++;
        			}
      			?>
            <tr bgcolor="#5F7AC3">
              <td>&nbsp;</td>
              <td bgcolor="#5F7AC3">
              	<input type="submit" name="button" id="button" value="บันทึก" />
                <input name="cos_id" type="hidden" id="cos_id" value="<?php echo $cos_id ?>" /></td>
            </tr>
          </table>
		    </form>
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