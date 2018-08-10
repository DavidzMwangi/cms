<!DOCTYPE html>
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

require_once "../admin/MilkRecord.php";
$milk_record=new MilkRecord();
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


        <div class="card mt-5">
            <div class="card-header">

                <h3 >Monthly Records Graph</h3>
            </div>
            <div class="card-body">


                <div id="chart">

                    <canvas id="myChart" width="400" height="200"></canvas>

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

<script src="../assets/plugins/chartJs/chartJs.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>-->

<script>

    var ctx = document.getElementById("myChart");

    // var myChart = new Chart(ctx, {
    //     type: 'bar',
    //     data: data,
    //     options: options
    // });

    var datas = {
        labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
        datasets: [{
            label: "Number of Herds",
            //new option, type will default to bar as that what is used to create the scale
            type: "line",
            // fillColor: "#ff0",
            // strokeColor: "#ff0",
            // pointColor: "#ff0",
            //
            // pointStrokeColor: "#ff0",
            // pointHighlightFill: "#fff000",
            // pointHighlightStroke: "rgba(220,220,220,1)",
            backgroundColor:"rgba(0,128,0,0.5)",
            data:<?php
            echo $milk_record->monthlyHerds()
            ?>,


            // data: [65, 59, 4, 81, 56, 55, 40,56, 55, 40,56, 55]
        }, {
            label: "Total Milk Production (Litres)",
            //new option, type will default to bar as that what is used to create the scale
            type: "bar",
            // fillColor: "rgba(220,20,220,0.2)",
            // strokeColor: "rgba(220,20,220,1)",
            // pointColor: "rgba(220,20,220,1)",
            // pointStrokeColor: "#fff",
            // pointHighlightFill: "#fff",
            // pointHighlightStroke: "rgba(220,220,220,1)",
            data:<?php

            echo $milk_record->totalMonthMilk()
            ?>,
            backgroundColor:"#0000FF"

            // data: [32, 25, 33, 88, 12, 92, 33,56, 55, 40,56, 55]
        }]
    };
    var mixedChart = new Chart(ctx, {
        type: 'bar',
        data: datas
        //     {
        //     datasets: [{
        //         label: 'Bar Dataset',
        //         data: [10, 20, 30, 40]
        //     }, {
        //         label: 'Line Dataset',
        //         data: [50, 50, 50, 50],
        //
        //         // Changes this dataset to become a line
        //         type: 'line'
        //     }],
        //     labels: ['January', 'February', 'March', 'April']
        // }
        ,
        options:{
            scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: false
                            }
                        }]
                    }
        }
        // options: {
        //     scales: {
        //         yAxes: [{
        //             ticks: {
        //                 beginAtZero: true
        //             }
        //         }]
        //     }
        // }
    });
    // var myChart = new Chart(ctx, {
    //     type: 'bar',
    //     data: {
    //         labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
    //         datasets: [{
    //             label: '# of Votes',
    //             data: [12, 19, 3, 5, 2, 3],
    //             backgroundColor: [
    //                 'rgba(255, 99, 132, 0.2)',
    //                 'rgba(54, 162, 235, 0.2)',
    //                 'rgba(255, 206, 86, 0.2)',
    //                 'rgba(75, 192, 192, 0.2)',
    //                 'rgba(153, 102, 255, 0.2)',
    //                 'rgba(255, 159, 64, 0.2)'
    //             ],
    //             borderColor: [
    //                 'rgba(255,99,132,1)',
    //                 'rgba(54, 162, 235, 1)',
    //                 'rgba(255, 206, 86, 1)',
    //                 'rgba(75, 192, 192, 1)',
    //                 'rgba(153, 102, 255, 1)',
    //                 'rgba(255, 159, 64, 1)'
    //             ],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             yAxes: [{
    //                 ticks: {
    //                     beginAtZero:true
    //                 }
    //             }]
    //         }
    //     }
    // });

</script>
</body>

</html>