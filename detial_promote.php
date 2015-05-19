<table width="100%">
        <tr>
        	<td width="50%" align="left" valign="top" background="images/cos_f.png">
			<?
				$sql="select cos_id,count(cos_id) as RegMax from learn where cos_id <>0 group by cos_id order by RegMax";
				$result=mysql_db_query($database,$sql);
				while($row=mysql_fetch_array($result)){
			
					$sql="select * from course where cos_id=$row[0]";
					$result1=mysql_db_query($database,$sql);
					$rows=mysql_fetch_array($result1);
			?>
			<table width="100%" border="0" cellspacing="2" cellpadding="2">
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
			</table>
            <br />
			<?
				}
			?> 
		</td>
        <td width="50%" align="right" valign="top" background="images/sub_f.png">
        
        
        <br />
            <br /><br />
			<?
				$sql="select sub_id,count(sub_id) as SubMax from learn where cos_id=0 group by sub_id order by SubMax";
				$result=mysql_db_query($database,$sql);
				while($roww=mysql_fetch_array($result)){
			
					$sql="select * from subject where sub_id=$roww[0]";
					$result1=mysql_db_query($database,$sql);
					$rowws=mysql_fetch_array($result1);
			?>
			<table width="100%" border="0" cellspacing="2" cellpadding="2">
				<tr>
					<td width="100" align="right"><strong>ชื่อรายวิชา :</strong></td>
					<p><td><a href='show_subject.php?cos_id=<? echo $rows[0] ?>'><? echo $rowws["sub_name"] ?></a></td></p>
				</tr>
				<tr>
					<td align="right"><strong>ราคา :</strong></td>
					<td><? echo $rowws["price"] ?> บาท</td>
				</tr>
				<tr>
					<td colspan="2"><? echo $rowws["detail"] ?></td>
                    </tr>
			</table>
            <br />
			<?
				}
			?> 
        
        </td>
        </tr>
        </table>