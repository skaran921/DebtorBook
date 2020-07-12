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
     $debtor = new Debtors($conn);
    ?>
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
                  <div class="table-responsive">
                  <table class="table stripe display nowrap" id="debtorsTable">
                      <thead class="blue text-white">
                          <tr>
                              <th>Sr. No.</th>
                              <th>Name</th>
                              <th>Mobile</th>
                              <th>Email</th>
                              <th>Address</th>
                              <th>View</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                            //  include("../../api/db.php");
                             
                            $debtors = $debtor->getActiveDebtors();
                            $srNo =1;
                            foreach($debtors as $debtor){                                
                                $encryted_debtor_id = base64_encode($debtor['DEBTOR_ID']);                               
                                ?>
                              <tr class="p-4">
                                <td><?php echo $srNo; ?></th>
                                <td><?php echo $debtor['DEBTOR_NAME'];?></td>
                                <td><?php echo $debtor['DEBTOR_MOBILE'];?></td>
                                <td><?php echo $debtor['DEBTOR_EMAIL'];?></td>
                                <td><?php echo $debtor['DEBTOR_ADDRESS'];?></td>
                                <td>
                                    <a href="javascript:void(0)" class="btn rounded-circle blue text-white" onclick="window.open('./debtorReport.php?debtor=<?php echo $encryted_debtor_id;?>','_self')"> <i class="fa fa-list-alt"></i> </a>
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
<?php 
     include "../../externalJs.php";
     include "../../datatableJs.php";
?>
</body>
</html>