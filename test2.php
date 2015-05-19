<?
	session_start();
	include("config/config.php");
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="center" valign="top"><table width="257" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="3"><img src="images/cos_f_01.jpg" width="257" height="57"  alt=""/></td>
        </tr>
      <tr>
        <td  background="images/cos_f_02.jpg">&nbsp;</td>
        <td width="173">
			<table width="100%" border="0" cellspacing="1" cellpadding="0">
				<?
					$sql="select cos_id,count(cos_id) as RegMax from learn where cos_id <>0 group by cos_id order by RegMax";
					$result=mysql_db_query($database,$sql);
					while($row=mysql_fetch_array($result)){			
						$sql="select * from course where cos_id=$row[0]";
						$result1=mysql_db_query($database,$sql);
						$rows=mysql_fetch_array($result1);
						echo $sql;
				?>
                <tr>
					<td width="100" align="right"><strong>ชื่อหลักสูตร :</strong></td>
					<p><td><a href='show_subject.php?cos_id=<? echo $rows[0] ?>'><? echo $rows["cos_name"] ?></a></td></p>
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
                <?
					}
				?>
			</table>
        </td>
        <td background="images/cos_f_04.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td width="42"><img src="images/cos_f_05.jpg" width="42" height="42"  alt=""/></td>
        <td background="images/cos_f_06.jpg">&nbsp;</td>
        <td width="42"><img src="images/cos_f_07.jpg" width="42" height="42"  alt=""/></td>
      </tr>
    </table></td>
    <td width="50%" align="center" valign="top"><table width="257" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="3"><img src="images/sub_f_01.jpg" width="257" height="57"  alt=""/></td>
      </tr>
      <tr>
        <td background="images/sub_f_02.jpg">&nbsp;</td>
        <td width="173"><p>&nbsp;</p></td>
        <td background="images/sub_f_04.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td width="42"><img src="images/sub_f_05.jpg" width="42" height="42"  alt=""/></td>
        <td background="images/sub_f_06.jpg">&nbsp;</td>
        <td width="42"><img src="images/sub_f_07.jpg" width="42" height="42"  alt=""/></td>
      </tr>
    </table>
    
    </td>
  </tr>
</table>
