<?php 
 include "./checkUserAuthentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Debtor Book</title>
    <?php 
     include "../externalCss.php";     
     include "../api/db.php";
     include "../api/User.php";
     $userId = $_SESSION["user_auth_id"];
     $user = new User($conn);
     $userNameArr =$user->getUserNameArray($userId);
    ?>
</head>
<body>    
    <!-- sidebar -->
      <?php include("./sideBar.php"); ?>  
    <!-- Page content -->
    <div class="sidebarContent">
          <!-- navbar -->
             <?php include("./navBar.php"); ?>  
          <!-- navbar end-->
            
            <!-- main content-->
            <div class="main p-5">
                   <div class="row dashboard-card-row"> <!--main row -->

                   <!-- first card user info -->
                       <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                             <div class="dashboard-card">
                                        <!-- icon -->
                                    <div class="dashboard-card-icon">
                                        <span class="fa fa-user-circle gray-text"></span>
                                    </div><!-- icon -->

                                    <div class="vr"></div>
                                    <!-- text -row -->
                                    <div class="dashboard-card-text-row row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                            <center>
                                                <div class="circle-avatar">
                                                   <?php echo $userNameArr["USER_FIRST_NAME"][0].$userNameArr["USER_LAST_NAME"][0] ?>
                                                </div>  
                                            </center>                                       
                                            <?php 
                                              echo $userNameArr["USER_FIRST_NAME"]." ".$userNameArr["USER_LAST_NAME"];                                           
                                            ?>
                                        </div>
                                        
                                    </div>
                                    <!-- text -row -->
                             </div>                             
                        </div>
                            <!-- first card user info -->   
                            
                         <!-- 2nd card selected month info -->
                       <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                             <div class="dashboard-card">
                                        <!-- icon -->
                                    <div class="dashboard-card-icon">
                                        <span class="fa fa-calendar-alt gray-text"></span>
                                    </div><!-- icon -->

                                    <div class="vr"></div>
                                    <!-- text -row -->
                                    <div class="dashboard-card-text-row row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                           Today Date
                                            <center><div style="font-size:0.9rem"><?php echo date("d-M-Y") ?></div>    </center>                                       
                                        </div>
                                        
                                    </div>
                                    <!-- text -row -->
                             </div>
                        </div><!-- 2nd card selected month info end-->
                    <!-- 3rd card time info -->
                    <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                             <div class="dashboard-card">
                                        <!-- icon -->
                                    <div class="dashboard-card-icon">
                                        <span class="fa fa-clock gray-text"></span>
                                    </div><!-- icon -->

                                    <div class="vr"></div>
                                    <!-- text -row -->
                                    <div class="dashboard-card-text-row row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                          Clock
                                            <center><div style="font-size:0.9rem" id="clock"></div></center>                                       
                                        </div>
                                        
                                    </div>
                                    <!-- text -row -->
                             </div>
                        </div><!-- 3rd card time info end-->

                         <!-- 4th selected month info -->
                       <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                             <div class="dashboard-card">
                                        <!-- icon -->
                                    <div class="dashboard-card-icon">
                                        <span class="fa fa-calendar-minus gray-text"></span>
                                    </div><!-- icon -->

                                    <div class="vr"></div>
                                    <!-- text -row -->
                                    <div class="dashboard-card-text-row row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                          Current Month
                                            <center><div style="font-size:0.9rem"><?php echo date("F");?></div></center>                                       
                                        </div>
                                        
                                    </div>
                                    <!-- text -row -->
                             </div>
                        </div><!--  4th selected month info end-->


                          <!-- 5th total debtors -->
                       <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                             <div class="dashboard-card">
                                        <!-- icon -->
                                    <div class="dashboard-card-icon">
                                        <span class="fa fa-users gray-text"></span>
                                    </div><!-- icon -->

                                    <div class="vr"></div>
                                    <!-- text -row -->
                                    <div class="dashboard-card-text-row row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                          Debtors
                                            <center><div style="font-size:0.9rem">0</div></center>                                       
                                        </div>
                                        
                                    </div>
                                    <!-- text -row -->
                             </div>
                        </div><!-- 5th total debtors -->

                       <!-- 6th total transactions -->
                       <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                             <div class="dashboard-card">
                                        <!-- icon -->
                                    <div class="dashboard-card-icon">
                                        <span class="fa fa-list-alt gray-text"></span>
                                    </div><!-- icon -->

                                    <div class="vr"></div>
                                    <!-- text -row -->
                                    <div class="dashboard-card-text-row row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                          Transactions
                                            <center><div style="font-size:0.9rem">0</div></center>                                       
                                        </div>                                        
                                    </div>
                                    <!-- text -row -->
                             </div>
                        </div><!-- 6th total transactions --> 


                        <!-- 7th total transactions -->
                       <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                             <div class="dashboard-card">
                                        <!-- icon -->
                                    <div class="dashboard-card-icon">
                                        <span class="fa fa-bell gray-text"></span>
                                    </div><!-- icon -->

                                    <div class="vr"></div>
                                    <!-- text -row -->
                                    <div class="dashboard-card-text-row row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                          Reminder
                                            <center><div style="font-size:0.9rem">0</div></center>                                       
                                        </div>                                        
                                    </div>
                                    <!-- text -row -->
                             </div>
                        </div><!-- 6th total transactions --> 


                        <!-- 8th about -->
                       <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                             <div class="dashboard-card">
                                        <!-- icon -->
                                    <div class="dashboard-card-icon">
                                        <span class="fa fa-info-circle gray-text"></span>
                                    </div><!-- icon -->

                                    <div class="vr"></div>
                                    <!-- text -row -->
                                    <div class="dashboard-card-text-row row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                          About
                                            <center><div style="font-size:0.9rem">0</div></center>                                       
                                        </div>                                        
                                    </div>
                                    <!-- text -row -->
                             </div>
                        </div><!-- 8th about --> 


                         <!-- 10th about -->
                       <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                             <div class="dashboard-card">
                                        <!-- icon -->
                                    <div class="dashboard-card-icon">
                                        <span class="fa fa-question-circle gray-text"></span>
                                    </div><!-- icon -->

                                    <div class="vr"></div>
                                    <!-- text -row -->
                                    <div class="dashboard-card-text-row row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                          Help
                                            <center><div style="font-size:0.9rem">0</div></center>                                       
                                        </div>                                        
                                    </div>
                                    <!-- text -row -->
                             </div>
                        </div><!-- help --> 


                        
                         <!-- paid amount -->
                       <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                             <div class="dashboard-card">
                                        <!-- icon -->
                                    <div class="dashboard-card-icon">
                                        <span class="fa fa-money gray-text"></span>
                                    </div><!-- icon -->

                                    <div class="vr"></div>
                                    <!-- text -row -->
                                    <div class="dashboard-card-text-row row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                          Paid Amount
                                            <center><div style="font-size:0.9rem">0</div></center>                                       
                                        </div>                                        
                                    </div>
                                    <!-- text -row -->
                             </div>
                        </div><!-- paid amount--> 


                        
                         <!-- receioved amount -->
                       <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                             <div class="dashboard-card">
                                        <!-- icon -->
                                    <div class="dashboard-card-icon">
                                        <span class="fa fa-rupee-sign gray-text"></span>
                                    </div><!-- icon -->

                                    <div class="vr"></div>
                                    <!-- text -row -->
                                    <div class="dashboard-card-text-row row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                          Received Amount
                                            <center><div style="font-size:0.9rem">0</div></center>                                       
                                        </div>                                        
                                    </div>
                                    <!-- text -row -->
                             </div>
                        </div><!-- paid amount--> 


                    </div><!--main row -->
            </div><!--main--->
        </div>
        <!-- Page content end-->
<?php 
     include "../externalJs.php";
?>
<script>
    // clock script
    const clock = ()=>{
        let date = new Date();
       $("#clock").html(`${date.toLocaleTimeString()}`)
    }
    setInterval(clock, 1000);
</script>
</body>
</html>