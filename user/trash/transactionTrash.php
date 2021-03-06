<?php 
 include "../checkUserAuthentication.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day Book - Debtor Book</title>
    <?php 
     include "../../externalCss.php";
     include "../../datatableCss.php";
     include "../../api/db.php";
     include "../../api/User.php";
     $userId = $_SESSION["user_auth_id"];
     $user = new User($conn);
     $userNameArr =$user->getUserNameArray($userId);
     include "../../api/Transactions.php";
    ?>
      <!-- toast -->
      <link rel="stylesheet" href="../../css/toastr.min.css">
      <style>
          tfoot{
              background-color:#fff;
              box-shadow: 0px 1px 4px #d0d0d0;
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
            <div class="main p-2">
                  <h1 class="gray-text"> <i class="fa fa-book"></i> Day Book</h1>
                  <div>
                      <small class="gray-text">
                            <i class="fa fa-calendar"> <?php echo date("d-m-Y"); ?></i> 
                      </small>
                  </div>
                  <hr/>
                  <div class="text-center p-4" id="pageLoading">
                        <div class="spinner-border blue-text fade-in" role="status" style="display:block;">
                        <span class="sr-only">Loading...</span>
                        </div>
                 </div>
                  <div class="table-responsive">
                  <table class="table stripe display nowrap" id="debtorsTable">
                      <thead class="blue text-white">
                          <tr>
                              <th>Sr. No.</th>
                              <th>Date</th>
                              <th>Debtor Name</th>
                              <th>Remark</th>
                              <th><i class="fa fa-rupee-sign"></i> Pay</th>
                              <th><i class="fa fa-rupee-sign"></i> Received</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php    
                             include "../../api/db.php";
                            $transaction = new Transactions($conn);                          
                            $transactions = $transaction->getAllInActiveTransactions();
                            $srNo =1;
                            $totalPay = 0.0;
                            $totalReceived = 0.0;
                            foreach($transactions as $transaction){                                
                                $encryted_transaction_id = base64_encode($transaction['TRANSACTION_ID']);
                                $transaction_create_at= date("d-M-Y h:i:s A",strtotime($transaction['TRANSACTION_CREATE_DATE']));
                                $transaction_update_at = date("d-M-Y h:i:s A",strtotime($transaction['TRANSACTION_UPDATE_DATE']));
                                $totalPay+= $transaction['PAY_AMOUNT'];
                                $totalReceived+= $transaction['RECEIVED_AMOUNT'];
                                ?>
                              <tr class="p-4">
                                <td><?php echo $srNo; ?></th>
                                <td><?php echo $transaction['TRANSACTION_DATE'];?></td>
                                <td><?php echo $transaction['DEBTOR_NAME'];?></td>
                                <td><?php echo $transaction['TRANSACTION_REMARK'];?></td>
                                <td><?php echo $transaction['PAY_AMOUNT'] == 0.00 ? "<div class='ml-4'>-</div>" : $transaction['PAY_AMOUNT'];?></td>
                                <td><?php echo $transaction['RECEIVED_AMOUNT'] == 0.00 ? "<div class='ml-4'>-</div>":$transaction['RECEIVED_AMOUNT'];?></td>
                                <td> 
                                   <form action="" method="post">
                                      <input type="hidden" name="activeTransactionId" value="<?php echo base64_encode($transaction['TRANSACTION_ID']);?>">
                                      <input type="hidden" name="activeTransactionDebtorId" value="<?php echo base64_encode($transaction['DEBTOR_ID']);?>">
                                      <button type="submit" name="restoreTransaction" class="btn rounded-circle btn-success"> 
                                          <i class="fa fa-refresh"></i>
                                      </button>   

                                    <a href="javascript:void(0)" class="btn rounded-circle btn-danger" onclick="openTransactionDeleteModal(<?php echo $transaction['TRANSACTION_ID'];?>)">
                                        <i class="fa fa-trash"></i>
                                    </a>                                   
                                   </form>                                
                                </td>
                              </tr>
                                <?php
                                $srNo++;
                            }
                          ?>                           
                      </tbody>
                       <tfoot>
                       <tr class="p-4">
                              <?php $diff = $totalReceived-$totalPay; ?>
                              <th></th> 
                              <th colspan="3">Total</th>
                              <th><?php echo  '-'.number_format((float)$totalPay, 2, '.', ''); ?></th>
                              <th><?php echo '+'.number_format((float)$totalReceived, 2, '.', ''); ?></th>
                              <th class="<?php echo ($diff) < 0 ? "text-danger":"" ?>">
                                  <?php echo number_format((float)$diff, 2, '.', '');?>
                              </th>
                          </tr>
                       </tfoot>
                  </table>
                  </div>
            </div> <!---main -------->
    </div><!-- Page content end-->

 <!--transaction delete Modal -->
 <div class="modal fade" id="transactionDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title gray-text" id="exampleModalLabel ">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="text-center"> <span class="fa fa-warning text-danger" style="font-size:6rem"></span></div>
            <div class="p-4 gray-text">Do you really want to delete this transaction? </div>
            <div class="text-center">
                <div class="spinner-border blue-text fade-in" id="deleteTransactionLoading" role="status" style="display:none;">
                  <span class="sr-only">Loading...</span>
                </div>
            </div>
      </div>  
      <div class="modal-footer">
           <button type="button" class="btn light-white gray-text" data-dismiss="modal" aria-label="Close">Cancel</button>
           <form action="" method="post">
              <input type="hidden" id="deleteTransactionId" name="deleteTransactionId" value="">
              <button type="submit" name="deleteTransaction"><i class="fa fa-trash"></i> Delete</button>
           </form>
      </div>     
    </div>
  </div>
</div>
<?php 
     include "../../externalJs.php";
     include "../../datatableJs.php";
?>

<!-- toaster -->
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


<script>
    // openDebtorDeleteModal
   function openTransactionDeleteModal(transactionId){
           $("#deleteTransactionId").val(transactionId);
           $('#transactionDeleteModal').modal({
                backdrop: 'static',
                keyboard: false
           })
   }

//    stop page loading
$("#pageLoading").hide();
</script>

<?php 
  // delete transaction
  if(isset($_POST["deleteTransaction"])){
    //   show loader
     ?>
     <script>
          $("#deleteTransactionLoading").show();
          $("deleteTransaction").prop("disabled",true);
     </script>
     <?php 
     $transactionId = $_POST["deleteTransactionId"];
     include "../../api/db.php";
     $transaction = new Transactions($conn);
     if($transaction->deleteTransaction($transactionId)){
          // success 
          ?>
          <script>
                toastr.success("Transaction Deleted!");
                setTimeout(() => {
                  window.location.reload();
                }, 0);
          </script>
       <?php
     }else{
             // error 
             ?>
             <script>
                   toastr.error('Someting went wrong',"Oops!");
             </script>
          <?php
     }

     ?>
     <script>
       //clear history state
       $("#deleteTransactionLoading").hide();
       history.pushState({}, "", "")
     </script>
     <?php 
  }


  
  // Activate Transaction
  if(isset($_POST["restoreTransaction"]) && isset($_POST["activeTransactionId"])  && isset($_POST["activeTransactionDebtorId"])  ){
    $transactionId = base64_decode($_POST["activeTransactionId"]);
    $debtorId = base64_decode($_POST["activeTransactionDebtorId"]);
    include "../../api/db.php";
     $transaction = new Transactions($conn);
     $result = $transaction->activateTransaction($transactionId,$debtorId);
     if($result === -1){
            // success 
            ?>
            <script>
                 toastr.error('Please Activate Debtor A/c First',"Oops!");                 
            </script>
        <?php
      }elseif($result){
          // success 
          ?>
          <script>
                toastr.success("Transaction Restore Successfully!");
                setTimeout(() => {
                  window.location.reload();
                }, 0);
          </script>
       <?php
     }else{
             // error 
          ?>
             <script>
                   toastr.error('Someting went wrong',"Oops!");
             </script>
          <?php
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