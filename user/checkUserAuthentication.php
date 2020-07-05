<?php 
  session_start();
  if(!isset( $_SESSION["user_auth_id"])){
    //   if user is not authenticated send to login page
      header("Location: ../index.php");
  }
?>