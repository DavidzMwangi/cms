<?php
require_once 'authcontroller.php';
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
$calf_manager=new CalfManager();


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

//      echo  date("Y-m-d h:i:s")
        ?>

        <div class="container-fluid">
            <div class="card " style="margin-top: 25px">
                <div class="card-header">

                    <h3>Calf Id</h3>
                    <hr>
                </div>

                <div class="card-body">




                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-lg-4">
                                <label for="calf_id">Calf ID</label>
                                <select id="calf_id" name="calf_id" class="form-control" onchange="displayTableData(this.value)">
                                    <option selected disabled>Select a calf</option>
                                    <?php

                                    $results=$calf_manager->allCalves();
                                    while ($row = $results->fetch_array()) {
                                        echo "<option value=".$row['calf_id'].">$row[1] <b>    Nickname: </b>$row[1]</option>";
                                    }
                                    ?>
                                </select>


                            </div>


                        </div>






                </div>
            </div>




            <div class="card " style="margin-top: 25px">
                <div class="card-header">


                    <h3>Calf Records</h3>
                    <hr>
                </div>

                <div class="card-body">


                    <table id="calf_table" class="display">
                        <thead>
                        <tr>
                            <th>Calf Id</th>
                            <th>Calf Weight</th>
                            <th>Week</th>
                            <th>Milk Amount</th>
                            <th>Creation Date</th>

                        </tr>
                        </thead>
                        <tbody>



<!--                        --><?php
//
//                        $result66=$calf_manger->activeCalfMilkRecords();
//                        while($row=$result66->fetch_array()){
//                            echo '<tr>
//                      <td >'.$row['calf_id'].'</td>
//                        <td>'.$row['calf_weight'].'</td>
//                        <td>'.$row['week'].'</td>
//                        <td>'.$row['milk_amount'].'</td>
//                        <td>'.$row['created_at'].'</td>
//                        </tr>';
//                        }
//                        ?>


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
<script type="text/javascript" src="../assets/plugins/axios/axios.min.js"></script>
<script>

    $(document).ready(function () {
        $('#cow_name').select2();
       window.calf_table= $('#calf_table').DataTable({
            'pageLength':10
        });



    });
    function displayTableData(calf_id) {
        //get the calf record

        var url='utils.php?calf_id='+ calf_id;
        calf_table.clear().draw();
        axios.get(url)
            .then(function (res) {

                $.each(res.data,function (key,value) {

                    calf_table.row.add([value[1],value[2],value[3],value[4],value[6]]);
                    // console.log(value[1])

                });
                calf_table.draw();
            })
            .catch(function (reason) {
                console.log("error")
            })
    }

</script>

</body>
</html>