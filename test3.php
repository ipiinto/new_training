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
            <?
				$i=1;
				$sql="select subject.sub_id , subject.sub_name from subject , course_item ";
				$sql=$sql . " where subject.sub_id=course_item.sub_id and course_item.cos_id=$cos_id order by sub_id ";
				$result=mysql_query($sql);
				while($row=mysql_fetch_array($result)){
				print_r($row);
				echo"<br/>";
			?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
              <td align="right"><strong>กลุ่มเรียน : </strong></td>
              <td>
              	<select name="sec_id[]" id="sec_id[]">
              	<?
					$sql_sec="select sec_id,sec_name,day,since,until from section where sub_id=$row[0] and cos_id=$cos_id ";
					$sql_sec=$sql_sec . "order by sec_id";
					$result_sec=mysql_db_query($database,$sql_sec);
					while($row_sec=mysql_fetch_array($result_sec)){
						$strDay=getDay($row_sec[2]);
						$strSince=getSince($row_sec[3]);
						$strUntil=getUntil($row_sec[4]);
						echo "<option value='$row_sec[0]'>$row_sec[1] - วัน$strDay &nbsp;ตั้งแต่&nbsp;$strSince&nbsp;ถึง&nbsp;$strUntil</option>";
					}
				?>
              </select>
              </td>
            </tr>
                        <?
					$i++;
				}
			?>
</table>
