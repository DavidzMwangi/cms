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
require_once "BreedManager.php";
$breed_manger=new BreedManager();

require_once "CalfManager.php";

$calf_manger= new CalfManager();


require_once "CowManager.php";
$cow_manager= new CowManager();


if (isset($_POST['submit'])){
    $name=$_POST['nick_name'];
    $dob=$_POST['dob'];
    $weight=$_POST['birth_weight'];
    $breed=$_POST['breed'];
    $calf_id=$_POST['calf_id'];

    if ($calf_manger->addCalf($name,$weight,$dob,$breed,$calf_id)){
        $status=true;
    }
    else{
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

        <?php
        require_once 'nav.php';
        ?>
        <div class="container-fluid">
            <div class="card " style="margin-top: 25px">
                <div class="card-header">

                    <h3>Add Calf Record</h3>
                    <hr>
                </div>

                <div class="card-body">


                    <form action="" method="post">

<!--                        --><?php
                        if (isset($status)){
                            if ($status==true){
                                ?>
                                <!--                <div class="row">-->
                                <div class="col-offset-4 col-md-4 col-lg-6 col-sm-12  alert-success" >
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
//
//                        ?>

                        <div class="row">
                            <div class="col-md-3 col-sm-12 col-lg-3">
                                <label for="nick_name">Calf Nick Name</label>
                               <input type="text" class="form-control" id="nick_name" name="nick_name" required>


                            </div>

                            <div class="col-md-3 col-sm-12 col-lg-3">
                                <label for="calf_id">Calf ID</label>
                                <input type="text" class="form-control" id="calf_id" name="calf_id" required>


                            </div>

                            <div class="col-md-3 col-sm-12 col-lg-3">
                                <label for="dob">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" id="dob">
                            </div>

                            <div class="col-md-3 col-sm-12 col-lg-3">
                                <label for="birth_weight">Birth Weight</label>
                                <input type="number" name="birth_weight" class="form-control" id="birth_weight" min="1">

                            </div>


                            <div class="col-md-3 col-sm-12 col-lg-3">
                                <label for="breed">Breed</label>
                                <select name="breed" id="breed" class="form-control" required >
                                    <option disabled selected>Select Cow Breed</option>

                                    <?php



                                    $results=$breed_manger->allBreeds();
                                    while ($row=$results->fetch_array()){
                                        echo "<option value='$row[0]'>$row[1]</option>";

                                    }
                                    ?>

                                </select>

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
                <div class="card-header">

                    <h3>View Existing Cows</h3>
                    <hr>
                </div>

                <div class="card-body">


                    <table id="cows_table" class="display">
                        <thead>
                        <tr>
                            <th>calf nick name</th>
                            <th>Date of Birth</th>
                            <th>Breed</th>
                            <th>Birth Weight</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>



                        <?php

                        $result66=$calf_manger->showCalf();


                        while($row=$result66->fetch_array()){
                            echo '<tr>
                      <td >'.$row['nick_name'].'</td>
                        <td>'.$row['dob'].'</td>
                        <td>'.$cow_manager->breedResolver($row['breed_id']).'</td>
                        <td>'.$row['birth_weight'].'</td>
                       <td>
                       <a href="#"><button class="btn btn-outline-primary" onclick="getSelectedDetails('.$row['id'].','.$row['nick_name'].')" data-toggle="modal" data-target="#centralModalLGInfoDemo"  >Edit</button></a>
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
                <p class="heading lead">Edit Cow Record</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <form action="" method="post">
                <!--Body-->
                <div class="modal-body">

                    <input type="hidden" id="edit_milk_record_id" name="edit_milk_record_id">
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <label for="edit_cow_nick_name">Cow Nick Name</label>
                                <input type="text" class="form-control" name="edit_cow_nick_name" id="edit_cow_nick_name">
                        </div>

                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <label for="edit_dob">Date of Birth</label>

                            <input type="date" id="edit_dob" name="edit_dob" class="form-control" >
                        </div>

                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <label for="edit_breed">Breed </label>

                            <select class="form-control" name="edit_breed" id="edit_breed">

                            </select>
                        </div>
                    </div>

                </div>

                <!--Footer-->
                <div class="modal-footer">

                    <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal">No, thanks</button>


                    <button class="btn btn-success" type="submit" name="edit_submit">Update</button>
                    <!--                <a role="button" class="btn btn-success">Update-->
                    <!--                    <i class="fa fa-diamond ml-1"></i>-->
                    <!--                </a>-->
                </div>

            </form>
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
        $('#cows_table').DataTable();


    });


</script>

</body>
</html>