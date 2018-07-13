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

require_once "config.php";
//                      $results=mysqli_query($db->connect(),$sql);

$DB=new DB_FACADE();




if (isset($_POST['submit'])){
    $cow_id=$_POST['cow'];
    $milking_time=$_POST['milking_time'];
    $amount=$_POST['litres_amount'];


    //initiate the saving process
    require_once 'SaveMilk.php';
    $newRecord=new SaveMilk($cow_id,$milking_time,$amount);

    if ($newRecord->saveMilk()){
        //saved successfully
        $status=true;
    }else{
        //error occurred
        $status=false;
    }

}
?>
<div class="wrapper">
    <!-- sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>NAV HEADER</h3>
        </div>

        <ul class="list-styled components">
            <p>Dummy heading</p>
            <!-- <li class="active">
                 <a href="#homesubmenu" data-toggle="collapse" aria-expanded="false"  class="dropdown-toggle">Home</a>
                 <ul class="collapse list-styled" id="homesubmenu">
                   <li><a href="">Home 1</a></li>
                   <li><a href="">Home 2</a></li>
                   <li><a href="">Home 3</a></li>
                 </ul>
             </li>-->

            <?php
            require_once 'sidebar.php';
            ?>
        </ul>
    </nav>

    <!-- page content -->
    <div id="content" class="w-100 ml-2">

        <nav class="navbar navbar-expand-lg navbar-dark rounded p-3 pb-4" style="background-color: #6d7fcc;">
            <div class="container-fluid">

                <span id="sidebarCollapse" style="cursor: pointer;"><i class="fas fa-bars fa-2x mr-2 text-light" ></i></span>

                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="card " style="margin-top: 25px">
            <div class="card-title">

                    <h3>Add Milk Record</h3>
                    <hr>
            </div>

            <div class="card-body">


                   <form action="" method="post">

                       <?php
                       if (isset($status)){
                           if ($status){
                               ?>
                               <!--                <div class="row">-->
                               <div class="col-offset-4 col-md-4 col-lg-4 col-sm-12  alert-success" >
                                   <h3>Record Saved successfully</h3>
                               </div>
                               <!--                </div>-->
                               <?php
                           }else{
                               ?>

                               <div class="row">
                                   <div class="col-md-4 alert-danger">
                                       <h3>Error saving the record</h3>
                                   </div>
                               </div>
                               <?php
                           }
                       }
                       ?>
                       <div class="row">
                           <div class="col-md-4 col-sm-12 col-lg-4">
                               <label for="cow_name">Cow Name</label>
                               <select id="cow_name" name="cow" class="form-control" required>
                                   <option selected disabled>Select a cow</option>
                                   <?php
                                   $sql="SELECT id,nick_name FROM cows ";
                                   $results=mysqli_query($DB->connect(),$sql);
                                   while ($row = mysqli_fetch_array($results)) {
                                       echo "<option value='$row[0]'>$row[1]</option>";
                                   }


                                   ?>
                               </select>


                           </div>

                           <div class="col-md-4 col-sm-12 col-lg-4">
                               <label for="cow_name">Milking Time</label>
                               <select id="cow_name" name="milking_time" class="form-control" required>
                                   <option selected disabled>Select Milking Time</option>
                                   <option value="1" >Morning</option>
                                   <option value="2">Evening</option>
                               </select>
                           </div>


                           <div class="col-md-4 col-sm-12 col-lg-4">
                               <label for="cow_name">Amount in litres</label>
                               <input class="form-control" placeholder="Milk Produced (ltrs)" name="litres_amount" type="number" min="0" required>
                           </div>
                       </div>
                       <p></p>
                       <div class="row">
                           <div class="col-md-4 col-sm-12 col-lg-4">
                               <button class="btn btn-success" name="submit" type="submit">Save</button>
                           </div>


                       </div>

                   </form>



            </div>
            </div>




            <div class="card " style="margin-top: 25px">
            <div class="card-title">

                    <h3>Add Milk Record</h3>
                    <hr>
            </div>

            <div class="card-body">


                <table id="table_id" class="display">
                    <thead>
                    <tr>
                        <th>Cow NickName</th>
                        <th>Milking Date</th>
                        <th>Morning Amount(Litres)</th>
                        <th>Evening Amount(Litres)</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    require_once 'MilkManager.php';

                    $data=new MilkManager();
                    $querty=$data->milkRecords();

                    while ($result=mysqli_fetch_array($querty)){
                        echo '<tr>
                        <td >'.$data->cowNameResolver($result['cow_id']).'</td>
                        <td>'.$result['date'].'</td>
                        <td>'.$result['morning_amount'].'</td>
                        <td>'.$result['evening_amount'].'</td>
                        <td>
                       <a href="#"><button class="btn btn-outline-primary" onclick="getSelectedDetails('.$result['id'].','.$result['morning_amount'].','.$result['evening_amount'].')" data-toggle="modal" data-target="#centralModalLGInfoDemo" >Edit</button></a>
                      <a href="#"><button class="btn btn-outline-danger">Delete</button></a>
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

<div class="modal fade" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Edit Milk Record</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-12">
                       <label for="cow_name">Cow Name</label>
                        <span id="cow_name"></span>
<!--                        <input type="date" name="date" class="form-control" id="date" required>-->
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12">
                        <label for="morning_amount">Morning Amount</label>

                        <input type="number" id="morning_amount" name="morning_amount" min="0" class="form-control">
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12">
                       <label for="evening_amount">Evening Amount </label>
                        <input type="number" class="form-control" id="evening_amount" name="evening_amount" min="0">

                    </div>
                </div>

            </div>

            <!--Footer-->
            <div class="modal-footer">

                <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal">No, thanks</button>


                <button class="btn btn-success" type="submit">Update</button>
<!--                <a role="button" class="btn btn-success">Update-->
<!--                    <i class="fa fa-diamond ml-1"></i>-->
<!--                </a>-->
            </div>
        </div>
        <!--/.Content-->
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
        $('#cow_name').select2();
        $('#table_id').DataTable();


    });

    function getSelectedDetails(milk_record_id,morning_amount,evening_amount) {
        // alert
        $('#morning_amount').val(morning_amount);
        $('#evening_amount').val(evening_amount)

    }
</script>

</body>
</html>