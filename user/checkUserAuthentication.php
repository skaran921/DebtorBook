<?php 
  session_start();
  if(!isset( $_SESSION["user_token"])){
    //   if user is not authenticated send to login page
      header("Location: ../index.php");
  }
?>