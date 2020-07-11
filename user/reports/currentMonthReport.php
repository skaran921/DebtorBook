<?php 
 include "../checkUserAuthentication.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Month Report - Debtor Book</title>
    <?php 
     include "../../externalCss.php";
     include "../../datatableCss.php";
     include "../../api/db.php";
     include "../../api/User.php";
     $userId = $_SESSION["user_auth_id"];
     $user = new User($conn);
     $userNameArr =$user->getUserNameArray($userId);
     include "../../api/Transactions.php";
     $transaction = new Transactions($conn);     
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
                  <h1 class="gray-text"> <i class="fa fa-list-alt"></i> Current Month Report</h1>
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
                            $transactions = $transaction->getCurrentMonthTransactions();
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
                                  <a href="javascript:void(0)" class="btn rounded-circle btn-primary" 
                                    onclick="openTransactionInfoModal('<?php echo $transaction['TRANSACTION_DATE'];?>','<?php echo $transaction['DEBTOR_NAME'];?>','<?php echo $transaction['DEBTOR_MOBILE'];?>','<?php echo $transaction['DEBTOR_EMAIL'];?>','<?php echo $transaction['DEBTOR_ADDRESS'];?>','<?php echo $transaction_create_at;?>','<?php echo $transaction_update_at;?>','<?php echo  $transaction['PAY_AMOUNT'];?>','<?php echo  $transaction['RECEIVED_AMOUNT'];?>')"> <i class="fa fa-info-circle"></i> 
                                  </a>
                                    <a href="javascript:void(0)" class="btn rounded-circle btn-secondary" onclick="window.open('../transactions/editTransaction.php?transaction=<?php echo $encryted_transaction_id;?>','_blank')"> <i class="fa fa-pencil"></i> </a>
                                    <a href="javascript:void(0)" class="btn rounded-circle btn-danger" onclick="openTransactionDeleteModal(<?php echo $transaction['TRANSACTION_ID'];?>)"> <i class="fa fa-trash"></i> </a>                                   
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

 <!--view transaction Modal -->
<div class="modal fade" id="transactionInfoModal" tabindex="-1" role="dialog" aria-labelledby="transactionInfoModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title gray-text" id="exampleModalLabel ">Transaction Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
               <div class="col-md-12 border-bottom pt-2 mb-1">
                      <h6 class="text-rem1 gray-text">Date</h6>
                      <small id="transactionDate" class="gray-text"></small>
               </div>
               <div class="col-md-12 border-bottom pt-2 mb-1">
                      <h6 class="text-rem1 gray-text">Debtor Name</h6>
                      <small id="debtorName" class="gray-text"></small>
               </div>
               <div class="col-md-12 border-bottom pt-2 mb-1">
                      <h6 class="gray-text">Debtor Mobile</h6>
                      <small id="debtorMobile" class="gray-text"></small>
               </div>
               <div class="col-md-12 border-bottom pt-2 mb-1">
                      <h6 class="gray-text">Debtor Email</h6>
                      <small id="debtorEmail" class="gray-text"></small>
               </div>
               <div class="col-md-12 border-bottom pt-2 mb-1">
                      <h6 class="gray-text">Create on</h6>
                      <small id="debtorCreateOn" class="gray-text"></small>
               </div>
               <div class="col-md-12 border-bottom pt-2 mb-1">
                      <h6 class="gray-text">Update on</h6>
                      <small id="debtorUpdateOn" class="gray-text"></small>
               </div>
               <div class="col-md-12 border-bottom pt-2 mb-1">
                      <h6 class="gray-text">Pay Amount</h6>
                      <small id="payAmount" class="gray-text"></small>
               </div>
               <div class="col-md-12 border-bottom pt-2 mb-1">
                      <h6 class="gray-text">Received Amount</h6>
                      <small id="receivedAmount" class="gray-text"></small>
               </div>
               <div class="col-md-12 border-bottom pt-2 mb-1">
                      <ul style="list-style:none;display: inline-flex;font-size:22px;">
                          <li class="p-2"><a href="#" id="debtorCallBtn"><i class="fa fa-phone text-success"></i></a> <li>
                        <li class="p-2"><a href="#" id="debtorSmsBtn"><i class="fa fa-envelope-open"></i></a> </li>
                         <li class="p-2"><a href="#" id="debtorMailBtn"><i class="fa fa-envelope text-danger"></i> </a></li>
                         <li class="p-2"><a href="#" id="debtorWhatsappBtn" target="_blank"><i class="fa fa-whatsapp text-success"></i> </a></li>
                          </li>
                      </ul>
               </div>
          </div>

      </div>     
    </div>
  </div>
</div>

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
    //  *openTransactionInfoModal
    function openTransactionInfoModal(transactionDate,name,mobile,email,address,createDate,updateDate,payAmount,receivedAmount){
            $("#transactionDate").text(transactionDate);
            $("#debtorName").text(name);
            $("#debtorMobile").text(mobile);
            $("#debtorEmail").text(email);
            $("#debtorAddress").text(address);
            $("#debtorCreateOn").text(createDate);
            $("#debtorUpdateOn").text(updateDate);
            $("#payAmount").text(payAmount);
            $("#receivedAmount").text(receivedAmount);
            $("#debtorCallBtn").prop("href",`tel:+91${mobile}`);
            $("#debtorSmsBtn").prop("href",`sms:+91${mobile}`);
            $("#debtorWhatsappBtn").prop("href",`https://api.whatsapp.com/send?phone=+91${mobile}"`);
            if(email.length === 0){
                $("#debtorMailBtn").hide();
            }else{
                $("#debtorMailBtn").prop("href",`mailto:${email}`);
                $("#debtorMailBtn").show();
            }
            $('#transactionInfoModal').modal({
                backdrop: 'static',
                keyboard: false
           })
    }

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
  // delete debtor
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
     if($transaction->inActiveTransaction($transactionId)){
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
       history.pushState({}, "", "")
     </script>
     <?php 
  }
?>
</body>
</html>