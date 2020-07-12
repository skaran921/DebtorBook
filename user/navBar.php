<nav class="navbar navbar-expand-lg navbar-light " style="background-color:#f1f1f1">
                    <a href="#" class="navbar-brand text-center">
                        <span class="blue-text">Debtor Book</span>
                    </a>
                <ul class="navbar-nav" style="margin-left:auto">
                    <li class="nav-item mr-3 mt-2" style="font-size:20px;cursor:pointer;">
                            <span class="fa fa-bell" onclick="window.open('http://localhost/DebtorBook/user/reminders/todaysReminder.php','_self')"></span><sup> <span class="badge badge-danger">
                            <?php
                               echo $user->getTodaysReminderCount();
                            ?></span> </sup>
                    </li>
                    <li class="nav-item">
                        <div class="rounded-circle" style="width:70;height:50;background-color:#0f23ca;color:#fafafa;padding: 1px 15px;line-height:50px;font-size:20px">
                        <?php echo $userNameArr["USER_FIRST_NAME"][0].$userNameArr["USER_LAST_NAME"][0] ?>
                        </div>
                    </li>
                </ul>
</nav>