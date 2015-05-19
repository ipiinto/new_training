<?php
	session_start();
	
	include('../config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
.style1 {	color: #FFFFFF;
	font-weight: bold;
}
</style>
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0"  >
  <tr>
  	<?php
  		include "../header.php";
  	?>

  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td>

	  <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#5F7AC3">
		  <tr bgcolor="#5F7AC3">
		    <td colspan="2" align="left" valign="middle"><div align="left">
		      <p class="style1">ข่าวงานประชาสัมพันธ์</p>
		    </div></td>
	    </tr>
		  		<?php
				  	$sql="select * from news where news_id=$news_id ";
					$result=mysql_db_query($database,$sql);
					echo $sql;
					$nRow=mysql_num_rows($result);
					$result=mysql_db_query($database,$sql);
					while($row=mysql_fetch_array($result)){
				?>
		  <tr>
		    <td width="198" bgcolor="#FFFFFF"><b>หัวข้อข่าวประชาสัมพันธ์ :</b></td>
		    <td width="823" align="left" bgcolor="#FFFFFF"><?php  echo $row[1] ?></td>
	    </tr>
        <tr>
        	<?php
        		if($row['banner'] != ""){
        	?>
        	<td colspan="2" bgcolor="#FFFFFF">
            	<img style='width:700;' height='306' src="../images/banner/<?php echo $row['banner'];?>">
            </td>
            <?php
            	}
            ?>
        </tr>
        <tr>
		    <td width="198" bgcolor="#FFFFFF"><b>เนื้อข่าว :</b></td>
		    <td width="823" align="left" bgcolor="#FFFFFF"><?php  echo $row[3] ?></td>
	    </tr>
        <tr>
        	<td bgcolor="#FFFFFF" colspan="2" align="right">ลงเมื่อ วันที่ :<?php echo $row[5] ?></td>
        </tr>
			<?php
				  	}
			?>
		  <tr>
		    <td colspan="2" bgcolor="#5F7AC3">
            </td>
	    </tr>
    </table><br />
     <p align="right"><<<[<a href="index.php">กลับสู่หน้าหลัก</a>]</p>
    </td>
   
  </tr>
</table>
</body>
</html>
<?php
/*	session_destroy();
	mysql_close();*/
?>