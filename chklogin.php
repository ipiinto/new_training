<?php
  	session_start();
  	print_r($_POST);
  	$username = $_POST['username'];
  	$pass = $_POST['pass'];
  	$remember = $_POST['remember'];
	include('config/config.php');
		$st_login=0;
        $sql="select * from office where username='$username' and pass='$pass'";
		$result=mysqli_query($dbcon,$sql);
		$nRow=mysqli_num_rows($result);
		if($nRow != 0){
			$st_login=1;
			$row = mysqli_fetch_array($result);
			$_SESSION['login']=$row[1];
			$_SESSION['state']='ผู้ดูแลระบบ';
			echo "<script language=\"javascript\">window.location.href = 'office/index.php'</script>";
		}else{
			$sql="select * from teacher where username='$username' and pass='$pass'";
			$result=mysqli_query($dbcon,$sql);
			$nRow=mysqli_num_rows($result);
			if($nRow != 0){
				$st_login=1;
				$row = mysqli_fetch_array($result);
				$_SESSION['login']=$row[1];
				$_SESSION['name']=$row[3];
				$_SESSION['state']='อาจารย์';

				$_SESSION['id']=$row['teacher_id'];
				echo "<script language=\"javascript\">window.location.href = 'teacher/index.php'</script>";
			}else{
				$sql="select * from member where username='$username' and pass='$pass'";
				$result=mysqli_query($dbcon,$sql);
				$nRow=mysqli_num_rows($result);
				if($nRow != 0){
					$st_login=1;
					$row = mysqli_fetch_array($result);
					$_SESSION['login']=$row[1];
					$_SESSION['name']=$row[3];
					$_SESSION['state']='นักเรียน';
					$_SESSION['id']=$row[0];

					echo "<script language=\"javascript\">window.location.href = 'student/index1.php'</script>";
				}
			}
		}
		if($st_login==0){
				echo "ข้อมูลที่คุณกรอกไม่ถูกต้อง กรุณาเข้าสู่ระบบ ใหม่อีกครั้ง"	;
		}
?>
