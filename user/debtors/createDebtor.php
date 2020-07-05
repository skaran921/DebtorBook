<?php 
 include "../checkUserAuthentication.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Debtor - Debtor Book</title>
    <?php 
     include "../../externalCss.php";
     include "../../api/db.php";
     include "../../api/User.php";
     $userId = $_SESSION["user_auth_id"];
     $user = new User($conn);
     $userNameArr =$user->getUserNameArray($userId);
    ?>
      <!-- toast -->
    <link rel="stylesheet" href="../../css/toastr.min.css">
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
                  <h1 class="gray-text"> <i class="fa fa-plus-square"></i> Create Debtor</h1>
                  <hr/>
                  <form action="" method="post">
                     <div class="row">
                         <div class="col-md-12 col-lg-6 col-sm-12">
                            <input type="text" name="debtorName" id="debtorName" class="mb-2 capitallize" placeholder="Debtor Full Name" required min="1" autofocus>
                            <input type="tel" name="debtorMobileNo" id="debtorMobileNo" class="mb-2" pattern="[6789][0-9]{9}" placeholder="Debtor 10 Digit Mobile No." min="10" max="10" required>
                            <input type="email" name="debtorEmail" id="debtorEmail" class="mb-2" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Debtor Email">
                            <textarea name="debtorAddress" id="debtorAddress" class="mb-2" placeholder="Debtor Address"></textarea>
                            <button type="submit" class="btn-block" name="addDebtor">Create New Debtor</button>
                         </div>
                     </div>
                  </form>
            </div> <!---main -------->
    </div><!-- Page content end-->
<?php 
     include "../../externalJs.php";
?>
<script src="../../js/toastr.min.js"></script>
<script>
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>

<?php 
   if(
       isset($_POST["debtorName"]) &&
       isset($_POST["debtorMobileNo"]) &&
       isset($_POST["addDebtor"]) 
     ){
         $debtorName = $_POST["debtorName"];
         $debtorMobileNo = $_POST["debtorMobileNo"];
         $debtorEmail = $_POST["debtorEmail"];
         $debtorAddress = $_POST["debtorAddress"];
         include "../../api/helper/ValidationHelper.php";
        //  check name validation
        if(!ValidationHelper::validateName($debtorName)){
                // invalid name 
                ?>
                   <script>
                         toastr.error('Name is not valid',"Oops!");
                   </script>
                <?php
        }elseif(!ValidationHelper::validateMobile($debtorMobileNo)){
            //invalid mobile
                ?>
                   <script>
                         toastr.error('Mobile no. is not valid',"Oops!");
                   </script>
                <?php
        }else{
            // insert data
         include "../../api/Debtors.php";
         include "../../api/db.php";
         $debtor  = new Debtors($conn);
         $result = $debtor->insertDebtor($debtorName,$debtorMobileNo,$debtorEmail,$debtorAddress);
         if($result === -1){
             //   debtor already exist
            ?>
            <script>
                  toastr.error('Debtor A/c already exist',"Oops!");
            </script>
         <?php
         }elseif($result){
            //   insert data successfully
            ?>
            <script>
                  toastr.success('New Debtor Created');
            </script>
           <?php
         }else{
            //   error on inserting data
            ?>
            <script>
                  toastr.error('Something went wrong',"Oops!");
            </script>
         <?php
         }
        }

        ?>
        <script>
          //clear history state
          history.pushState({}, "", "")
        </script>
        <?php 
     }
?>
</body>
</html>