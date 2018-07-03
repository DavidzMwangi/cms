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
                        <th>Column 1</th>
                        <th>Column 2</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Row 1 Data 1</td>
                        <td>Row 1 Data 2</td>
                    </tr>
                    <tr>
                        <td>Row 2 Data 1</td>
                        <td>Row 2 Data 2</td>
                    </tr>
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
        $('#cow_name').select2();
        $('#table_id').DataTable();


    });

</script>

</body>
</html>