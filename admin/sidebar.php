<!-- sidebar -->
<nav id="sidebar">
    <div class="sidebar-header">
        <img src="../assets/images/profile.jpeg" class="rounded-circle " height="100px;" width="100px">
        <div class="d-block" style="color: white; padding-left: 30px">Admin </div>
    </div>

    <ul class="list-styled components">
        <p>Menu </p>


        <li><a href=""><i class="fa fa-dashboard mr-3"></i>Dashboard</a></li>
        <li><a href="../admin/calf_view.php"><i class="fa fa-share mr-3"></i>View Calf</a></li>
        <li>
            <a href="../admin/view_cow.php"><i class="fa fa-share mr-3"></i>View Cow</a>
        </li>
        <li><a href="../admin/daily_milk_production.php"><i class="fa fa-database mr-3"></i>Today Milk Production</a></li>
        <li><a href="../admin/milk_production.php"><i class="fa fa-database mr-3"></i>Milk Production</a></li>

        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-reddit mr-3"></i>Records</a>
<!--            <ul class="collapse show list-styled" id="pageSubmenu">-->
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
                    <a href="allmonths.php">All months</a>
                </li>
            </ul>
        </li>

        <li>

            <a href="#monthMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-database mr-3"></i>Monthly Records</a>
            <ul class="collapse  list-styled" id="monthMenu">
                <li>
                    <a href="../admin/monthlyTabularMilkRecords.php">Tabular View</a>
                </li>

                <li>
                    <a href="monthlyGraph.php">Graph</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="manage_technicians.php"><i class="fa fa-users mr-3"></i>Manage Accounts</a>

        </li>

        <li>
            <a href="../logout.php"><i class="fa fa-lock mr-3"></i>Logout</a>

        </li>
    </ul>
</nav>
