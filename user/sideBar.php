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
          // its give active-link class if current Uri is same the link uri
          function isActiveUri($linkUri,$currentUri){               
               if($linkUri === $currentUri){
                 echo "active-link";
               }else{
                 echo "";
               }
          }
        ?>
       <a href="<?php echo $host.$dashboardUri;?>" class="<?php isActiveUri($dashboardUri,$currentUri);?>"> <span class="fa fa-dashboard"></span>  Dashboard</a>
       <a href="<?php echo $host.$debtorUrl;?>" class="<?php isActiveUri($debtorUrl,$currentUri);?>"> <span class="fa fa-users"></span> Debtors</a>
       <a href="<?php echo $host.$paymentUri;?>" class="<?php isActiveUri($paymentUri,$currentUri);?>"><span class="fa fa-money"></span> Payment</a>
       <a href="<?php echo $host.$receivedUri;?>" class="<?php isActiveUri($receivedUri,$currentUri);?>"> <span class="fa fa-rupee-sign"></span> Received</a>
       <a href="<?php echo $host.$dayBookUri;?>" class="<?php isActiveUri($dayBookUri,$currentUri);?>"><span class="fa fa-book"></span> Day Book</a>
       <div class="dropdown">
            <a href="#home" class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-list-alt"></span> Reports</a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Current Month</a>
            <a class="dropdown-item" href="#">Current Year</a>
            <a class="dropdown-item" href="#">Paid Amount</a>
            <a class="dropdown-item" href="#">Received Amount</a>
            <a class="dropdown-item" href="#">Between a Period</a>
            <a href="#home"> <span class="fa fa-search"></span> Search</a>
          </div>
       </div>      
       <a href="#home"> <span class="fa fa-bell"></span> Reminder</a>
       <a href="#home"><span class="fa fa-user-circle"></span> Profile</a>
       <a href="#home"> <span class="fa fa-cog"></span> Settings</a>
       <a href="javascript:void(0)" onclick="openInfoModal()"><span class="fa fa-info-circle"></span> About</a>
       <a href="javascript:void(0)" class="text-danger" onclick="openLogoutModal()"><span class="fa fa-sign-out"></span> Logout</a>
       <a href="javascript:void(0)" class="text-danger" onclick="openLogoutModal()"><span class="fa fa-trash"></span> Trash</a>
</div>  



<!--logout Modal -->
<div class="modal fade" id="logoutModal"  role="dialog" aria-labelledby="logoutModal" aria-hidden="true">
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
              <button type="btn" onclick="window.open('http://localhost/DebtorBook/user/logout.php','_self')" >
                 <i class="fa fa-sign-out"></i> Logout
              </button>
           </form>
      </div>     
    </div>
  </div>
</div>



<!--Info Modal -->
<div class="modal fade" id="infoModal"  role="dialog" aria-labelledby="infoModal" aria-hidden="true">
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
            <div class="mb-1 gray-text">Designed and developed by Karan Soni</div>           
            <div class="mb-1 gray-text">&copy; 2020 V1.0.0</div>           
      </div>  
      <div class="modal-footer">
           <button type="button" class="btn light-white text-white blue" data-dismiss="modal" aria-label="Close">Close</button>       
      </div>     
    </div>
  </div>
</div>