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
    include "../api/Dashboard.php";
    $userId = $_SESSION["user_auth_id"];
    $user = new User($conn);
    $userNameArr = $user->getUserNameArray($userId);
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
            <div class="row dashboard-card-row">
                <!--main row -->

                <!-- first card user info -->
                <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                    <div class="dashboard-card">
                        <!-- icon -->
                        <div class="dashboard-card-icon">
                        <span><img src="../assets/images/user.gif" alt="" width="40px;"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                <center>
                                    <div class="circle-avatar">
                                        <?php echo $userNameArr["USER_FIRST_NAME"][0] . $userNameArr["USER_LAST_NAME"][0] ?>
                                    </div>
                                </center>
                                <?php
                                echo $userNameArr["USER_FIRST_NAME"] . " " . $userNameArr["USER_LAST_NAME"];
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
                            <!-- <span class="fa fa-calendar-alt gray-text"></span> -->
                            <span><img src="../assets/images/calender.gif" alt="" width="50px;"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                Today Date
                                <center>
                                    <div style="font-size:0.9rem"><?php echo date("d-M-Y") ?></div>
                                </center>
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
                        <span><img src="../assets/images/clock.gif" alt="" width="50px;"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                Clock
                                <center>
                                    <div style="font-size:0.9rem" id="clock"></div>
                                </center>
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
                        <span><img src="../assets/images/calender.gif" alt="" width="50px;"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                Current Month
                                <center>
                                    <div style="font-size:0.9rem"><?php echo date("F"); ?></div>
                                </center>
                            </div>

                        </div>
                        <!-- text -row -->
                    </div>
                </div><!--  4th selected month info end-->



                <!--today's paid amount -->
                <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                    <div class="dashboard-card">
                        <!-- icon -->
                        <div class="dashboard-card-icon">
                        <span><img src="../assets/images/ruppee.gif" alt="" width="50px;"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                Paid Amount
                                <center>
                                    <div style="font-size:0.9rem"><?php
                                                                    include "../api/db.php";
                                                                    $dashboard = new Dashboard($conn);
                                                                    echo $dashboard->getSumOfTodaysPaidAmount() ?? 0.00;
                                                                    ?></div>
                                </center>
                            </div>
                        </div>
                        <!-- text -row -->
                    </div>
                </div>
                <!--today's paid amount-->

                <!--today's receioved amount -->
                <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                    <div class="dashboard-card">
                        <!-- icon -->
                        <div class="dashboard-card-icon">
                        <span><img src="../assets/images/pay.gif" alt="" width="50px;"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                Received Amount
                                <center>
                                    <div style="font-size:0.9rem"><?php
                                                                    include "../api/db.php";
                                                                    $dashboard = new Dashboard($conn);
                                                                    echo $dashboard->getSumOfTodaysReceivedAmount() ?? 0.00;
                                                                    ?>
                                    </div>
                                    <div> <small></small> </div>

                                </center>
                            </div>
                        </div>
                        <!-- text -row -->
                    </div>
                </div>
                <!--today's receioved amount-->

                <!--today's balance amount -->
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
                                Balance Amount
                                <center>
                                    <div style="font-size:0.9rem"><?php
                                                                    include "../api/db.php";
                                                                    $dashboard = new Dashboard($conn);
                                                                    echo ($dashboard->getSumOfTodaysReceivedAmount() ?? 0.00) - ($dashboard->getSumOfTodaysPaidAmount() ?? 0.00);
                                                                    ?>
                                    </div>
                                    <div> <small></small> </div>

                                </center>
                            </div>
                        </div>
                        <!-- text -row -->
                    </div>
                </div>
                <!--today's receioved amount-->

                <!--  total debtors -->
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
                                All Debtors
                                <center>
                                    <div style="font-size:0.9rem"><?php
                                                                    include "../api/db.php";
                                                                    $dashboard = new Dashboard($conn);
                                                                    echo $dashboard->getAllDebtorsCount();
                                                                    ?></div>
                                </center>
                            </div>

                        </div>
                        <!-- text -row -->
                    </div>
                </div><!--  total debtors -->


                <!--  total active debtors -->
                <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                    <div class="dashboard-card">
                        <!-- icon -->
                        <div class="dashboard-card-icon">
                        <span><img src="../assets/images/ok.gif" alt="" width="50px;"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                Active Debtors
                                <center>
                                    <div style="font-size:0.9rem"><?php
                                                                    include "../api/db.php";
                                                                    $dashboard = new Dashboard($conn);
                                                                    echo $dashboard->getAllActiveDebtorsCount();
                                                                    ?></div>
                                </center>
                            </div>

                        </div>
                        <!-- text -row -->
                    </div>
                </div><!--  total active debtors -->

                <!--  total inActive debtors -->
                <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                    <div class="dashboard-card">
                        <!-- icon -->
                        <div class="dashboard-card-icon">
                            <span class="fa fa-trash gray-text"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                Deleted Debtors
                                <center>
                                    <div style="font-size:0.9rem"><?php
                                                                    include "../api/db.php";
                                                                    $dashboard = new Dashboard($conn);
                                                                    echo $dashboard->getAllInActiveDebtorsCount();
                                                                    ?></div>
                                </center>
                            </div>

                        </div>
                        <!-- text -row -->
                    </div>
                </div><!--  total inActive debtors -->


                <!--  total transactions -->
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
                                All Transactions
                                <center>
                                    <div style="font-size:0.9rem"><?php
                                                                    include "../api/db.php";
                                                                    $dashboard = new Dashboard($conn);
                                                                    echo $dashboard->getAllTransactionsCount();
                                                                    ?></div>
                                </center>
                            </div>
                        </div>
                        <!-- text -row -->
                    </div>
                </div><!-- total transactions -->

                <!--  total active transactions -->
                <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                    <div class="dashboard-card">
                        <!-- icon -->
                        <div class="dashboard-card-icon">
                            <span class="fa fa-check-circle gray-text"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                Active Transactions
                                <center>
                                    <div style="font-size:0.9rem"><?php
                                                                    include "../api/db.php";
                                                                    $dashboard = new Dashboard($conn);
                                                                    echo $dashboard->getAllActiveTransactionsCount();
                                                                    ?></div>
                                </center>
                            </div>
                        </div>
                        <!-- text -row -->
                    </div>
                </div><!-- total active transactions -->


                <!--  total inActive transactions -->
                <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                    <div class="dashboard-card">
                        <!-- icon -->
                        <div class="dashboard-card-icon">
                            <span class="fa fa-trash gray-text"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                Deleted Transactions
                                <center>
                                    <div style="font-size:0.9rem"><?php
                                                                    include "../api/db.php";
                                                                    $dashboard = new Dashboard($conn);
                                                                    echo $dashboard->getAllInActiveTransactionsCount();
                                                                    ?></div>
                                </center>
                            </div>
                        </div>
                        <!-- text -row -->
                    </div>
                </div><!-- total inActive transactions -->


                <!--total reminders -->
                <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                    <div class="dashboard-card">
                        <!-- icon -->
                        <div class="dashboard-card-icon">
                        <span><img src="../assets/images/bell.gif" alt="" width="60px;"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                All Reminders
                                <center>
                                    <div style="font-size:0.9rem"><?php
                                                                    include "../api/db.php";
                                                                    $dashboard = new Dashboard($conn);
                                                                    echo $dashboard->getAllRemindersCount();
                                                                    ?></div>
                                </center>
                            </div>
                        </div>
                        <!-- text -row -->
                    </div>
                </div><!-- total reminders -->


                <!--total active reminders -->
                <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                    <div class="dashboard-card">
                        <!-- icon -->
                        <div class="dashboard-card-icon">
                            <span class="fa fa-check-circle gray-text"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                Active Reminders
                                <center>
                                    <div style="font-size:0.9rem"><?php
                                                                    include "../api/db.php";
                                                                    $dashboard = new Dashboard($conn);
                                                                    echo $dashboard->getAllActiveRemindersCount();
                                                                    ?></div>
                                </center>
                            </div>
                        </div>
                        <!-- text -row -->
                    </div>
                </div><!-- total active reminders -->


                <!--total InActive reminders -->
                <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                    <div class="dashboard-card">
                        <!-- icon -->
                        <div class="dashboard-card-icon">
                            <span class="fa fa-trash gray-text"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading gray-text">
                                Deleted Reminders
                                <center>
                                    <div style="font-size:0.9rem"><?php
                                                                    include "../api/db.php";
                                                                    $dashboard = new Dashboard($conn);
                                                                    echo $dashboard->getAllInActiveRemindersCount();
                                                                    ?></div>
                                </center>
                            </div>
                        </div>
                        <!-- text -row -->
                    </div>
                </div><!-- total InActive reminders -->


                <!--  about -->
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
                                Version
                                <center>
                                    <div style="font-size:0.9rem">V1.0.0</div>
                                </center>
                            </div>
                        </div>
                        <!-- text -row -->
                    </div>
                </div><!-- 8th about -->


                <!--  help -->
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
                                <center>
                                    <div style="font-size:0.9rem">
                                        <a href="./help" class="nav-link blue-text">Go</a>
                                    </div>
                                </center>
                            </div>
                        </div>
                        <!-- text -row -->
                    </div>
                </div><!-- help -->

                <div class="col-md-6 col-lg-4 col-xl-3 mt-2">
                    <div class="dashboard-card">
                        <!-- icon -->
                        <div class="dashboard-card-icon">
                        <span><img src="../assets/images/backup.gif" alt="" width="50px;"></span>
                        </div><!-- icon -->

                        <div class="vr"></div>
                        <!-- text -row -->
                        <div class="dashboard-card-text-row row">
                            <div class="col-md-12 col-sm-12 col-lg-12 dashboard-card-heading blue-text">
                                <p style="float:right;" class="m-0">Backup</p>

                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12" onclick="window.location.href='./backup'">
                                <p style="font-size:10px;float:right;color:green;">Click Here</p>
                            </div>
                        </div>
                        <!-- text -row -->
                    </div>
                </div>


            </div>
            <!--main row -->
        </div>
        <!--main--->
    </div>
    <!-- Page content end-->
    <?php
    include "../externalJs.php";
    ?>
    <script>
        // clock script
        const clock = () => {
            let date = new Date();
            $("#clock").html(`${date.toLocaleTimeString()}`)
        }
        setInterval(clock, 1000);
    </script>
</body>

</html>