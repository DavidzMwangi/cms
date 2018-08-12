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

require_once "config.php";
//                      $results=mysqli_query($db->connect(),$sql);

$DB=new DB_FACADE();

require_once 'MilkManager.php';

$data=new MilkManager();


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
if (isset($_POST['edit_submit'])){
    $edit_milk_record_id=$_POST['edit_milk_record_id'];
    $edit_morning_amount=$_POST['edit_morning_amount'];
    $edit_evening_amount=$_POST['edit_evening_amount'];
    $edit_cow_id=$_POST['edit_cow_id'];
    if ($data->editMilk($edit_milk_record_id,$edit_morning_amount,$edit_evening_amount,$edit_cow_id)){
        $edit_status=true;
    }else{
        //error occurred
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
                       if (isset($edit_status)){
                           if ($edit_status){
                               ?>
                               <!--                <div class="row">-->
                               <div class="col-offset-4 col-md-4 col-lg-4 col-sm-12  alert-success" >
                                   <h3>Record Edited successfully</h3>
                               </div>
                               <!--                </div>-->
                               <?php
                           }else{
                               ?>

                               <div class="row">
                                   <div class="col-md-4 alert-danger">
                                       <h3>Error editing the record</h3>
                                   </div>
                               </div>
                               <?php
                           }
                       }
                       ?>
                       <div class="row">
                           <div class="col-md-4 col-sm-12 col-lg-4">
                               <label for="cow_name">Cow ID</label>
                               <select id="cow_name" name="cow" class="form-control" required>
<!--                                   <option selected readonly>Select a cow</option>-->
                                   <?php
                                   $sql="SELECT cow_id,nick_name FROM cows ";
                                   $results=mysqli_query($DB->connect(),$sql);
                                   while ($row = mysqli_fetch_array($results)) {
                                       echo "<option value='$row[0]'>$row[0] <b>    Nickname: </b>$row[1]</option>";
                                   }


                                   ?>
                               </select>


                           </div>

                           <div class="col-md-4 col-sm-12 col-lg-4">
                               <label for="cow_name">Milking Time</label>
                               <select id="cow_name" name="milking_time" class="form-control" required>
<!--                                   <option selected disabled>Select Milking Time</option>-->
                                   <option value="1" >Morning</option>
                                   <option value="2">Evening</option>
                               </select>
                           </div>


                           <div class="col-md-4 col-sm-12 col-lg-4">
                               <label for="cow_name">Amount in litres</label>
                               <input class="form-control" placeholder="Milk Produced (ltrs)" name="litres_amount" type="number" min="0" step="any" required>
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

                    <h3>All Milk Records</h3>
            </div>

            <div class="card-body">


                <table id="table_id" class="display">
                    <thead>
                    <tr>
                        <th>Cow ID</th>
                        <th>Milking Date</th>
                        <th>Morning Amount(Litres)</th>
                        <th>Evening Amount(Litres)</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
<!--                    <td >'.$data->cowNameResolver($result['cow_id']).'</td>-->

                    <?php

                    $querty=$data->milkRecords();

                    while ($result=mysqli_fetch_array($querty)){
                        echo '<tr>
                        <td >'.$result['cow_id'].'</td>
                        <td>'.$result['date'].'</td>
                        <td>'.$result['morning'].'</td>
                        <td>'.$result['evening'].'</td>
                        <td>
                        
                      
                      <a href="#"><button class="btn btn-outline-primary"  onclick="getSelectedDetails('.$result['id'].','.$result['morning'].','.$result['evening'].')"  data-toggle="modal" data-target="#centralModalLGInfoDemo" >
                       Edit
                       </button>
                       </a> 
                         </td>
                        </tr>';
                    }
                       ?>

                    </tbody>
                </table>
<!--                <a href="#"><button class="btn btn-outline-danger" data-toggle="modal" data-target="#fluidModalBottomDangerDemo" >Delete</button></a>-->


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

            <form action="" method="post">
            <!--Body-->
            <div class="modal-body">

                <input type="hidden" id="edit_milk_record_id" name="edit_milk_record_id">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-12">
                       <label for="edit_cow_id">Cow Id</label>
                        <input type="text" name="edit_cow_id" class="form-control" id="edit_cow_id" required>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12">
                        <label for="morning_amount">Morning Amount</label>

                        <input type="number" id="morning_amount" name="edit_morning_amount" min="0" step="any" class="form-control" >
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12">
                       <label for="evening_amount">Evening Amount </label>
                        <input type="number" class="form-control" id="evening_amount" step="any" name="edit_evening_amount" min="0">

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

<div class="modal fade bottom" id="fluidModalBottomDangerDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-full-height modal-bottom modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Modal Danger</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
                </div>
                <ul class="list-group z-depth-0">
                    <li class="list-group-item justify-content-between">
                        Cras justo odio
                        <span class="badge badge-primary badge-pill">14</span>
                    </li>
                    <li class="list-group-item justify-content-between">
                        Dapibus ac facilisis in
                        <span class="badge badge-primary badge-pill">2</span>
                    </li>
                    <li class="list-group-item justify-content-between">
                        Morbi leo risus
                        <span class="badge badge-primary badge-pill">1</span>
                    </li>
                </ul>
            </div>

            <!--Footer-->
            <div class="modal-footer">
                <a role="button" class="btn btn-danger">Get it now
                    <i class="fa fa-diamond ml-1"></i>
                </a>
                <a role="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>
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
<script type="text/javascript" src="../assets/plugins/axios/axios.min.js"></script>

<script>

    $(document).ready(function () {
        $('#cow_name').select2();
        $('#table_id').DataTable({
            'pageLength':20
        });


    });

    function getSelectedDetails(milk_record_id,morning_amount,evening_amount) {

        $('#morning_amount').val(morning_amount);
        $('#evening_amount').val(evening_amount);
        $('#edit_milk_record_id').val(milk_record_id);
        // $('#cow_name').val(id)
        getEditRecord(milk_record_id);
    }

    function getEditRecord(id)
    {
        var url='utils.php?edit_milk_record_id='+id;

        axios.get(url)
            .then(function (res) {

                $('#edit_cow_id').val(res.data['cow_id']);
                // console.log(res.data)
            })
            .catch(function (reason) {
                alert("An error has occurred")
            })
    }
</script>

</body>
</html>