<nav id="sidebar">
    <div class="sidebar-header">
        <img src="../assets/images/profile.jpeg" class="rounded-circle " height="100px;" width="100px">
        <div class="d-block" style="color: white; padding-left: 30px">Admin </div>
    </div>

    <ul class="list-styled components">
        <p>Menu </p>
        <!-- <li class="active">
                <a href="#homesubmenu" data-toggle="collapse" aria-expanded="false"  class="dropdown-toggle">Home</a>
                <ul class="collapse list-styled" id="homesubmenu">
                  <li><a href="">Home 1</a></li>
                  <li><a href="">Home 2</a></li>
                  <li><a href="">Home 3</a></li>
                </ul>
            </li> -->

        <li><a href=""><i class="fa fa-address-card mr-3"></i>Dashboard</a></li>
        <li><a href="../admin/calf_view.php"><i class="fa fa-address-card mr-3"></i>View Calf</a></li>
        <li>
            <a href="../admin/view_cow.php"><i class="fa fa-address-card mr-3"></i>View Cow</a>
        </li>
        <li><a href="../admin/daily_milk_production.php"><i class="fa fa-address-card mr-3"></i>Daily Milk Production</a></li>

        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">Records</a>
            <ul class="collapse show list-styled" id="pageSubmenu">
                <li>
                    <a href="#">Daily</a>
                </li>
                <li>
                    <a href="#" onclick="loadMonthlyData(event)">Monthly</a>
                </li>
                <li>
                    <a href="#">Page 3</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#">Portfolio</a>

        </li>
    </ul>
</nav>
