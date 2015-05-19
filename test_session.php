<?php
	session_start();
	include('config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	//print_r($_POST);
	print_r($_SESSION);
	echo "<br/>";
	foreach($_SESSION[sub_id] as $i => $sub_id) {
		echo "sub_id[$i]='$sub_id'<br />";
		foreach($_SESSION[sec_id] as $j => $sec_id) {
			if ($i == $j) {
				echo "sec_id[$j]='$sec_id'<br />";
			}
    	}
 	}
?>