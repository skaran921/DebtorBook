 <div class="sidebar">
        <a href="#" class="navbar-brand text-center sticky">
             <img src="http://localhost/DebtorBook/assets/logo/logo.jpg" alt="" class="img-responsive rounded-circle" style="width:60px;height:50px;">
        </a>

        <?php
          $currentUri=$_SERVER['REQUEST_URI'];
          $host ="http://localhost";
          $dashboardUri ="/DebtorBook/user/"; 
          $debtorUrl = "/DebtorBook/user/debtors/debtors.php";
          $paymentUri = "/DebtorBook/user/transactions/payment.php";
          $receivedUri = "/DebtorBook/user/transactions/received.php";
          $dayBookUri = "/DebtorBook/user/reports/dayBook.php";
          $currentMonthReportUri = "/DebtorBook/user/reports/currentMonthReport.php";
          $currentYearReportUri = "/DebtorBook/user/reports/currentYearReport.php";
          $paidAmountReportUri = "/DebtorBook/user/reports/paidAmountReport.php";
          $receivedAmountReportUri = "/DebtorBook/user/reports/receivedAmountReport.php";
          $reportBetweenTwoDateUri ="/DebtorBook/user/reports/reportBetweenTwoDate.php";
          $searchTransactionUri = "/DebtorBook/user/reports/searchTransaction.php";
          $debtorWiseReportUri = "/DebtorBook/user/reports/deborsWiseReport.php";
          $debtorReportUri = "/DebtorBook/user/reports/debtorReport.php";
          $remindersUri = "/DebtorBook/user/reminders/reminders.php";
          $profileUri = "/DebtorBook/user/profile/index.php";
          $trashUri = "/DebtorBook/user/trash/index.php";
          // its give active-link class if current Uri is same the link uri
          function isActiveUri($linkUri,$currentUri){               
               if($linkUri === $currentUri){
                 echo "active-link";
               }else{
                 echo "";
               }
          }

          function isActiveReportsUri($condition){               
            if($condition){
              echo "active-link";
            }else{
              echo "";
            }
       }
        ?>
       <a accesskey="h" href="<?php echo $host.$dashboardUri;?>" class="<?php isActiveUri($dashboardUri,$currentUri);?>"> <span class="fa fa-dashboard"></span>  Dashboard</a>
       <a Accesskey="O" href="<?php echo $host.$debtorUrl;?>" class="<?php isActiveUri($debtorUrl,$currentUri);?>"> <span class="fa fa-users"></span> Debtors</a>
       <a accesskey="p"  href="<?php echo $host.$paymentUri;?>" class="<?php isActiveUri($paymentUri,$currentUri);?>"><span class="fa fa-money"></span> Payment</a>
       <a accesskey="r" href="<?php echo $host.$receivedUri;?>" class="<?php isActiveUri($receivedUri,$currentUri);?>"> <span class="fa fa-rupee-sign"></span> Received</a>
       <a accesskey="b" href="<?php echo $host.$dayBookUri;?>" class="<?php isActiveUri($dayBookUri,$currentUri);?>"><span class="fa fa-book"></span> Day Book</a>
       <div class="dropright">
            <a   class="dropdown-toggle <?php isActiveReportsUri($currentUri=== $currentMonthReportUri || $currentUri === $currentYearReportUri || $currentUri === $paidAmountReportUri || $currentUri === $receivedAmountReportUri
              || $currentUri === $reportBetweenTwoDateUri  || $currentUri === $searchTransactionUri || $currentUri === $debtorWiseReportUri
               || $currentUri === $debtorReportUri
              );?>" 
                  href="javascript:void(0)" type="button" 
                  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="fa fa-list-alt"></span>
                  Reports
            </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a accesskey="c" class="dropdown-item <?php isActiveUri($currentMonthReportUri,$currentUri);?>" href="<?php echo $host.$currentMonthReportUri;?>"> <i class="fa fa-calendar-alt"></i> Current Month</a>
            <a accesskey="y" class="dropdown-item <?php isActiveUri($currentYearReportUri,$currentUri);?>" href="<?php echo $host.$currentYearReportUri;?>"><i class="fa fa-calendar-alt"></i> Current Year</a>
            <a accesskey="u" class="dropdown-item <?php isActiveUri($paidAmountReportUri,$currentUri);?>" href="<?php echo $host.$paidAmountReportUri;?>"><i class="fa fa-money"></i> Paid Amount</a>
            <a accesskey="n" class="dropdown-item <?php isActiveUri($receivedAmountReportUri,$currentUri);?>" href="<?php echo $host.$receivedAmountReportUri;?>"><i class="fa fa-rupee-sign"></i> Received Amount</a>
            <a accesskey="w" class="dropdown-item <?php isActiveUri($reportBetweenTwoDateUri,$currentUri);?>" href="<?php echo $host.$reportBetweenTwoDateUri;?>"> <i class="fa fa-calendar-plus"></i> Between a Period</a>
            <a accesskey="s" class="dropdown-item <?php isActiveUri($searchTransactionUri,$currentUri);?>" href="<?php echo $host.$searchTransactionUri;?>"> <span class="fa fa-search"></span> Search</a>
            <a accesskey="z" class="dropdown-item <?php isActiveUri($debtorWiseReportUri,$currentUri);?>" href="<?php echo $host.$debtorWiseReportUri;?>"> <span class="fa fa-users"></span> Debtors Report</a>
          </div>
       </div>      
       <a accesskey="i"  class="<?php isActiveUri($remindersUri,$currentUri);?>" href="<?php echo $host.$remindersUri;?>"> <span class="fa fa-bell"></span> Reminders</a>
       <a accesskey="m" class="<?php isActiveUri($profileUri,$currentUri);?>" href="<?php echo $host.$profileUri;?>"><span class="fa fa-user-circle"></span> Profile</a>
       <a accesskey="a" href="javascript:void(0)" onclick="openInfoModal()"><span class="fa fa-info-circle"></span> About</a>
       <a accesskey="l" href="javascript:void(0)" class="text-danger" onclick="openLogoutModal()"><span class="fa fa-sign-out"></span> Logout</a>
       <a accesskey="t" class="<?php isActiveUri($trashUri,$currentUri);?>" href="<?php echo $host.$trashUri;?>"><span class="fa fa-trash"></span> Trash</a>
</div>  



<!--logout Modal -->
<div class="modal fade" id="logoutModal"  role="dialog" aria-labelledby="logoutModal" aria-hidden="true" style="z-index:99999">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title gray-text" id="logoutModal ">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="text-center"> <span class="fa fa-warning text-danger" style="font-size:6rem"></span></div>
            <div class="p-4 gray-text text-center">Do you really want to logout? </div>           
      </div>  
      <div class="modal-footer">
           <button type="button" class="btn light-white gray-text" data-dismiss="modal" aria-label="Close">Cancel</button>          
           <form>
              <a href="http://localhost/DebtorBook/user/logout.php"  class="btn blue text-white" onclick="openLogout()" >
                 <i class="fa fa-sign-out"></i> Logout
              </a>
           </form>
      </div>     
    </div>
  </div>
</div>



<!--Info Modal -->
<div class="modal fade" id="infoModal"  role="dialog" aria-labelledby="infoModal" aria-hidden="true" style="z-index:99999">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title gray-text" id="logoutModal ">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="text-center"> <span class="fa fa-info-circle blue-text" style="font-size:6rem"></span></div>
            <div class="mb-1 text-center gray-text">
               Designed and developed by Karan Soni               
            </div>           
            <div class="mb-1 gray-text text-center">July 2020 V1.0.0</div>           
            <div class="gray-text">
            <p><i class="fa fa-envelope"></i> skaran921@gmail.com</p>
               <p><i class="fa fa-github"></i> skaran921</p>
               <p><i class="fa fa-twitter"></i> skaran921</p>
            </div>
      </div>  
      <div class="modal-footer">
           <button type="button" class="btn light-white text-white blue" data-dismiss="modal" aria-label="Close">Close</button>       
      </div>     
    </div>
  </div>
</div>
