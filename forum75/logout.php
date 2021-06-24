<?php
//session_start();
if (isset($_SESSION["user"])) {
  $login=$_SESSION["user"];
if (isset($_SESSION["admin"])) {
  $admin=$_SESSION["user"];
}
  $_SESSION=array();
  session_destroy();
  header('Location:index.php');
}
?>
