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
                  <form action="" method="post" onsubmit="return validatePaymentForm()">
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
                                        include "../../api/db.php";
                                        $transaction = new Transactions($conn);  
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
                                 <input type="number" name="paymentAmount" id="paymentAmount" class="mb-2" placeholder="Payment Amount"  min="0" required>                               
                             </div>

                             <!-- comment,Narration,Remarks -->
                             <div class="form-group">
                                 <label class="gray-text">Remark*</label>                                
                                 <textarea name="remark" id="remark" class="mb-2" placeholder="Short explanation of transaction" required></textarea>                               
                             </div>


                             <!--submit button -->
                          <button type="submit" class="btn-block" name="paymentTransaction"><i class="fa fa-save"></i> Save</button>
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
      $(".flatpickr").flatpickr({dateFormat: "d-m-Y",maxDate:"today"});
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


<!-- js  functions-->
<script>
   function validatePaymentForm(){
      let paymentDate = $("#paymentDate").val();
      let debtorId = $("#debtorId").val();
      let paymentAmount = $("#paymentAmount").val();
      let remark = $("#remark").val();
      let datePattern = /^([0-9]{2})-([0-9]{2})-([0-9]{4})$/;
     if(!paymentDate.match(datePattern)){
        toastr.error('Payment Date is Not Valid.',"Oops!");
        return false;
     }else if(debtorId=== "" || debtorId.length === 0){
        toastr.error('Please Select Debtor.',"Oops!");
        return false;
     }else if(paymentAmount=== "" || paymentAmount.length === 0 || paymentAmount<=0){
        toastr.error('Please Enter Valid Amount(More Than 0).',"Oops!");
        return false;
     }else if(remark=== "" || remark.length === 0){
        toastr.error('Please Write Short Explanation of Transaction.',"Oops!");
        return false;
     }else{
        return true;
     }
     
   }
</script>


<?php 
   if(
       isset($_POST["paymentDate"]) &&
       isset($_POST["debtorId"]) &&
       isset($_POST["paymentAmount"]) &&
       isset($_POST["remark"]) &&
       isset($_POST["paymentTransaction"]) 
     ){
         $paymentDate = $_POST["paymentDate"];
         $debtorId = $_POST["debtorId"];
         $paymentAmount = $_POST["paymentAmount"];
         $remark = $_POST["remark"];
         include "../../api/helper/ValidationHelper.php";
        //  check name validation
        if(!ValidationHelper::validateDate($paymentDate)){
                // invalid name 
                ?>
                   <script>
                         toastr.error('Payment Date is Not Valid',"Oops!");
                   </script>
                <?php
        }elseif(empty($debtorId) || empty($paymentAmount) || empty($remark) ){
            //empty debtorid
                ?>
                   <script>
                         toastr.error('Please fill required fields',"Oops!");
                   </script>
                <?php
        }else{
            // insert data
         include "../../api/db.php";
         $transactions  = new Transactions($conn);
         $result = $transactions->paymentTransaction($paymentDate,$debtorId,$paymentAmount,$remark);
         if($result){
            //   insert payment transaction successfully
            ?>
            <script>
                  toastr.success('Payment Transaction Saved!');
            </script>
           <?php
         }else{
            //   error on inserting payment transaction
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