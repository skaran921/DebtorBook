<?php 
  session_start();
  if(!isset( $_SESSION["user_token"])){
    //   if user is not authenticated send to login page
      header("Location: ../index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Debtor Book</title>
    <?php 
     include "../externalCss.php";
     
   ?>
</head>
<body>
    
    <!-- sidebar -->
    <div class="sidebar">
    <a href="#" class="navbar-brand text-center">
                    <img src="http://localhost/DebtorBook/assets/logo/logo.jpg" alt="" class="img-responsive rounded-circle" style="width:60px;height:50px;">
     </a>
       <a href="#home" class="active-link">Home</a>
       <a href="#home">Debtors</a>
       <a href="#home">Reports</a>
       <a href="#home">Day Book</a>
       <a href="#home">Accounts</a>
       <a href="#home">About</a>
    </div>    
    <!-- Page content -->
    <div class="sidebarContent">
            <nav class="navbar Navbar-light " style="background-color:#f1f1f1">
            <a href="#" class="navbar-brand text-center">
               <span class="blue-text">Debtor Book</span>
           </a>
            </nav>
    </div>
<?php 
     include "../externalJs.php";
   ?>
</body>
</html>