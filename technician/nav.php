<?php
require_once 'NotificationManager.php';
$notification_manager=new NotificationManager();
?>
<nav class="navbar navbar-expand-lg navbar-dark rounded p-3 pb-4" style="background-color: #6d7fcc;">
    <div class="container-fluid">

        <span id="sidebarCollapse" style="cursor: pointer;"><i class="fa fa-bars fa-2x mr-2 text-light" ></i></span>

        <a class="navbar-brand" href="#">Technician</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <small class="label bg-danger rounded-circle">

                            <?php
                           $records= $notification_manager->allActiveNotifications();
                           echo $records->num_rows;
                            ?>
                        </small>
                        Notifications


                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <?php


                        //add notification
                        $notification_manager->addNotification();


                        $query=$notification_manager->allActiveNotifications();

                            while ($row=$query->fetch_array()){
                         echo '<i class="fa fa-warning" ></i></span><a class="dropdown-item" href="add_calf_weight.php" onclick="toggleNotificaton('.$row['id'].')"><b>'.$row['calf_id'].' </b>needs to be updated its weight</a><hr>';

                            }

                        ?>

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">Profile</a>
                </li>
            </ul>
            <a href="../logout.php" class="btn btn-outline-light">Logout</a>

        </div>
    </div>
</nav>
<script type="text/javascript">
    function toggleNotificaton(id) {

        var url='utils.php?notification_to_toggle='+id;
        axios.get(url)
            .then(function (value) {
                alert("saved")
            })
            .catch(function (reason) {
                alert("error")
            })
    }
</script>