<link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.min.css">
<nav id="sidebar">
    <div class="sidebar-header">
        <img src="../assets/images/profile.jpeg" class="rounded-circle " height="100px;" width="100px">
        <div class="d-block" style="color: white; padding-left: 30px">
            <?php
            if (isset($_SESSION['username'])) {
                echo '<strong>' . $_SESSION['username'] . '</strong>';
            } else {
                echo '<p>Not Logged In</p>';
            }
            ?>
        </div>
    </div>


    <ul class="list-styled components">
        <p>Menu</p>
        <li><a href="index.php"> <i class="fa fa-desktop mr-3"> </i>Dashboard</a></li>
        <li><a href="calf_weekly_milk_schedule.php"><i class="fa fa-table mr-3"> </i>Current Calf Milk Table</a></li>
        <li>
            <a href="calf_milk_history.php"> <i class="fa fa-history mr-3"> </i>Milk Amount History</a>
        </li>
        <li><a href="add_cow.php"><i class="fa fa-plus-square mr-3"> </i>Add Cow</a></li>

        <li>
            <a href="add_calf.php"><i class="fa fa-plus-circle mr-3"> </i>Add Calf</a>
        </li>
        <li><a href="daily_milk.php"><i class="fa fa-plus-square mr-3"> </i>Add Milk Record</a></li>

        <li>
            <a href="add_calf_weight.php"> <i class="fa fa-plus mr-3"> </i>Add Calf Weight</a>
        </li>

        <!--  <li>  <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Calf</a>-->
        <!--    <ul class="collapse list-unstyled" id="pageSubmenu">-->
        <!--        <li>-->
        <!--            <a href="add_calf.php">Add calf record</a>-->
        <!--        </li>-->
        <!--        <li>-->
        <!--            <a href="add_calf_weight.php">Add Calf Weight</a>-->
        <!--        </li>-->
        <!--        <li>-->
        <!--            <a href="calf_milk_history.php">Milk Amount History</a>-->
        <!--        </li>-->
        <!--    </ul>-->
        <!--</li>-->
        <li>
            <a href="breed.php"> <i class="fa fa-umbrella mr-3"> </i>Breed</a>
        </li>
        <li>
            <a href="../logout.php"><i class="fa fa-lock mr-3"> </i>Logout</a>
        </li>
    </ul>
</nav>

