
<?php

//this code attempts to ensure that the technician notiication is ptodate by updating the record everytime the sidebar is loaded by technician or the admin
require_once '../technician/NotificationManager.php';
$notification_manager=new NotificationManager();
$notification_manager->addNotification();
?>
<!-- sidebar -->
<nav id="sidebar">
    <div class="sidebar-header">
        <img src="../assets/images/profile.jpeg" class="rounded-circle " height="100px;" width="100px">
        <div class="d-block" style="color: white; padding-left: 30px">Admin </div>
    </div>

    <ul class="list-styled components">
        <p>Menu </p>

        <li><a href="../admin/index.php"><i class="fa fa-dashboard mr-3"></i>DashBoard</a> </li>
        <li><a href="../admin/calf_view.php"><i class="fa fa-share mr-3"></i>View Calves</a></li>
        <li>
            <a href="../admin/view_cow.php"><i class="fa fa-share mr-3"></i>View Cows</a>
        </li>
        <li><a  href="#tableSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-table mr-3"></i>Tabular Milk Records</a>
            <ul class="collapse" id="tableSubmenu">
                <li><a href="../admin/daily_milk_production.php"><i class="fa fa-database mr-3"></i>Today's Production</a></li>
                <li><a href="../admin/milk_production.php"><i class="fa fa-database mr-3"></i>Specific date</a></li>
                <li>
                    <a href="../admin/monthlyTabularMilkRecords.php"><i class="fa fa-database mr-3"></i>Summary (Monthly)</a>
                </li>
            </ul>

        </li>




        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-bar-chart  mr-3"></i>Graphical Milk Records</a>
            <!-- <ul class="collapse show list-styled" id="pageSubmenu">-->
            <ul class="collapse list-styled" id="pageSubmenu">
                <li>

                    <a href="daily.php"> Daily</a>

                </li>
                <li>
                    <a href="monthly.php">Monthly</a>
                </li>
                <li>
                    <a href="monthlyaverageforcow.php">Monthly Average For Cow</a>
                </li>
                <li>

                    <a href="allmonths.php">Annual</a>

                </li>
                <li>
                    <a href="monthlyGraph.php">Annual Herd-Milk Analysis  </a>
                </li>
            </ul>
        </li>



        <li>
            <a href="manage_technicians.php"><i class="fa fa-users mr-3"></i>Manage Accounts</a>

        </li>

        <li>
            <a href="#" data-toggle="modal" data-target="#logoutSide" ><i class="fa fa-lock mr-3"></i>Logout</a>
<!--            <button data-toggle="modal" data-target="#centralModalLGInfoDemo">Logout</button>-->
        </li>
    </ul>


    <div class="modal fade bottom" id="logoutSide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-full-height modal-bottom modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->

                    <div class="modal-header">
                        <p class="heading lead">Logout</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="white-text">&times;</span>
                        </button>
                    </div>

                    <!--Body-->
                    <div class="modal-body">
                        <p>Do you want to logout?</p>
                    </div>
                        <div class="modal-footer">
                            <a href="../logout.php" class="btn btn-danger"  >Yes

                            </a>
                            <a role="button" class="btn btn-danger waves-effect" data-dismiss="modal">No, thanks</a>
                        </div>

                    <!--/.Content-->

            </div>
        </div>

    </div>

</nav>


