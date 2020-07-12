<?php 
 include "../checkUserAuthentication.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminders - Debtor Book</title>
    <?php 
     include "../../externalCss.php";
     include "../../datatableCss.php";
     include "../../api/db.php";
     include "../../api/User.php";
     $userId = $_SESSION["user_auth_id"];
     $user = new User($conn);
     $userNameArr =$user->getUserNameArray($userId);
     include "../../api/Reminders.php";
     $reminder = new Reminders($conn);     
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
                  <h1 class="gray-text"> <i class="fa fa-bell"></i> Reminders</h1>
                  <div>
                      <small class="gray-text">
                            <i class="fa fa-calendar"> <?php echo date("d-m-Y"); ?></i> 
                      </small>
                  </div>
                  <hr/>
                  <a href="./insertReminder.php" class="btn addBtn mb-2"> <i class="fa fa-plus"></i> Create Reminder </a>
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
                              <th>Reminder</th>
                              <th>Create At</th>
                              <th>Update At</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php                            
                            $reminders = $reminder->getActiveReminders();
                            $srNo =1;
                            $totalPay = 0.0;
                            $totalReceived = 0.0;
                            foreach($reminders as $reminder){                                
                                $encryted_reminder_id = base64_encode($reminder['REMINDER_ID']);
                                $reminder_create_at= date("d-M-Y h:i:s A",strtotime($reminder['REMINDER_CREATE_DATE']));
                                $reminder_update_at = date("d-M-Y h:i:s A",strtotime($reminder['REMINDER_UPDATE_DATE']));
                              
                                ?>
                              <tr class="p-4">
                                <td><?php echo $srNo; ?></th>
                                <td><?php echo $reminder['REMINDER_DATE'];?></td>
                                <td><?php echo $reminder['REMINDER'];?></td>
                                <td><?php echo $reminder_create_at;?></td>
                                <td><?php echo $reminder_update_at;?></td>
                                <td>                                 
                                    <a href="javascript:void(0)" class="btn rounded-circle btn-primary" onclick="window.open('../transactions/editTransaction.php?transaction=<?php echo $encryted_reminder_id;?>','_blank')"> <i class="fa fa-pencil"></i> </a>
                                    <a href="javascript:void(0)" class="btn rounded-circle btn-danger" onclick="openTransactionDeleteModal(<?php echo $reminder['REMINDER_ID'];?>)"> <i class="fa fa-trash"></i> </a>                                   
                                </td>
                              </tr>
                                <?php
                                $srNo++;
                            }
                          ?>                           
                      </tbody>
                       
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