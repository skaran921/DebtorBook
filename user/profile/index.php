<?php 
 include "../checkUserAuthentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Debtor Book</title>
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
            <div class="main m-2 p-2">
                  <h1 class="gray-text"> <i class="fa fa-user-circle"></i> Profile</h1>                  
                  <hr/>

                  <div class="row">
                     <div class="col-md-6">
                     <div class="card p-5" style="border:1px solid #fefefe;">
                       <div class="body">
                         <?php 
                            
                            include "../../api/db.php";
                            $userId = $_SESSION["user_auth_id"];
                            $user = new User($conn);
                            $user =$user->getUserDetails($userId);
                         ?>
                       <div class="gray-text">
                                <i class="fa fa-user"></i> <?php echo $user["USER_FIRST_NAME"]." ".$user["USER_LAST_NAME"]; ?>
                            </div>
                            <hr/>
                            <div class="gray-text">
                                <i class="fa fa-phone"></i> <?php echo $user["USER_MOBILE"]; ?>
                            </div>
                            <hr/>
                            <div class="gray-text">
                                <i class="fa fa-envelope"></i> <?php echo $user["USER_EMAIL"]; ?>
                            </div>
                            <hr/>
                            <div class="gray-text">
                                <i class="fa fa-building"></i> <?php echo $user["USER_ADDRESS"]; ?>
                            </div>
                             <hr/>
                            <div class="gray-text">
                                <button type="button" class="btn blue text-white" onclick="openChangePasswordModal()"> <i class="fa fa-lock"></i>  Change Password</button>
                            </div>
                            <hr/>
                          
                       </div>
                  </div>
                     </div>
                  </div>
            </div><!--main--->
        </div>
        <!-- Page content end-->


        

<!--changePasswordModal -->
<div class="modal fade" id="changePasswordModal"  role="dialog" aria-labelledby="changePasswordModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title gray-text" id="logoutModal ">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" stlye="">
           <form action="" method="post" onsubmit="return validateForm()">
                <div class="form-group">
                    <label class="gray-text">Current Password*</label>
                    <input type="password" name="currentPassword" id="currentPassword" style="border:1px solid #d0d0d0" placeholder="Current Password" required>
                </div>
                <div class="form-group">
                    <label class="gray-text">New Password*</label>
                    <input type="password" name="newPassword" id="newPassword" style="border:1px solid #d0d0d0" placeholder="New Password" required>
                </div>
                <div class="form-group">
                    <label class="gray-text">Confirm Password*</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" style="border:1px solid #d0d0d0" placeholder="Confirm Password" required>
                </div>
            <div class="text-center">
            <button type="submit" class="btn light-white text-white blue" name="changePassword"><i class="fa fa-lock"></i> Change Password</button>  
            </div>
            <div class="errorMsg alert alert-danger mt-2" style="display:none;">djlasddssjsa</div>     
           </form>      
      </div>  
      <div class="modal-footer">
           <button type="button" class="btn light-white text-white blue" data-dismiss="modal" aria-label="Close">Close</button>       
      </div>     
    </div>
  </div>
</div>
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

<script>
      function openChangePasswordModal(){
        $('#changePasswordModal').modal({
                      backdrop: 'static',
                      keyboard: false
        })
      }

      function validateForm(){
          let newPassword = $("#newPassword").val();
          let confirmPassword = $("#confirmPassword").val();
          let passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
          if(newPassword.match(passwordPattern) && newPassword ===  confirmPassword){            
            $(".error_msg").hide();
            return true;
          }else if( newPassword !==  confirmPassword){
            $(".errorMsg").text("New password and Confirm password are diffrent");
            $(".errorMsg").show();
            return false;
          }else{
            // fasle
            $(".errorMsg").text("Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters");
            $(".errorMsg").show();
            return false;
          }
      }
    </script>


<?php
      if(
        isset($_POST["currentPassword"]) &&
        isset($_POST["newPassword"]) &&
        isset($_POST["confirmPassword"]) &&
        isset($_POST["changePassword"])
        ){

          if(
            !empty($_POST["currentPassword"]) &&
            !empty($_POST["newPassword"]) &&
            !empty($_POST["confirmPassword"])
            ){
              // proceed
              include "../../api/helper/ValidationHelper.php";
                $currentPassword = $_POST["currentPassword"];
                $newPassword = $_POST["newPassword"];
                $confirmPassword = $_POST["confirmPassword"];  

              if(!ValidationHelper::validatePassword($newPassword)){
                //  if password validation failed
                ?>
                   <script>
                         toastr.error('Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters',"Oops!");
                   </script>
                <?php
              }else if($newPassword !== $confirmPassword){
               //  if new password  and confirm password are not same
              ?>
                <script>
                      toastr.error('New Password And Confirm Password Are Not Same',"Oops!");
                </script>
             <?php
              }else{
                // check user authentication
                 $encryptedCurrentPassword = md5($currentPassword);
                 $encryptedNewPassword = md5($newPassword);
                 $userId = $_SESSION["user_auth_id"];                 
                 include "../../api/db.php";
                 $user = new User($conn);
                 $result = $user->updateUserPassword($userId,$encryptedCurrentPassword,$encryptedNewPassword);
                 echo "--------------------------------------".$result;
                 if($result === -1){
                        // invalid current password
                        ?>
                        <script>
                              toastr.error('Invalid Current Password.',"Oops!");
                        </script>
                     <?php
                 }elseif(!$result){ 
                          //  something went wrong
                          ?>
                            <script>
                                  toastr.error('Something Went Wrong.',"Oops!");
                            </script>
                         <?php
                 }else{
                  //  password updated
                   ?>
                   <script>
                         toastr.success('Password Updated');
                   </script>
                <?php
                 }
              }
            }
            ?>
            <script>history.pushState({}, "", "")</script>
            <?php
      }
    ?>

</body>
</html>