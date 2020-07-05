<div class="sidebar">
        <a href="#" class="navbar-brand text-center sticky">
             <img src="http://localhost/DebtorBook/assets/logo/logo.jpg" alt="" class="img-responsive rounded-circle" style="width:60px;height:50px;">
        </a>

        <?php
          $currentUri=$_SERVER['REQUEST_URI'];
          $host ="http://localhost";
          $dashboardUri ="/DebtorBook/user/"; 
          $debtorUrl = "/DebtorBook/user/debtors/debtors.php";
          // its give active-link class if current Uri is same the link uri
          function isActiveUri($linkUri,$currentUri){               
               if($linkUri === $currentUri){
                 echo "active-link";
               }else{
                 echo "";
               }
          }
        ?>
       <a href="<?php echo $host.$dashboardUri;?>" class="<?php isActiveUri($dashboardUri,$currentUri);?> fade-in"> <span class="fa fa-dashboard"></span>  Dashboard</a>
       <a href="<?php echo $host.$debtorUrl;?>" class="<?php isActiveUri($debtorUrl,$currentUri);?> fade-in"> <span class="fa fa-users"></span> Debtors</a>
       <a href="#home"><span class="fa fa-money"></span> Payment</a>
       <a href="#home"> <span class="fa fa-rupee-sign"></span> Received</a>
       <a href="#home"><span class="fa fa-book"></span> Day Book</a>
       <a href="#home"><span class="fa fa-list-alt"></span> Reports</a>
       <a href="#home"> <span class="fa fa-bell"></span> Reminder</a>
       <a href="#home"><span class="fa fa-user-circle"></span> Profile</a>
       <a href="#home"> <span class="fa fa-cog"></span> Settings</a>
       <a href="#home"><span class="fa fa-info-circle"></span> About</a>
       <a href="javascript:void(0)" class="text-danger" onclick="openLogoutModal()"><span class="fa fa-sign-out"></span> Logout</a>
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
            <div class="p-4 gray-text">Do you really want to logout? </div>           
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