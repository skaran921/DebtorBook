<?php 
 include "../checkUserAuthentication.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debtors - Debtor Book</title>
    <?php 
     include "../../externalCss.php";
     include "../../datatableCss.php";
     include "../../api/db.php";
     include "../../api/User.php";
     $userId = $_SESSION["user_auth_id"];
     $user = new User($conn);
     $userNameArr =$user->getUserNameArray($userId);
     include("../../api/Debtors.php");
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
            <div class="main p-2">
                  <h1 class="gray-text"> <i class="fa fa-users"></i> Debtor's</h1>
                  <hr/>
                    <a href="./createDebtor.php" class="btn addBtn mb-2"> <i class="fa fa-plus"></i> Create Debtor </a>
                  <div class="table-responsive">
                  <table class="table stripe display nowrap" id="debtorsTable">
                      <thead class="blue text-white">
                          <tr>
                              <th>Sr. No.</th>
                              <th>Name</th>
                              <th>Mobile</th>
                              <th>Email</th>
                              <th>Address</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                            //  include("../../api/db.php");
                            include "../../api/db.php";
                            $debtor = new Debtors($conn);
                            $debtors = $debtor->getActiveDebtors();
                            $srNo =1;
                            foreach($debtors as $debtor){
                                $createDate = date("d-M-Y h:i:s A",strtotime($debtor['DEBTOR_CREATE_DATE']));
                                $updateDate = date("d-M-Y h:i:s A",strtotime($debtor['DEBTOR_UPDATE_DATE']));
                                $encryted_debtor_id = base64_encode($debtor['DEBTOR_ID']);
                                ?>
                              <tr class="p-4">
                                <td><?php echo $srNo; ?></th>
                                <td><?php echo $debtor['DEBTOR_NAME'];?></td>
                                <td><?php echo $debtor['DEBTOR_MOBILE'];?></td>
                                <td><?php echo $debtor['DEBTOR_EMAIL'];?></td>
                                <td><?php echo $debtor['DEBTOR_ADDRESS'];?></td>
                                <td>
                                  <a href="javascript:void(0)" class="btn rounded-circle btn-primary" 
                                    onclick="openDebtorInfoModal('<?php echo $debtor['DEBTOR_NAME'];?>','<?php echo $debtor['DEBTOR_MOBILE'];?>','<?php echo $debtor['DEBTOR_EMAIL'];?>','<?php echo $debtor['DEBTOR_ADDRESS'];?>','<?php echo $createDate;?>','<?php echo  $updateDate;?>')"> <i class="fa fa-info-circle"></i> 
                                  </a>
                                    <a href="javascript:void(0)" class="btn rounded-circle btn-secondary" onclick="window.open('./editDebtor.php?debtor=<?php echo $encryted_debtor_id;?>','_blank')"> <i class="fa fa-pencil"></i> </a>
                                    <a href="javascript:void(0)" class="btn rounded-circle btn-danger" onclick="openDebtorDeleteModal(<?php echo $debtor['DEBTOR_ID'];?>)"> <i class="fa fa-trash"></i> </a>                                   
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

 <!--view debtor Modal -->
<div class="modal fade" id="debtorInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title gray-text" id="exampleModalLabel ">Debtor Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
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

 <!--view debtor Modal -->
 <div class="modal fade" id="debtorDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title gray-text" id="exampleModalLabel ">Debtor Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="text-center"> <span class="fa fa-warning text-danger" style="font-size:6rem"></span></div>
            <div class="p-4 gray-text">Do you really want to delete this debtor A/c? </div>
            <div class="text-center">
                <div class="spinner-border blue-text fade-in" role="status" style="display:none;">
                  <span class="sr-only">Loading...</span>
                </div>
             </div>
      </div>  
      <div class="modal-footer">
           <button type="button" class="btn light-white gray-text" data-dismiss="modal" aria-label="Close">Cancel</button>
           <form action="" method="post">
              <input type="hidden" id="deleteDebtorId" name="deleteDebtorId" value="">
              <button type="submit" name="deleteDebtor"><i class="fa fa-trash"></i> Delete</button>
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
   
    function openDebtorInfoModal(name,mobile,email,address,createDate,updateDate){
            $("#debtorName").text(name);
            $("#debtorMobile").text(mobile);
            $("#debtorEmail").text(email);
            $("#debtorAddress").text(address);
            $("#debtorCreateOn").text(createDate);
            $("#debtorUpdateOn").text(updateDate);
            $("#debtorCallBtn").prop("href",`tel:+91${mobile}`);
            $("#debtorSmsBtn").prop("href",`sms:+91${mobile}`);
            $("#debtorWhatsappBtn").prop("href",`https://api.whatsapp.com/send?phone=+91${mobile}"`);
            if(email.length === 0){
                $("#debtorMailBtn").hide();
            }else{
                $("#debtorMailBtn").prop("href",`mailto:${email}`);
                $("#debtorMailBtn").show();
            }
            $('#debtorInfoModal').modal({
                backdrop: 'static',
                keyboard: false
           })
    }

    // openDebtorDeleteModal
   function openDebtorDeleteModal(debtorId){
           $("#deleteDebtorId").val(debtorId);
           $('#debtorDeleteModal').modal({
                backdrop: 'static',
                keyboard: false
           })
   }
</script>

<?php 
  // delete debtor
  if(isset($_POST["deleteDebtor"])){
     $debtorId = $_POST["deleteDebtorId"];
     include "../../api/db.php";
     $debtor = new Debtors($conn);
     if($debtor->inActiveDebtor($debtorId)){
          // success 
          ?>
          <script>
                toastr.success("Debtor Account Deleted!");
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