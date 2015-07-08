<?php 
  include('../config/config.php');
  $sql = "SELECT teacher_id, name, surname, nickname, email, telephone, address, (SELECT COUNT(*) FROM teacher) AS total FROM teacher ORDER BY teacher_id";
  $result = mysqli_query($dbcon, $sql);
  $json_data = "";
  if (mysqli_num_rows($result)) {
    while ($rs = mysqli_fetch_array($result, MYSQL_ASSOC)) {
      // $teacher_id[] = $rs['teacher_id'];
      // $name[] = $rs['name'];
      // $surname[] = $rs['surname'];
      // $nickname[] = $rs['nickname'];
      // $email[] = $rs['email'];
      // $telephone[] = $rs['telephone'];
      // $address[] = $rs['address'];
      if ($json_data != "") {$json_data .= ",";}
      $json_data .= '{"teacher_id":"' . $rs["teacher_id"] . '",';
      $json_data .= '"name":"' . $rs["name"] .' '. $rs["surname"] . '",';
      $json_data .= '"nickname":"' . $rs["nickname"] . '",';
      $json_data .= '"email":"' . $rs["email"] . '",';
      $json_data .= '"telephone":"' . $rs["telephone"] . '",';
      $json_data .= '"address":"' . $rs["address"] . '"}';
    }
    $json_data ='['.$json_data.']';
  }
  echo $json_data;
  // echo json_encode($json_data, JSON_UNESCAPED_UNICODE);
  mysqli_free_result($result);
  mysqli_close($dbcon);
?>