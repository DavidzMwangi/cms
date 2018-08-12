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

if (isset($_POST['edit_submit'])){
    $old_calf_id=$_POST['edit_calf_record_id'];
    $calf_id=$_POST['edit_calf_id'];
    $calf_weight=$_POST['edit_birth_weight'];
    $calf_nickname=$_POST['edit_calf_nick_name'];
    $calf_breed_id=$_POST['edit_breed'];
    $calf_dob=$_POST['edit_dob'];

    if ($calf_manger->updateCalf($old_calf_id,$calf_id,$calf_weight,$calf_nickname,$calf_breed_id,$calf_dob)){
        $edit_status=true;
    }
    else{
        $edit_status=false;
    }
}
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
                                <input type="number" name="birth_weight" class="form-control" step="any" id="birth_weight" min="1">

                            </div>


                            <div class="col-md-3 col-sm-12 col-lg-3">
                                <label for="breed">Breed</label>
                                <select name="breed" id="breed" class="form-control" required >
<!--                                    <option disabled selected>Select Cow Breed</option>-->

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

                    <h3>View Existing Calves</h3>
                    <hr>
                </div>

                <div class="card-body">


                    <table id="cows_table" class="display">
                        <thead>
                        <tr>
                            <th>Calf Nickname</th>
                            <th>Calf ID</th>
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
                      <td >'.$row['calf_id'].'</td>
                        <td>'.$row['dob'].'</td>
                        <td>'.$cow_manager->breedResolver($row['breed_id']).'</td>
                        <td>'.$row['birth_weight'].'</td>
                       <td>
                       <a href="#"><button class="btn btn-outline-primary" onclick="getSelectedDetails('.$row['id'].')" data-toggle="modal" data-target="#centralModalLGInfoDemo"  >Edit</button></a>
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

                    <input type="hidden" id="edit_calf_record_id" name="edit_calf_record_id">
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <label for="edit_calf_nick_name">Cow Nick Name</label>
                                <input type="text" class="form-control" name="edit_calf_nick_name" id="edit_calf_nick_name">
                        </div>



                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <label for="edit_calf_id">Calf ID</label>
                            <input type="text" class="form-control" name="edit_calf_id" id="edit_calf_id">
                        </div>


                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <label for="edit_dob">Date of Birth</label>

                            <input type="date" id="edit_dob" name="edit_dob" class="form-control" >
                        </div>

                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <label for="edit_birth_weight">Birth Weight</label>

                            <input type="number" minlength="1" step="any" id="edit_birth_weight" name="edit_birth_weight" class="form-control" >
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
<script type="text/javascript" src="../assets/plugins/axios/axios.min.js"></script>
<script>

    $(document).ready(function () {
        $('#cows_table').DataTable();


    });

    function getSelectedDetails(id) {
        var edit_breed_id;

        var url="utils.php?edit_calf_id_id="+id;

      axios.get(url)
          .then(function (result) {


              $('#edit_calf_nick_name').val(result.data['nick_name']);
              $('#edit_calf_id').val(result.data['calf_id']);
              $('#edit_dob').val(result.data['dob']);
              $('#edit_birth_weight').val(result.data['birth_weight']);
              $('#edit_calf_record_id').val(result.data['calf_id']);

              edit_breed_id=result.data['breed_id'];
          })
          .catch(function (reason) {
              alert("An error has occurred");
          });


        var url2='utils.php?all_breeds=1';
        axios.get(url2)
            .then(function (res) {
                $('#edit_breed').empty();


                $.each(res.data,function (key,value) {

                    if (value[0]===edit_breed_id){
                        $('#edit_breed').append("<option value='"+value[0]+"' selected>"+value[1]+"</option>");

                    }else {
                        $('#edit_breed').append("<option value='" + value[0] + "'>" + value[1] + "</option>");
                    }
                });
                // console.log(res.data)
            })
            .catch(function (reason) {

            })
    }
</script>

</body>
</html>