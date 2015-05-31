<?php
  session_start();
	print_r($_SESSION);
  function destroy() {
    session_destroy();
  }
?>