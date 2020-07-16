<?php 
 include "../checkUserAuthentication.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder Trash - Debtor Book</title>
    <?php 
     include "../../externalCss.php";
     include "../../datatableCss.php";
     include "../../api/db.php";
     include "../../api/User.php";
     $userId = $_SESSION["user_auth_id"];
     $user = new User($conn);
     $userNameArr =$user->getUserNameArray($userId);
     include "../../api/Reminders.php";   
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
                  <h1 class="gray-text"> <i class="fa fa-trash"></i> Reminder's Trash</h1>
                  <div>
                    
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
                              <th>Reminder</th>
                              <th>Deleted At</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                           include "../../api/db.php";
                           $reminder = new Reminders($conn);                              
                            $reminders = $reminder->getInActiveReminders();
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
                                <td><?php echo $reminder_update_at;?></td>
                                <td>                                 
                                    <a href="javascript:void(0)" class="btn rounded-circle btn-success" onclick="window.open('./editReminder.php?reminder=<?php echo $encryted_reminder_id;?>','_blank')"> <i class="fa fa-refresh"></i> </a>
                                    <a href="javascript:void(0)" class="btn rounded-circle btn-danger" onclick="openReminderDeleteModal(<?php echo $reminder['REMINDER_ID'];?>)"> <i class="fa fa-trash"></i> </a>                                   
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
 <div class="modal fade" id="reminderDeleteModal" tabindex="-1" role="dialog" aria-labelledby="reminderDeleteModal" aria-hidden="true">
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
            <div class="p-4 gray-text">Do you really want to delete this reminder? </div>
            <div class="text-center">
                <div class="spinner-border blue-text fade-in" id="deleteReminderLoading" role="status" style="display:none;">
                  <span class="sr-only">Loading...</span>
                </div>
            </div>
      </div>  
      <div class="modal-footer">
           <button type="button" class="btn light-white gray-text" data-dismiss="modal" aria-label="Close">Cancel</button>
           <form action="" method="post">
              <input type="hidden" id="deleteReminderId" name="deleteReminderId" value="">
              <button type="submit" name="deleteReminder"><i class="fa fa-trash"></i> Delete</button>
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
   // openReminderDeleteModal
   function openReminderDeleteModal(debtorId){
           $("#deleteReminderId").val(debtorId);
           $('#reminderDeleteModal').modal({
                backdrop: 'static',
                keyboard: false
           })
   }

//    stop page loading
$("#pageLoading").hide();
</script>

<?php 
  // delete debtor
  if(isset($_POST["deleteReminder"])){
    //   show loader
     ?>
     <script>
          $("#deleteReminderLoading").show();
          $("deleteReminder").prop("disabled",true);
     </script>
     <?php 
     $reminderId = $_POST["deleteReminderId"];
     include "../../api/db.php";
     $reminder = new Reminders($conn);
     if($reminder->setInactiveReminder($reminderId)){
          // success 
          ?>
          <script>
                toastr.success("Reminder Deleted!");
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