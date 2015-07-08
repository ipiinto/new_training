<?php
  if (!isset($_POST['teacher_id'])) { exit; }
  $teacher_id = $_POST['teacher_id'];
  require("../config/config.php");
  $sql = "DELETE FROM teacher WHERE teacher_id = $teacher_id";
  $run = mysqli_query($dbcon, $sql);
  if (mysqli_error($dbcon)) {       /* If mysql error then show error. */
    printf("Errormessage: %s\n", mysqli_error($dbcon));
  } 
  mysqli_close($dbcon);
?>