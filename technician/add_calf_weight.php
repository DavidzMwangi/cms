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
require_once "CalfManager.php";
$calf_manager=new CalfManager();


if (isset($_POST['submit'])){



//    $data=$_POST['week'];
//    $week=substr($data,strpos($data,"W")+1);


    $calf_id=$_POST['calf_id'];
    $calf_weight=$_POST['calf_weight'];

  switch ($calf_manager->addCalfMilk($calf_id,$calf_weight)){
      case 1:
          $status=1;
          break;
      case 3:
          $status=3;
          break;
      default:
          $status=5;//error
          break;
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

                    <h3>Add Weekly Calf Weight</h3>
                    <hr>
                </div>

                <div class="card-body">


                    <form action="" method="post">

                        <?php
                        if (isset($status)){
                            if ($status==1){
                                ?>
                                <!--                <div class="row">-->
                                <div class="col-offset-4 col-md-4 col-lg-4 col-sm-12  alert-success" >
                                    <h3>Record Saved successfully</h3>
                                </div>
                                <!--                </div>-->
                                <?php
                            }else if ($status==3){
                                ?>

                                <div class="row">
                                    <div class="col-md-4 alert-danger">
                                        <h3>The calf has already completed the period of being given milk</h3>
                                    </div>
                                </div>
                                <?php
                            }else if ($status==5){
                                ?>

                                <div class="row">
                                    <div class="col-md-4 alert-danger">
                                        <h3>The calf has already completed the period of being given milk</h3>
                                    </div>
                                </div>
                                <?php
                            }
                        }

                        ?>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-lg-4">
                                <label for="calf_id">Calf ID</label>
                                <select id="calf_id" name="calf_id" class="form-control" required>
                                    <option selected disabled>Select a calf</option>
                                    <?php
//                                    $sql="SELECT cow_id,nick_name FROM cows ";
//                                    $results=mysqli_query($DB->connect(),$sql);
                                    $results=$calf_manager->allCalves();
                                    while ($row = mysqli_fetch_array($results)) {
                                        echo "<option value=".$row['calf_id'].">$row[1] <b>    Nickname: </b>$row[1]</option>";
                                    }
//
//
//                                    ?>
                                </select>


                            </div>

<!--                            <div class="col-md-4 col-sm-12 col-lg-4">-->
<!--                                <label for="week">Week</label>-->
<!--                                <input type="week" class="form-control" id="week" name="week">-->
<!---->
<!--                            </div>-->


                            <div class="col-md-4 col-sm-12 col-lg-4">
                                <label for="calf_weight">Calf Weight</label>
                                <input class="form-control" placeholder="Calf Weight" name="calf_weight" type="number" min="0" required>
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
        $('#table_id').DataTable({
            'pageLength':20
        });


    });


</script>

</body>
</html>