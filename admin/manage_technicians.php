<!---->
<!--<!DOCTYPE html>-->
<?php
//session_start();
//include_once '../login/user.php';
//$user = new User;
//$id = $_SESSION['id'];
//if (!$user->session()){
//    header("location:../login.php");
//}
//else{
//    if (!$user->isAdmin()){
//        header("location:../index.php");
//    }
//}
//if (isset($_REQUEST['q'])){
//    $user->logout();
//    header("location:login.php");
//}




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


        if(isset($_POST['submit'])){
            $username=$_POST['username'];
            $password=$_POST['password'];


            require_once "../admin/TechnicianManager.php";
            $technician_manager=new TechnicianManager();

            if($technician_manager->addTechnician($username,$password)){
               $status=true;
            }else{
               $status=false;
            }

        }
        ?>
<div class="container-fluid">


    <p></p>
    <div class="row">

        <div class="col-md-6 offset-md-3">

        <?php

        if (isset($status) && $status==true){

            ?>
            <div class="alert alert-success">

                <h5>Record Saved</h5>
            </div>

            <?php
        }else if (isset($status) && $status==false){
            ?>
            <div class="alert alert-danger">

            <h5>Error saving the record</h5>
            </div>
            <?php
        }else{
            
        }
        ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">


        <div class="card mt-5">

            <div class="card-body">
                <form method="post" >


                        <div class="form-group">

                            <input type="text" name="username" class="form-control" placeholder="username" required >
                        </div>


                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="password" required >
                        </div>

                    <div >
<!--                        <div class="col-sm-12 col-md-6 col-lg-4">-->
                        <button class ="btn btn-primary" type="submit" name="submit">Register</button>
<!--                <div id="chart">-->

                </div>
                </div>
            </div>

        </div>

    </div>
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
</body>

</html>