<?php
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
</html>
<?php
	include('config/config.php');
    //session_destroy();
	if($_SESSION["login"]!=""){
		/*
			handle for if user login 
		*/
		echo "ไม่ว่าง";
	}else{
     	print_r($_POST);
		echo "ว่าง1 <br>";
		if (isset($_POST["sub_id"])) {
			echo "ว่าง2 <br>";
			//Check Subjects_id if sub_id is checked then store var to session
			$count_subjects = $_POST["count_subjects"];
			$_SESSION["cos_id"] = $_POST["cos_id"];
			$_SESSION["end"] = $_POST["end"];
			$_SESSION["sub_id"] = $_POST["sub_id"];
			$_SESSION["sec_id"] = $_POST["sec_id"];
			for ($i=0; $i < $count_subjects; $i++) { 
				echo "sub_id[$i] = ".$_SESSION["sub_id"][$i]."<br>";
				for ($j=0; $j < count($_SESSION["sec_id"]); $j++) { 
					if ($i == $j) {
						echo "sec_id[$j] = ".$_SESSION["sec_id"][$j]."<br>";
					}
				}
			}
			echo "<script> window.location.href = 'login_regis.php' </script>";
    	}
	}
    //session_destroy();
?>