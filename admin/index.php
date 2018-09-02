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


require_once '../technician/CowManager.php';
$cow_manager=new CowManager();

require_once '../technician/MilkManager.php';
$milk_manager=new MilkManager();


?>
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
    include '../admin/sidebar.php';
    ?>




    <div id="content" class="w-100 ml-2">

        <?php
        require_once "nav.php";
        ?>


        <div class="container-fluid">


            <div class="card mt-5">


                <div class="card-header">
                    <h3>Today's Milk Records</h3>
                </div>
                <div class="card-body">

                    <table id="table_id" class="display">
                        <thead>
                        <tr>
                            <th>Cow ID</th>
                            <th>Cow NickName</th>
                            <th>Cow Breed</th>
                            <th>Morning Amount</th>
                            <th>Evening Amount</th>
                            <th>Average Milk</th>
                            <th>Total Milk</th>
                        </tr>
                        </thead>
                        <!--                                            <td>'.$cow_manager->breedResolver($cow_manager->singleCow($row['cow_id'])['breed_id']).'</td>-->

                        <tbody>
                        <?php

                        $result66=$milk_manager->SingleDailyMilkRecords();


                        while($row=$result66->fetch_array()){
                            echo $cow_manager->breedResolver($cow_manager->singleCow($row['cow_id'])) . '<tr>
                                                  <td >'.$row['cow_id'].'</td>
                                                  <td >'.$row['id'].'</td>
                                                 <td>' .'</td>

                        <td>'.$row['morning_amount'].'</td>
                        <td>'.$row['evening_amount'].'</td>
                        <td>'.(($row['evening_amount']+$row['morning_amount'])/2).'</td>
                        <td>'.(($row['evening_amount']+$row['morning_amount'])).'</td>
                      
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
        $('#cow_to_delete').val(id)
    }
</script>
</body>

</html>