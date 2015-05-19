<?
	session_start();
	
	include('config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	
	$page=$_GET["page"];
	if (empty($page)){
		$page=1;
	}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="50%" align="right" valign="top"><table width="50%" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="3"><img src="images/images/course_01.png" width="512" height="55"  alt=""/></td>
      </tr>
      <tr>
        <td background="images/images/course_02.png">&nbsp;</td>
        <td width="404"><table width="100%" border="0" cellspacing="1" cellpadding="0">
          <?
					$sql="select cos_id,count(cos_id) as RegMax from learn where cos_id <>0 group by cos_id order by RegMax";
					$result=mysql_db_query($database,$sql);
					while($row=mysql_fetch_array($result)){			
						$sql="select * from course where cos_id=$row[0]";
						$result1=mysql_db_query($database,$sql);
						$rows=mysql_fetch_array($result1);
						$discount=$rows[4]-$rows[5];
				?>
		  <tr>
            <td colspan="2">&nbsp;</td>
            <p>
            <td width="1"></p>
          </tr>
          <tr>
            <td width="100" align="right"><strong>ชื่อหลักสูตร :</strong></td>
            <td><a href='show_subject.php?cos_id=<? echo $rows[0] ?>'><? echo $rows["cos_name"] ?></a></td>
          </tr>
          <tr>
            <td align="right"><strong>จำนวนที่รับ :</strong></td>
            <td><? echo $rows["num_sec"] ?>/<? echo $rows["cos_max"] ?></td>
          </tr>
          <tr>
            <td align="right"><strong>ราคา :</strong></td>
            <td><? echo $rows["price"] ?> บาท</td>
          </tr>
          <tr>
            <td colspan="2"><? echo $rows["detail"] ?></td>
          </tr>
          <tr>
            <td align="right"><strong>ลดเหลือ :</strong></td>
            <td><font color="#FF0000" ><? echo $discount ?></font> บาท</td>
          </tr>
          <?
					}
				?>
        </table></td>
        <td background="images/images/course_04.png">&nbsp;</td>
      </tr>
      <tr>
        <td width="42"><img src="images/images/course_05.png" width="54" height="54"  alt=""/></td>
        <td background="images/images/course_06.png" align="right"><a href="list_course.php">อ่านต่อทั้งหมด..</a></td>
        <td width="42"><img src="images/images/course_07.png" width="54" height="54"  alt=""/></td>
      </tr>
    </table></td>
    <td width="50%" align="left" valign="top"><table width="257" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="3"><img src="images/images/subject_01.png" width="512" height="55"  alt=""/></td>
      </tr>
      <tr>
        <td background="images/images/subject_02.png">&nbsp;</td>
        <td width="404"><table width="100%" border="0" cellspacing="1" cellpadding="0">
          <?
						$sql="select sub_id,count(sub_id) as SubMax from learn where cos_id=0 group by sub_id order by SubMax";
						$result=mysql_db_query($database,$sql);
						while($roww=mysql_fetch_array($result)){
			
						$sql="select * from subject where sub_id=$roww[0]";
						$result1=mysql_db_query($database,$sql);
						$rowws=mysql_fetch_array($result1);
					?>
          <tr>
            <td  colspan="2">&nbsp;</td>
            <p>
            <td width="1"></p>
          </tr>
          <tr>
            <td width="78" align="right"><strong>ชื่อรายวิชา :</strong></td>
            <p>
            <td width="90"><a href='show_subject.php?cos_id=<? echo $rows[0] ?>'><? echo $rowws["sub_name"] ?></a></td>
            </tr>
          <tr>
            <td align="right"><strong>ราคา :</strong></td>
            <td><? echo $rowws["price"] ?> บาท</td>
          </tr>
          <tr>
            <td colspan="2"><? echo $rowws["detail"] ?></td>
          </tr>
          <?
						}
					?>
        </table></td>
        <td background="images/images/subject_04.png">&nbsp;</td>
      </tr>
      <tr>
        <td width="42"><img src="images/images/subject_05.png" width="54" height="54"  alt=""/></td>
        <td background="images/images/subject_06.png" align="right"><a href="list_course.php">อ่านต่อทั้งหมด..</a></td>
        <td width="42"><img src="images/images/subject_07.png" width="54" height="54"  alt=""/></td>
      </tr>
    </table></td>
  </tr>
</table>
