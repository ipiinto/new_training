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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
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
        <td valign="middle"><a href="list_subject.php"><img src="../images/reg_bar.png" width="300" height="27"  alt=""/></a>          <hr size="5" /></td>
      </tr>
      <tr>
        <td><strong>หลักสูตรที่เปิดสอน</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
            <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <?php
                $sql="select * from course where num_sec<cos_max order by cos_name ";
                $result=mysql_db_query($database,$sql);
                while($row=mysql_fetch_array($result)){
            ?>
              <tr>
                <td width="80"><img src="../images/course.png" width="80" height="81" /></td>
                <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
                  <tr>
                    <td width="100" align="right"><strong>ชื่อหลักสูตร :</strong></td>
                    <td><a href='show_subject.php?cos_id=<?php echo $row[0] ?>'><?php echo $row["cos_name"] ?></a></td>
                  </tr>
                  <tr>
                    <td align="right"><strong>จำนวนที่รับ :</strong></td>
                    <td><?php echo $row["num_sec"] ?>/<?php echo $row["cos_max"] ?></td>
                  </tr>
                  <tr>
                    <td align="right"><strong>ราคา :</strong></td>
                    <td><?php echo $row["price"] ?> บาท</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>
            <?php
                        $sql="select approve from learn where cos_id=$row[0] and member_id=".$_SESSION["id"];
                        $result_learn=mysql_db_query($database,$sql);
                        $nRow=mysql_num_rows($result_learn);
                        if($nRow!=0){
                            $row_learn=mysql_fetch_array($result_learn);
                            if($row_learn[0]==0){
                                echo "<font color='red'>รออนุมัติ</a>";
                            }else{
                                echo "<a href='bill_sql.php?member_id=".$_SESSION["id"]."&cos_id=".$row[0]."' target='_blank'>พิมพ์บัตรลงทะเบียน</a>";
                            }
                        }else{
                            echo "<a href='course_regi.php?cos_id=$row[0]'>ลงทะเบียน</a>";
                        }
                    ?>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><?php echo $row["detail"] ?></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="2"><hr /></td>
                </tr>
          <?php
                }
                ?>
            </table>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>



        <!-- <table width="100%" border="0" cellspacing="2" cellpadding="2">
          <?
              $sql="select * from subject order by sub_name ";
              $result=mysql_db_query($database,$sql);
              while($row=mysql_fetch_array($result)){
            ?>
          <tr>
            <td width="80"><img src="../images/subject.jpg" width="80" height="81" /></td>
            <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td width="100" align="right"><strong>ชื่อรานวิชา :</strong></td>
                <td><? echo $row["sub_name"] ?></td>
              </tr>
              <tr>
                <td align="right"><strong>เวลาเรียน :</strong></td>
                <td><? echo $row["time_sub"] ?> ชั่วโมง</td>
              </tr>
              <tr>
                <td align="right"><strong>ราคา :</strong></td>
                <td><? echo $row["price"] ?> บาท</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>
                <?
                  $sql="select approve from learn where sub_id=$row[0] and cos_id=0 and member_id=". $_SESSION["id"];
                  $result_learn=mysql_db_query($database,$sql);
                  $nRow=mysql_num_rows($result_learn);
                  if($nRow!=0){
                    $row_learn=mysql_fetch_array($result_learn);
                    if($row_learn[0]==0){
                      echo "<font color='red'>รออนุมัติ</a>";
                    }else{
                      echo "<a href='#'>เอกสารประกอบการเรียน</a>";
                    }
                  }else{
                    echo "<a href='subject_reg.php?sub_id=$row[0]'>ลงทะเบียน</a>";
                  }
                ?>
                </td>
              </tr>
              <tr>
                <td colspan="2"><? echo $row["detail"] ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="2"><hr /></td>
          </tr>
          <?
              }
              ?>
        </table> -->
      



        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
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