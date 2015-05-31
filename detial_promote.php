<table width="100%">
        <tr>
        	<td width="50%" align="left" valign="top" background="images/cos_f.png">
			<?php
				$sql="select cos_id,count(cos_id) as RegMax from learn where cos_id <>0 group by cos_id order by RegMax";
				$result=mysqli_query($dbcon,$sql);
				while($row=mysqli_fetch_array($result)){
			
					$sql="select * from course where cos_id=$row[0]";
					$result1=mysqli_query($dbcon,$sql);
					$rows=mysqli_fetch_array($result1);
			?>
			<table width="100%" border="0" cellspacing="2" cellpadding="2">
				<tr>
					<td width="100" align="right"><strong>ชื่อหลักสูตร :</strong></td>
					<p><td><a href='show_subject.php?cos_id=<?php echo $rows[0] ?>'><?php echo $rows["cos_name"] ?></a></td></p>
				</tr>
				<tr>
					<td align="right"><strong>จำนวนที่รับ :</strong></td>
					<td><?php echo $rows["num_sec"] ?>/<?php echo $rows["cos_max"] ?></td>
				</tr>
				<tr>
					<td align="right"><strong>ราคา :</strong></td>
					<td><?php echo $rows["price"] ?> บาท</td>
				</tr>
				<tr>
					<td colspan="2"><?php echo $rows["detail"] ?></td>
                    </tr>
			</table>
            <br />
			<?php
				}
			?> 
		</td>
        <td width="50%" align="right" valign="top" background="images/sub_f.png">
        
        
        <br />
            <br /><br />
			<?php
				$sql="select sub_id,count(sub_id) as SubMax from learn where cos_id=0 group by sub_id order by SubMax";
				$result=mysqli_query($dbcon,$sql);
				while($roww=mysqli_fetch_array($result)){
			
					$sql="select * from subject where sub_id=$roww[0]";
					$result1=mysqli_query($dbcon,$sql);
					$rowws=mysqli_fetch_array($result1);
			?>
			<table width="100%" border="0" cellspacing="2" cellpadding="2">
				<tr>
					<td width="100" align="right"><strong>ชื่อรายวิชา :</strong></td>
					<p><td><a href='show_subject.php?cos_id=<?php echo $rows[0] ?>'><?php echo $rowws["sub_name"] ?></a></td></p>
				</tr>
				<tr>
					<td align="right"><strong>ราคา :</strong></td>
					<td><?php echo $rowws["price"] ?> บาท</td>
				</tr>
				<tr>
					<td colspan="2"><?php echo $rowws["detail"] ?></td>
                    </tr>
			</table>
            <br />
			<?php
				}
			?> 
        
        </td>
        </tr>
        </table>