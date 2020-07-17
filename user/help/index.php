<?php 
 include "../checkUserAuthentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help - Debtor Book</title>
    <?php 
     include "../../externalCss.php";     
     include "../../api/db.php";
     include "../../api/User.php";
     include "../../api/Dashboard.php";
     $userId = $_SESSION["user_auth_id"];
     $user = new User($conn);     
     $userNameArr =$user->getUserNameArray($userId);
    ?>
    <style>
    thead,th{
          position: sticky !important;
          background:#0f23ca;
          top:-5px !important;
          z-index:9999 !important;
    }</style>
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
            <h1 class="gray-text"> <i class="fa fa-question-circle"></i> Help</h1>
                  <hr/>
                  <div class="table-responsive bg-white pb-2" style="height:400px;overflow:auto;">
                  <table class="table stripe display nowrap" id="debtorsTable">
                      <thead class="blue text-white">
                          <tr>
                              <th>Sr. No.</th>
                              <th>Shortcut Key</th>
                              <th>Details</th>                              
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                             <td>1</td>
                             <td> <kbd>Alt + H</kbd> </td>
                             <td> Open Dashboard (Home Page)</td>
                          </tr>

                          <tr>
                             <td>2</td>
                             <td> <kbd>Alt + P</kbd> </td>
                             <td> Payment Transaction</td>
                          </tr>
                          <tr>
                             <td>3</td>
                             <td> <kbd>Alt + R</kbd> </td>
                             <td> Received Transaction</td>
                          </tr>
                          <tr>
                             <td>4</td>
                             <td> <kbd>Alt + B</kbd> </td>
                             <td> Open Day Book</td>
                          </tr>
                          <tr>
                             <td>5</td>
                             <td> <kbd>Alt + T</kbd> </td>
                             <td> Open Trash Page</td>
                          </tr>
                          <tr>
                             <td>6</td>
                             <td> <kbd>Alt + M</kbd> </td>
                             <td>Open Profile Page</td>
                          </tr>
                          <tr>
                             <td>7</td>
                             <td> <kbd>Alt + S</kbd> </td>
                             <td>Search Transactions</td>
                          </tr>
                          <tr>
                             <td>8</td>
                             <td> <kbd>Alt + O</kbd> </td>
                             <td>Open Debtors Page</td>
                          </tr>
                          <tr>
                             <td>8</td>
                             <td> <kbd>Alt + A</kbd> </td>
                             <td>Open About Info</td>
                          </tr>
                          <tr>
                             <td>8</td>
                             <td> <kbd>Alt + I</kbd> </td>
                             <td>Open Reminders</td>
                          </tr>
                          <tr>
                             <td>9</td>
                             <td> <kbd>Alt + C</kbd> </td>
                             <td>Open Current Month Report</td>
                          </tr>
                          <tr>
                             <td>10</td>
                             <td> <kbd>Alt + Y</kbd> </td>
                             <td>Open Current Year Report</td>
                          </tr>
                          <tr>
                             <td>11</td>
                             <td> <kbd>Alt + U</kbd> </td>
                             <td>Open Paid Amount Report</td>
                          </tr>
                          <tr>
                             <td>12</td>
                             <td> <kbd>Alt + N</kbd> </td>
                             <td>Open Received Amount Report</td>
                          </tr>
                          <tr>
                             <td>13</td>
                             <td> <kbd>Alt + N</kbd> </td>
                             <td>Report Between A Period</td>
                          </tr>
                          <tr>
                             <td>14</td>
                             <td> <kbd>Alt + Z</kbd> </td>
                             <td>Debtors Report</td>
                          </tr>
                          <tr>
                             <td>15</td>
                             <td> <kbd>Alt + L</kbd> </td>
                             <td>Logout</td>
                          </tr>
                      </tbody>
                  </table>      
            </div><!--main--->
        </div>
        <div class="gray-text ml-4">
                <p>
                    <strong>Note: <mark>All shorcut's are working in chrome browser.</mark>  </strong>
                </p>
               <p><i class="fa fa-envelope"></i> skaran921@gmail.com</p>
               <p><i class="fa fa-github"></i> skaran921</p>
               <p><i class="fa fa-twitter"></i> skaran921</p>
        </div>
        <!-- Page content end-->
<?php 
     include "../../externalJs.php";
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