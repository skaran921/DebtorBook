<?php 
 include "../checkUserAuthentication.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Debtor Book</title>
    <?php 
     include "../../externalCss.php";
     include "../../api/db.php";
     include "../../api/User.php";
     $userId = $_SESSION["user_auth_id"];
     $user = new User($conn);
     $userNameArr =$user->getUserNameArray($userId);
     include "../../api/Transactions.php";
     $transaction = new Transactions($conn);     
    ?>
     <!-- date picker -->
     <link rel="stylesheet" href="../../css/flatpickr.min.css" />

     <!-- select box -->
     <link rel="stylesheet" href="../../css/bootstrap-select.min.css" />
     
      <!-- toast -->
    <link rel="stylesheet" href="../../css/toastr.min.css">

    <style>
      .bootstrap-select .dropdown-toggle:focus,
      .bootstrap-select>select.mobile-device:focus+.dropdown-toggle{
         transition: 0.3s ease-in !important;
         outline: none !important;
         box-shadow: 0 0px 2px #0f23ca !important;
         outline-offset: 0px !important;
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
                  <h1 class="gray-text"> <i class="fa fa-money"></i> Payment</h1>
                  <hr/>
                  <form action="" method="post">
                     <div class="row">
                         <div class="col-md-12 col-lg-6 col-sm-12">
                             <!-- payment date -->
                             <div class="form-group">
                                 <label class="gray-text">Select Date*</label>
                                <input class="flatpickr flatpickr-input mb-2" id="paymentDate" name="paymentDate" type="text" placeholder="Select Payment Date" data-id="datetime" readonly="readonly" autofocus required>       
                             </div>

                             <!-- payment to(Debtor name) -->
                             <div class="form-group">
                                 <label class="gray-text">Select Debtor*</label>                                
                                <select id="debtorId" name="debtorId" class="show-tick debtorPicker mb-2 form-control"  required data-live-search="true">
                                 <option value="">Select Debtor</option>                                   
                                   <?php 
                                       foreach($transaction->getActiveDebtorsForSelectBox() as $transaction){
                                          ?>
                                           <option value="<?php echo $transaction['DEBTOR_ID'];?>" data-icon="fa fa-user-circle gray-text"><?php echo $transaction['DEBTOR_NAME'];?></option>
                                          <?php
                                       }
                                    ?>
                                </select>                                
                             </div>

                             <!-- payment amount -->
                             <div class="form-group">
                                 <label class="gray-text">Amount in INR*</label>                                
                                 <input type="number" name="amount" id="amount" class="mb-2" placeholder="Payment Amount"  min="0" required>                               
                             </div>

                             <!-- comment,Narration,Remarks -->
                             <div class="form-group">
                                 <label class="gray-text">Remarks*</label>                                
                                 <textarea name="remark" id="remark" class="mb-2" placeholder="Short explanation of transaction" required></textarea>                               
                             </div>


                             <!--submit button -->
                          <button type="submit" class="btn-block" name="addDebtor"><i class="fa fa-save"></i> Save</button>
                         </div>
                     </div>
                  </form>
            </div> <!---main -------->
    </div><!-- Page content end-->
<?php 
     include "../../externalJs.php";
?>

<!-- datepicker flatpickr.min.js-->
  <script src="../../js/flatpickr.min.js"></script>
  <script>
      $(".flatpickr").flatpickr({dateFormat: "d-m-Y"});
  </script>
<!-- datepicker flatpickr.min.css-->

 <!-- select box bootstrap-select.min.js-->
 <script src="../../js/bootstrap-select.min.js"></script>
  <script>
   $('.debtorPicker').selectpicker();
  </script>
 <!-- select box bootstrap-select.min.js-->
     

<!-- toast -->
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
<!-- toast -->

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