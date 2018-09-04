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

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <?php
                           $records= $notification_manager->allActiveNotifications();
                           if ($records->num_rows>0){
                               ?>
                        <small class="badge badge-danger">
                            <?php
                               echo $records->num_rows;
                               ?>
                        </small>
                        <?php
                           }

//                            ?>

                        Notification

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <?php


                        //add notification
                        $notification_manager->addNotification();


                        $query=$notification_manager->allActiveNotifications();

                            while ($row=$query->fetch_array()){
                                echo '<a class="dropdown-item" href="add_calf_weight.php" onclick="toggleNotification('.$row['id'].')"><b>'.$row['calf_id'].' </b>needs to be updated its weight 
                                <i class="fa fa-mars text-primary"></i></a>';

                            }

                        ?>

                    </div>
                </li>
<!--                <li class="nav-item">-->
                <!--                    <a class="nav-link " href="#">Profile</a>-->
                <!--                </li>-->
            </ul>
            <a href="onlineHelp.php"  class="btn btn-outline-light m-1 ">Online Help</a>
            <a href="#" data-toggle="modal" data-target="#centralModalLGInfoDemo" class="btn btn-outline-light">Logout</a>

        </div>
    </div>
</nav>
<div class="modal fade bottom" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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

<script type="text/javascript">
    function toggleNotification(id) {

        // var url='utils.php?notification_to_toggle='+id;
        // axios.get(url)
        //     .then(function (value) {
        //         // alert("saved")
        //     })
        //     .catch(function (reason) {
        //         alert("error")
        //     })
    }
</script>