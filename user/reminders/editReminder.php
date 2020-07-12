<?php 
 include "../checkUserAuthentication.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reminder - Debtor Book</title>
    <?php 
     include "../../externalCss.php";
     include "../../api/db.php";
     include "../../api/User.php";
     $userId = $_SESSION["user_auth_id"];
     $user = new User($conn);
     $userNameArr =$user->getUserNameArray($userId);
     include "../../api/Reminders.php";
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
                  <h1 class="gray-text"> <i class="fa fa-pencil"></i> Edit Reminder</h1>
                  <hr/>
                  <?php 
                    if(isset($_GET['reminder'])){                         
                         include "../../api/db.php"; 
                         $reminderId = base64_decode($_GET["reminder"]);    
                         include "../../api/db.php";
                         $reminder = new Reminders($conn);                       
                         $currentReminder = $reminder->getReminderFromId($reminderId);                        
                         if(count($currentReminder)=== 0){
                            echo "<span class='text-danger'> <i class='fa fa-times-circle'></i> 400 Bad Request</span>";
                         }else{                            
                            ?>
                            <form action="" method="post" onsubmit="return validateReminderForm()">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <!-- reminder date -->
                                        <div class="form-group">
                                            <label class="gray-text">Select Reminder Date*</label>
                                           <input class="flatpickr flatpickr-input mb-2" value="<?php echo $currentReminder[0]["REMINDER_DATE"];?>" id="reminderDate" name="reminderDate" type="text" placeholder="Select Reminder Date" data-id="datetime" readonly="readonly" required>       
                                        </div>
           
                                        <!-- reminder -->
                                        <div class="form-group">
                                            <label class="gray-text">Reminder*</label>                                
                                            <textarea name="reminder" id="reminder" class="mb-2" placeholder="write your reminder..." required><?php echo $currentReminder[0]["REMINDER"];?></textarea>                               
                                        </div>
           
           
                                        <!--submit button -->
                                     <button type="submit" class="btn-block" name="updateReminder"><i class="fa fa-save"></i> Save</button>
                                    </div>
                                </div>
                             </form>
                            <?php
                         }                          
                    }else{
                         echo "<span class='text-danger'> <i class='fa fa-times-circle'></i> 400 Bad Request</span>";
                    }
                  ?>
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


<!-- js  functions-->
<script>
   function validatePaymentForm(){
      let reminderDate = $("#reminderDate").val();      
      let reminder = $("#reminder").val();
      let datePattern = /^([0-9]{2})-([0-9]{2})-([0-9]{4})$/;
     if(!reminderDate.match(datePattern)){
        toastr.error('Reminder Date is Not Valid.',"Oops!");
        return false;
     }else if(reminder=== "" || reminder.length === 0){
        toastr.error('Please Write Your Reminder.',"Oops!");
        return false;
     }else{
        return true;
     }
     
   }
</script>


<?php 
   if(
       isset($_POST["reminderDate"]) &&
       isset($_POST["reminder"]) &&
       isset($_POST["updateReminder"]) 
     ){
         $reminderDate = $_POST["reminderDate"];
         $reminder = $_POST["reminder"];        
         include "../../api/helper/ValidationHelper.php";
        //  check name validation
        if(!ValidationHelper::validateDate($reminderDate)){
                // invalid name 
                ?>
                   <script>
                         toastr.error('Reminder Date is Not Valid',"Oops!");
                   </script>
                <?php
        }elseif(empty($reminder)){
            //empty debtorid
                ?>
                   <script>
                         toastr.error('Please Write Your Reminder.',"Oops!");
                   </script>
                <?php
        }else{
            // insert data
         include "../../api/db.php";
         $reminders  = new Reminders($conn);
         $reminderId = base64_decode($_GET["reminder"]);
         $result = $reminders->updateReminder($reminderId,$reminderDate,$reminder);
         if($result){
            //   insert reminder successfully
            ?>
            <script>
                  toastr.success('Reminder Updated!');
                  window.opener.location.reload();
                  setTimeout(() => {
                       window.close();
                  }, 3000);
            </script>
           <?php
         }else{
            //   error on inserting reminder
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