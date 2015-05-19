<?
	session_start();
	include('config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	
    //session_destroy();
	if($_SESSION["login"]!=""){
		/*
			handle for if user login 
		*/
		echo "ไม่ว่าง";
	}else{
     	print_r($_POST);
		// echo "<br/>";
		echo "ว่าง1";
		if (isset($_POST["sub_id"])) {
			echo "ว่าง2";
			//Check Subjects_id if sub_id is checked then store var to session
			$_SESSION["cos_id"] = $_POST["cos_id"];
			$_SESSION["end"] = $_POST["end"];
			$_SESSION["sub_id"] = $_POST["sub_id"];
			$_SESSION["sec_id"] = $_POST["sec_id"];
			foreach($_SESSION["sub_id"] as $i => $sub_id) {
				echo "sub_id[$i] = '$sub_id'<br />";
				foreach($_SESSION["sec_id"] as $j => $sec_id) {
					if ($i == $j) {
						echo "sec_id[$j] = '$sec_id'<br />";
					}
    			}
    		}
			echo "<script language=\"javascript\">window.location.href = 'login_regis.php'</script>";
    	}
	}
    //session_destroy();
?>