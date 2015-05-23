<?php
	session_start();
	include('config/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon; ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="bootstrap-3.2.0-dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
      <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <?php include "header.php";?>
          </tr>
        </table>      
        <a href="index.php"></a>
      </td>
    </tr>
    <tr>
      <td height="46" valign="middle" background="images/bg_menu.png"><?php include('menu.php') ?></td>
    </tr>
    <tr>
      <td height="400" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td valign="bottom"><a href="student/list_subject.php"><img src="images/reg_bar.png" width="300" height="27"  alt=""/></a>          <hr size="5" /></td>
        </tr>
        <tr>
          <td><strong>หลักสูตรที่เปิดสอน</strong></td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="2" cellpadding="2">
              <?php
                session_destroy();
                $sql="select * from course where num_sec<cos_max order by cos_name ";
                $result=mysqli_query($dbcon, $sql);
                while($row=mysqli_fetch_array($result)){
                  $disc=$row[4]-$row[5];
  		        ?>
              <tr>
                <td width="80"><img src="images/course.png" width="80" height="81" /></td>
                <td>
                  <table width="100%" border="0" cellspacing="2" cellpadding="2">
                    <tr>
                      <td>
                      	<table cellpadding="0" cellspacing="0">
                          <tr>
                            <td><strong>ชื่อหลักสูตร :</strong></td>
                            <td><a href='student/show_subject.php?cos_id=<? echo $row[0] ?>'><?php echo $row["cos_name"] ?></a></td>
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
                            <td align="right"><strong>เวลาหลักสูตร :</strong></td>
                            <td><?=$row[7]; ?>&nbsp;ถึง<?=$row[8];?></td>
                          </tr>
                      	</table>
                      </td>
                      <td width="668">
                        <table cellpadding="0" cellpadding="0" class="table table-bordered table-hover">
                          <?php
                            $sqli="select subject.sub_id , subject.sub_name from subject , course_item ";
                            $sqli=$sqli . " where subject.sub_id=course_item.sub_id and course_item.cos_id=".$row[0]." order by sub_id ";
                            $results=mysqli_query($dbcon, $sqli);
                            while($rows=mysqli_fetch_array($results)){
                          ?>
                          <thead>
                            <tr>
                              <th width="89" align="right" bgcolor="#eee">ชื่อวิชา :</th>
                              <th><?php echo $rows[1]; ?></th>
                            </tr>
                          </thead>
                          <?php
                            }
                          ?>
                        </table>
                      </td>
                    </tr>
                    
                    
                    
                <!-- <tr>
                  <td align="right"><strong>ลดเหลือ :</strong></td>
                  <td><font color="#FF0000"><?php echo $disc ?></font> บาท</td>
                </tr> -->
                    <tr>
                      <td>&nbsp;</td>
                      <td>
                      <?php
							echo $row["detail"]; 
    				   ?>
                      </td>
                    </tr>
                    
                    <tr>
                      <td colspan="2">
					  	<?php  
							if($_SESSION["login"]!=""){
    						          $sql="select approve from learn where cos_id=$row[0]";
    						          $result_learn=mysqli_query($dbcon,$sql);
    						          $nRow=mysqli_num_rows($result_learn);
    						          if($nRow!=0){
                            $row_learn=mysqli_fetch_array($result_learn);
                            if($row_learn[0]==0){
    								          echo "<font color='red'>รออนุมัติ</a>";
                            }else{
    								          echo "<a href='#'>เอกสารประกอบการเรียน</a>";
                            }
    						          }else{
                            echo "<a href='course_reg.php.php?cos_id=$row[0]'>ลงทะเบียน</a>";
    						          }
                        }else{
                        // echo '<button onclick="course_reg.php?cos_id=$row[0] class="btn btn-primary" >ลงทะเบียน</button>';
              						echo "<a href='course_reg.php?cos_id=$row[0]' class='btn btn-primary' >รายละเอียดเพิ่มเติม</a>";
                        }
						?>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="2"><hr size="5" color="#000000" /></td>
              </tr>
              <?php
  			         }
              ?>
            </table>
          </td>
        </tr>
        <tr>
          <td></td>
        </tr>
      </td>
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

	mysqli_close($dbcon);
?>