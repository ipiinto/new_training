<?php
	session_start();
	
	include('../config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	
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
<title><?php echo $ribon; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">

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
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <?php include "../student/header.php";?>
      </tr>
    </table>      <a href="../index.php"></a></td>
  </tr>
  <tr>
    <td height="46" valign="middle" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
    <td height="400" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td><strong>ลงทะเบียนเรียน</strong></td>
      </tr>
      <tr>
        <td><form id="form1" name="form1" method="post" action="../student/course_reg_action.php">
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td colspan="2"><strong>รายวิชาในหลักสูตร</strong></td>
              <td width="824">&nbsp;</td>
              </tr>
            <tr>
              <td colspan="2" align="right"><a href="#" onclick="select_all('sub_id', '1');">เลือกทั้งหมด</a> | <a href="#" onclick="select_all('sub_id', 
'0');">ไม่เลือกเลย</a></td>
              <td>&nbsp;</td>
              </tr>
            <hr />
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
              <td width="85" rowspan="2" align="right" valign="middle"><input type="checkbox" name="sub_id[<?php echo $j; ?>]" id="sub_id[<?php echo $j; ?>]" value="<?php echo $row[0] ?>" /></td>
              <td width="87" align="right"><strong>ชื่อวิชา :</strong></td>
              <td>
              	<?php
              		echo $row[1];
              	?>
              </td>
              </tr>
            <tr>
              <td align="right"><strong>กลุ่มเรียน : </strong></td>
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
                <!--</select>--></td>
              </tr>
            <tr>
              <td colspan="3" align="right"><hr width="90%" /></td>
              </tr>
            <?php
					$i++;
					$j++;
				}
			?>
            <tr>
              <td colspan="2" align="right"></td>
              <td><input type="submit" name="button" id="button" value="ลงทะเบียนเรียน" />
                <input name="cos_id" type="hidden" id="cos_id" value="<?php echo $cos_id ?>" />
                <input name="end" type="hidden" id="end" value="<?php echo $i ?>" /></td>
              </tr>
            </table>
          </form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
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