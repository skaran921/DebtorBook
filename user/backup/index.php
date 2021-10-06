<?php
include "../checkUserAuthentication.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Backup - Debtor Book</title>
   <?php
   include "../../externalCss.php";
   include "../../api/db.php";
   include "../../api/User.php";
   include "../../api/Dashboard.php";
   $userId = $_SESSION["user_auth_id"];
   $user = new User($conn);
   $userNameArr = $user->getUserNameArray($userId);
   ?>
   <style>
      thead,
      th {
         position: sticky !important;
         background: #0f23ca;
         top: -5px !important;
         z-index: 9999 !important;
      }
   </style>
</head>

<body>
   <!-- sidebar -->
   <?php include("../sideBar.php"); ?>
   <!-- Page content -->
   <div class="sidebarContent">
      <!-- navbar -->
      <?php include("../navBar.php"); ?>
      <!-- navbar end-->

      <!-- main content-->
      <div class="main p-5">
         <h1 class="gray-text"> <i class="fa fa-cloud-upload"></i> Backup</h1>
         <hr />

         <p> Click on below <b>"Take Backup"</b> button to take backup.</p>
         <form action="" method="post">
            <button type="button" name="backup" class="btn blue text-white" onclick="takeBackup()">
               Take Backup
            </button>
         </form>
         <!--main--->
      </div>

      <!-- Page content end-->
      <script>
         function takeBackup() {
            window.open("http://localhost/debtorbook/api/backup/index.php", "blank");
         }
      </script>
      <?php
      include "../../externalJs.php";
      ?>
      <script>
         // clock script
         const clock = () => {
            let date = new Date();
            $("#clock").html(`${date.toLocaleTimeString()}`)
         }
         setInterval(clock, 1000);
      </script>
</body>

</html>