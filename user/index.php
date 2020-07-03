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
                       <div class="col-md-4 col-lg-3 mt-2">
                             <div class="dashboard-card">
                                        <!-- icon -->
                                    <div class="dashboard-card-icon">
                                        <span class="fa fa-user-circle gray-text"></span>
                                    </div><!-- icon -->

                                    <div class="vr"></div>
                                    <!-- text -row -->
                                    <div class="dashboard-card-text-row row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                            <center><div class="circle-avatar">KS</div>    </center>                                       
                                            Karan Soni
                                        </div>
                                        
                                    </div>
                                    <!-- text -row -->
                             </div>                             
                        </div>
                            <!-- first card user info -->   
                            
                         <!-- 2nd card selected month info -->
                       <div class="col-md-4 col-lg-3 mt-2">
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
                    <div class="col-md-4 col-lg-3 mt-2">
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
                    <div class="col-md-4 col-lg-3 mt-2">
                             <div class="dashboard-card">
                                        <!-- icon -->
                                    <div class="dashboard-card-icon">
                                        <span class="fa fa-calendar-minus gray-text"></span>
                                    </div><!-- icon -->

                                    <div class="vr"></div>
                                    <!-- text -row -->
                                    <div class="dashboard-card-text-row row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                          Selected Year
                                            <center><div style="font-size:0.9rem"> 2020 </div></center>                                       
                                        </div>
                                        
                                    </div>
                                    <!-- text -row -->
                             </div>
                        </div><!--  4th selected month info end-->
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