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

require_once 'BreedManager.php';

$breed_manger=new BreedManager();

require_once 'CowManager.php';
$cow_manager=new CowManager();


if (isset($_POST['submit'])){
    //save the new cow
    $cow_nick_name=$_POST['cow_nick_name'];
    $dob=$_POST['dob'];
    $breed=$_POST['breed'];


    if ($cow_manager->addCow($cow_nick_name,$dob,$breed)==true){
        $save_status=true;
    }else{
        $save_status=false;
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

                    <h3>Add Cow Record</h3>
                    <hr>
                </div>

                <div class="card-body">


                    <form action="" method="post">

                        <?php
                        if (isset($save_status)){
                            if ($save_status==true){
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
                                <label for="cow_nick_name">Cow Nick Name</label>
                               <input type="text" class="form-control" id="cow_nick_name" name="cow_nick_name" required>


                            </div>

                            <div class="col-md-4 col-sm-12 col-lg-4">
                                <label for="dob">DateOf Birth</label>
                                <input type="date" name="dob" class="form-control" id="dob">
                            </div>


                            <div class="col-md-4 col-sm-12 col-lg-4">
                                <label for="breed">Breed</label>
                                <select name="breed" id="breed" class="form-control" required >
                                    <option disabled selected>Select Cow Breed</option>
                                    <?php



                                    $results=$breed_manger->allBreeds();
                                    while ($row=mysqli_fetch_array($results)){
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
                            <th>Cow NickName</th>
                            <th>Date of Birth</th>
                            <th>Breed</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>



                        <?php

                        $result66=$cow_manager->availableCows();


                        while($row=mysqli_fetch_array($result66)){
                            echo '<tr>
                      <td >'.$row['nick_name'].'</td>
                        <td>'.$row['DOB'].'</td>
                        <td>'.$cow_manager->breedResolver($row['breed_id']).'</td>
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

    function getSelectedDetails(id,nickname) {
        //'.$row['id'].','.$row['nick_name'].','.$row['DOB'].','.$row['breed_id'].'
        alert(nickname)
            // $('#edit_cow_nick_name').val(nick_name);
            // $('#edit_dob').val(dob);
    }
</script>

</body>
</html>