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
     include "../../api/Debtors.php";
    ?>
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
                  <h1 class="gray-text"> <i class="fa fa-list-alt"></i> Debtor Report</h1>
                  <div>
                  </div>
                  <hr/>
                  <div class="text-center p-4" id="pageLoading">
                        <div class="spinner-border blue-text fade-in" role="status" style="display:block;">
                        <span class="sr-only">Loading...</span>
                        </div>
                 </div>

                 <?php 
                     if(isset($_GET["debtor"])){
                        $debtorId =base64_decode($_GET["debtor"]);
                        include "../../api/db.php";
                        $debtors = new Debtors($conn);            
                        $debtor = $debtors->getDebtorById($debtorId);
                        if(!count($debtorId)){
                            echo "<span class='text-danger'>Sorry No Record Found</span>";
                        }else{  
                            // show debtor Details
                            echo "<span class='gray-text'>Debtor Acoount: </span><span style='text-transform:capitalize'>".$debtor[0]['DEBTOR_NAME']."</span><br/>";
                            echo "<span class='gray-text'>Debtor Mobile: </span><span style='text-transform:capitalize'>".$debtor[0]['DEBTOR_MOBILE']."</span>";
                            // show table
                            ?>
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
                              <th>Balance</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php                            
                            include "../../api/Transactions.php";
                            include "../../api/db.php";
                            $transaction = new Transactions($conn);     
                            $debtorId =base64_decode($_GET["debtor"]);    
                            $transactions = $transaction->getTransactionByDebtor($debtorId);
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
                                <td><?php echo $transaction['BALANCE'];?></td>
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
                            <?php
                        }
                     }
                 ?>
            </div> <!---main -------->
    </div><!-- Page content end-->

<?php 
     include "../../externalJs.php";
     include "../../datatableJs.php";
?>
<script>
//    stop page loading
$("#pageLoading").hide();
</script>

</body>
</html>