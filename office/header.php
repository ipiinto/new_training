<td height="81" background="../images/bg_banner.jpg" >
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="446"><img src="../images/top_logo1.png" width="446" height="75" /></td>
        <td width="286">&nbsp;</td>
        <td width="336">
        	<table border="0" cellpadding="4" cellpadding="0">
        		<?php
        			$sql="select * from office where username='".$_SESSION['login']."'";
					$result=mysqli_query($dbcon,$sql);
					$rows=mysqli_fetch_array($result);	
        		?>
        		<tr>
        			<td rowspan="2">
        				<?php
                            if(!empty($rows['fileupload'])){
                        ?>
                                <img src="../images/profile/<?=$rows['fileupload'];?>" class="profile-image img-rounded"  >
                        <?php
                            }else{
                        ?>
                                <img src="../images/avatar.jpg" class="profile-image img-rounded"  >
                        <?php
                          }
                        ?>
        			</td>
        			<td>
        				<?php
							echo "<font color='#FFFFFF'>ยินดีต้อนรับคุณ </font><font color='#FFFFFF'>$rows[0]&nbsp;(".$_SESSION['state'].")</font>";
        				?>
        			</td>
				</tr>
				<tr>
					<td>
						<?php
							echo "[<a href='change_pwd.php'><font color='#FFFFFF'>เปลี่ยนรหัสผ่าน</font></a>]";
							echo "[<a href='log_off.php'><font color='#FFFFFF'>ออกจากระบบ</font></a>]";
						?>
					</td>
				</tr>
			</table>
        </td>
      </tr>
	</table>
</td>
