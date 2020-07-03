<?php 
 include "./checkUserAuthentication.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debtors - Debtor Book</title>
    <?php 
     include "../externalCss.php";     
    ?>
</head>
<body>
        <!-- sidebar -->
        <?php include("./sideBar.php"); ?>  
    <!-- Page content -->
    <div class="sidebarContent">
          <!-- navbar -->
             <?php include("./navBar.php"); ?>  
          <!-- navbar end-->
            
            <!-- main content-->
            <div class="main p-5">
                  <h1 class="gray-text">Debtor's</h1>
                  <hr/>

                  <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th>Sr. No.</th>
                              <th>Name</th>
                              <th>Mobile</th>
                              <th>Email</th>
                              <th>Address</th>
                              <th>Create On</th>
                              <th>Update On</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                      </tbody>
                  </table>
                  </div>
            </div> <!---main -------->
    </div><!-- Page content end-->
<?php 
     include "../externalJs.php";
?>
</body>
</html>