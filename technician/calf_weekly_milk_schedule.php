<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
          integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css"  href="css/main.css" />
    <link rel="stylesheet" href="../assets/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/DataTables/datatables.css">

</head>
<body>


<?php


require_once "CalfManager.php";

$calf_manger= new CalfManager();


?>
<div class="wrapper">
    <!-- sidebar -->
    <nav id="sidebar">


            <?php
            require_once 'sidebar.php';
            ?>

    </nav>

    <!-- page content -->
    <div id="content" class="w-100 ml-2">

        <?php
        require_once 'nav.php';
        ?>
        <div class="container-fluid">




            <div class="card " style="margin-top: 25px">
                <div class="card-header">

                    <h3>Current Milking Schedule</h3>
                    <hr>
                </div>

                <div class="card-body">


                    <table id="cows_table" class="display">
                        <thead>
                        <tr>
                            <th>Calf Id</th>
                            <th>Calf Weight</th>
                            <th>Week</th>
                            <th>Milk Amount</th>
                            <th>Creation Date</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>



                        <?php

                        $result66=$calf_manger->activeCalfMilkRecords();


                        while($row=$result66->fetch_array()){
                            echo '<tr>
                      <td >'.$row['calf_id'].'</td>
                        <td>'.$row['calf_weight'].'</td>
                        <td>'.$row['week'].'</td>
                        <td>'.$row['milk_amount'].'</td>
                        <td>'.$row['created_at'].'</td>
                       <td>
                       <a href="../technician/add_calf_weight.php"><button class="btn btn-outline-primary"    >Update Calf Weight</button></a>
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


<!-- js scripts -->
<script src="js/jquery.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/main.js"></script>
<script src="../assets/plugins/select2/select2.js"></script>
<script type="text/javascript" charset="utf8" src="../assets/plugins/DataTables/datatables.js"></script>

<script>

    $(document).ready(function () {
        $('#cows_table').DataTable();


    });


</script>

</body>
</html>