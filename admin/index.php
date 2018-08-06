<!DOCTYPE html>
<html>
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
    require_once '../admin/sidebar.php';
    ?>



    <!-- page content -->
    <div id="content" class="w-100 ml-2">


        <?php
        require_once '../admin/nav.php';
        ?>
        <div class="months" style="display: none">
            <span id="1">JAN</span>
            <span id="2">FEB</span>
            <span id="3">MAR</span>
            <span id="4">APR</span>
            <span id="5">MAY</span>
            <span id="6">JUN</span>
            <span id="7">JUL</span>
            <span id="8">AUG</span>
            <span id="9">SEP</span>
            <span id="10">OCT</span>
            <span id="11">NOV</span>
            <span id="12">DEC</span>
        </div>

        <div class="card mt-5">

            <div class="card-body">
                <div id="chart">

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