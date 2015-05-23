<?php 
	session_start();
	include('config/config.php');
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="bootstrap-3.2.0-dist/css/bootstrap.css">
</head>
<body>
	<!-- <div class="container" style="margin-top:10px;">
		<a href="index.php">
			<img src="images/top_logo.png" alt="" >
		</a>
	</div> -->
	<div class="container-fluid">
    	<div class="col-md-3">
            <div class="container" style="margin-top:5px;">
                <a href="index.php">
                    <img src="images/top_logo.png">
                </a>
            </div>
    	</div>
		<div class="col-md-3">
			&nbsp;&nbsp;
		</div>
    	<div class="col-md-6">
    	<?php
			if(isset($_SESSION['id'])==""){
		?>
				<form class="form-inline">
					<div class="form-group" style="marin-top-top:20px">
						<label for="username">ชื่อผู้ใช้</label>
						<input type="text" class="form-control" id="username" placeholder="ชื่อผู้ใช้">
	  				</div>
	 				<div class="form-group" style="marin-top-top:20px">
	    				<label for="password">รหัสผ่าน</label>
	    				<input type="password" class="form-control" id="password" placeholder="รหัสผ่าน">
	  				</div>
	  				<button type="submit" class="btn btn-default">เข้าสู่ระบบ</button>
				</form>
		<?php
			}else{
	            $sql="select * from member where username='".$_SESSION['login']."'";
	            $result=mysqli_query($dbcon,$sql);
	            $rows=mysqli_fetch_array($result);
	            echo "<font color='#FFFFFF'>ยินดีต้อนรับคุณ </font><a href='edit_profile.php'><font color='#FFFFFF'>$rows[3]&nbsp;&nbsp;$rows[4]</a>&nbsp;&nbsp;(".$_SESSION['state'].")</font>";
	            echo "<br>[<a href='change_pwd.php'><font color='#FFFFFF'>เปลี่ยนรหัสผ่าน</font></a>]";
	            echo "[<a href='logout.php'><font color='#FFFFFF'>ออกจากระบบ</font></a>]";  
			}
		?>
    	</div>
	</div>
</body>
</html>