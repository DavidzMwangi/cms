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

        <div class="card">
            <div class="card-body">
                <input type="date" class="form-control w-75 d-inline" id="date-picker" >
                <button class="btn btn-primary" id="load-btn">Load</button></div>
        </div>
        <div class="card mt-5">
            <div class="card-header" id="graph-title"> </div>
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
<script>
    var button =  document.getElementById('load-btn');
    var date_picker = document.getElementById('date-picker');
    var title = document.getElementById('graph-title');
    window.addEventListener('load', function (ev) {
        loadTodaysData();

        if(!date_picker.value){
            var date = new Date();
            var month = (1+date.getMonth()).toString().length ==1 ? '0'+(1+date.getMonth()): (1+date.getMonth());
            var formatted_date = date.getFullYear() + '-'+ month + '-'+ date.getDate();
            date_picker.value = formatted_date;
            title.innerText ="Daily Milk Production for "+ date_picker.value;
        }

    });

    button.addEventListener('click', function (ev) {
        if(date_picker.value) {
            //2018-07-10
            loadTodaysData(date_picker.value);
            title.innerText ="Daily Milk Production for "+ date_picker.value;
        }
    })


</script>
</body>

</html>