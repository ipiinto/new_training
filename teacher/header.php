<td height="81" background="../images/bg_banner.jpg" >
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="446"><a href="index.php"><img src="../images/top_logo1.png" width="446" height="75" /></a></td>
        <td width="286">&nbsp;</td>
        <td width="336">
        <?php
				$sql="select * from teacher where username='".$_SESSION['login']."'";
				$result=mysqli_query($dbcon,$sql);
				$rows=mysqli_fetch_array($result);
				echo "<font color='#FFFFFF'>ยินดีต้อนรับคุณ </font><a href='edit_profile.php'><font color='#FFFFFF'>$rows[3]&nbsp;&nbsp;$rows[4]</a>&nbsp;(".$_SESSION['state'].")</font>";
				echo "<br>[<a href='change_pwd.php'><font color='#FFFFFF'>เปลี่ยนรหัสผ่าน</font></a>]";
				echo "[<a href='logout.php'><font color='#FFFFFF'>ออกจากระบบ</font></a>]";
		?>
        </td>
      </tr>
	</table>
</td>
