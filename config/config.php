<?php    
    // These variables define the connection information for your MySQL database 
	$host = "localhost";
    $db_name = "new_training";
    $db_username = "root";
    $db_password = "tua878faeff";
    $dbcon = @mysqli_connect($host, $db_username, $db_password);
    $list_page = 25;
    $ribon="ระบบจัดการสถาบันกวดวิชา | Academic Management System";
    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: ".mysqli_connect_error();
    }
    @mysqli_set_charset($dbcon, "utf8");
    @mysqli_select_db($dbcon, $db_name);
?> 