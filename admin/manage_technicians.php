<!DOCTYPE html>
<html>
<?php
session_start();
include_once '../login/user.php';
$user = new User;
$id = $_SESSION['id'];
if (!$user->session()){
    header("location:../login.php");
}
else{
    if (!$user->isAdmin()){
        header("location:../index.php");
    }
}
if (isset($_REQUEST['q'])){
    $user->logout();
    header("location:login.php");
}




//?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"  href="../assets/css/c3.min.css" />
    <link rel="stylesheet" type="text/css"  href="../assets/css/sidebar.css" />
    <link rel="stylesheet" type="text/css" href="../assets/plugins/DataTables/datatables.css">

    <style>
        .months{
            border: 1px solid rgba(0, 0, 0, 0.125);
            background-color: white;
            border-radius: 0.25rem;
            background-clip: content-box;
            word-wrap: break-word;
            width: 100%;
            padding-top: 10px;
            height: 50px;
            text-align: center;


        }
        .months span{
            background-color: #f2f2f2;
            padding: 0.5rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }
        .months span.active{
            background-color: #007bff;
            color: #fff;
        }
        .months span:hover{
            background-color: #007bff;
            color: #fff;
        }
    </style>

</head>
<body>
<div class="wrapper">
    <!-- sidebar -->
    <?php
    require_once 'sidebar.php';
    ?>

    <!-- page content -->
    <div id="content" class="w-100 ml-2">


<?php
require_once 'nav.php';
?>


        <?php
        require_once "../admin/TechnicianManager.php";
        $technician_manager=new TechnicianManager();

        if(isset($_POST['submit'])){
            $username=$_POST['username'];
            $password=$_POST['password'];




            if($technician_manager->addTechnician($username,$password)){
               $status=true;
            }else{
               $status=false;
            }

        }

        if (isset($_POST['delete_submit'])){
            $technician_id=$_POST['delete_technician'];

           if( $technician_manager->deleteTechnician($technician_id)){
               $delete_status=true;
           }else{
               $delete_status=false;
           }
        }

        if (isset($_POST['password_submit'])){
            $new_password=$_POST['new_password'];
            $selected_technician_id=$_POST['technician_id'];

            if ($technician_manager->changePassword($selected_technician_id,$new_password)){
                $change_status=true;
            }else{
                $change_status=false;
            }
        }
        ?>
<div class="container-fluid">

    <div class="card mt-5">


        <div class="card-header">
            <h3>Add Technician</h3>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="col-md-6 offset-md-3">

                    <?php

                    if (isset($status)){
                        if ( $status){

                            ?>
                            <div class="alert alert-success">

                                <h5>Record Saved</h5>
                            </div>

                            <?php
                        }else {
                            ?>
                            <div class="alert alert-danger">

                                <h5>Error saving the record</h5>
                            </div>
                            <?php
                        }
                    }

                    if (isset($delete_status)){
                        if ( $delete_status){

                            ?>
                            <div class="alert alert-success">

                                <h5>Technician Deleted</h5>
                            </div>

                            <?php
                        }else {
                            ?>
                            <div class="alert alert-danger">

                                <h5>Error deleting technician record</h5>
                            </div>
                            <?php
                        }
                    }


                    if (isset($change_status)){
                        if ( $change_status){

                            ?>
                            <div class="alert alert-success">

                                <h5>Password successfully saved</h5>
                            </div>

                            <?php
                        }else {
                            ?>
                            <div class="alert alert-danger">

                                <h5>Error changing the password</h5>
                            </div>
                            <?php
                        }
                    }

                    ?>
                </div>

            </div>

                <form method="post" >
                <div class="row">

                    <div class="form-group col-md-4 col-lg-4 col-sm-12">

                        <input type="text" name="username" class="form-control" placeholder="username" required >
                    </div>


                    <div class="form-group col-md-4 col-lg-4 col-sm-12">
                        <input type="password" name="password" class="form-control" placeholder="password" required >
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12" >

                        <button class ="btn btn-primary" type="submit" name="submit">Add Technician</button>

                    </div>

                </div>

        </div>

    </div>
    <div class="card mt-5">


        <div class="card-header">
            <h3>Existing Technicians</h3>
        </div>
        <div class="card-body">


            <table id="table_id" class="display">
                <thead>
                <tr>
                    <th>User Name</th>
                    <th>Joining Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $result66=$technician_manager->allTechnicians();


                while($row=$result66->fetch_array()){
                    echo '<tr>
                      <td >'.$row['username'].'</td>
                        <td>'.$row['created_at'].'</td>
                       <td>
                       <a href="#"><button class="btn btn-outline-danger" data-toggle="modal" onclick="deleteF('.$row['id'].')" data-target="#centralModalLGInfoDemo"  >Delete</button>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#changePassword" onclick="changePassword('.$row['id'].')">Change Password</button>
                       </a>
                         </td>
                        </tr>';
                }
                ?>
                </tbody>

            </table>


    </div>




    </div>
</div>
</div>
</div>

<div class="modal fade bottom" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-full-height modal-bottom modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <form action="" method="post">
                <div class="modal-header">
                    <p class="heading lead">Delete Technician</p>
                    <input type="hidden" id="delete_technician" name="delete_technician">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <h3>Do you want to delete this technician?</h3>

                    <div class="modal-footer">
                        <button class="btn btn-danger" name="delete_submit" type="submit">Delete

                        </button>
                        <a role="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>
                    </div>
                </div>
                <!--/.Content-->
            </form>
        </div>
    </div>

</div>

<div class="modal fade bottom" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-full-height modal-bottom modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <form action="" method="post">
                <div class="modal-header">
                    <p class="heading lead">Change Password</p>
                    <input type="hidden" id="technician_id" name="technician_id">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <form action="" method="post">
                <div class="modal-body">
<!--                    <h3>Do you want to delete this calf?</h3>-->
                    <div class="row">

                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="new_password">New Password</label>
                        <input type="text" class="form-control" id="new_password" name="new_password">
                    </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" name="password_submit" type="submit">Change Password

                        </button>
                        <a role="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>
                    </div>
                </div>
                </form>
                <!--/.Content-->
            </form>
        </div>
    </div>

</div>
<!-- js scripts -->
<script src="../assets/js/jquery.slim.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/d3.v5.min.js"></script>
<script src="../assets/js/c3.min.js"></script>
<script src="../assets/js/main.js"></script>
<script src="js/charts.js"></script>
<script type="text/javascript" charset="utf8" src="../assets/plugins/DataTables/datatables.js"></script>
<script>
    $(document).ready(function () {
        $('#table_id').DataTable({

        });


    });

    function deleteF(id) {

        $('#delete_technician').val(id);
    }

    function changePassword(technician_id) {
        $('#technician_id').val(technician_id);
    }
</script>
</body>

</html>