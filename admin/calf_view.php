<!--<!DOCTYPE html>-->
<?php
//session_start();
//include_once '../login/user.php';
//$user = new User;
//$id = $_SESSION['id'];
//if (!$user->session()){
//    header("location:../login.php");
//}
//else{
//    if (!$user->isAdmin()){
//        header("location:../index.php");
//    }
//}//if (isset($_REQUEST['q'])){
//    $user->logout();
//    header("location:login.php");
//}

 require_once "../technician/CowManager.php";
$cow_manager=new CowManager();

require_once "../technician/CalfManager.php";
$calf_manager=new CalfManager();


if (isset($_POST['delete_submit'])){
    $id= $_POST['delete_calf'];
    if ($calf_manager->deleteCalf($id)){
        $status_delete= true;

    }else{
        $status_delete= false;

    }
}

//?>
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
    require_once "sidebar.php";
    ?>
    <!-- page content -->
    <div id="content" class="w-100 ml-2">

        <?php
        require_once "nav.php";
        ?>


        <div class="container-fluid">


            <div class="card mt-5">


                <div class="card-header">
                    <h3>All Calfs</h3>
                </div>
                <div class="card-body">

                    <table id="table_id" class="display">
                        <thead>
                        <tr>
                            <th> NickName</th>
                            <th>Calf_Id</th>
                            <th>Birth Weight</th>
                            <th>Breed</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

//                        $result66=$cow_manager->availableCows();

                            $result=$calf_manager->allCalves();
                        while($row=$result->fetch_array()){
                            echo '<tr>
                      <td >'.$row['nick_name'].'</td>
                        <td>'.$row['calf_id'].'</td>
                        <td>'.$row['birth_weight'].'</td>
                        <td>'.$cow_manager->breedResolver($row['id']).'</td>
                       <td>
                       <a href="#"><button class="btn btn-outline-danger" data-toggle="modal" onclick="deleteF('.$row['id'].')" data-target="#centralModalLGInfoDemo"  >delete</button></a>
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
<div class="modal fade bottom" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-full-height modal-bottom modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <form action="" method="post">
                <div class="modal-header">
                    <p class="heading lead">delete</p>
                    <input type="hidden" id="delete_calf" name="delete_calf">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <h3>Do you want to delete this cow?</h3>

                    <div class="modal-footer">
                        <button class="btn btn-danger" name="delete_submit" type="submit">delete

                        </button>
                        <a role="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>
                    </div>
                </div>
                <!--/.Content-->
            </form>
        </div>
    </div>


    <!-- js scripts -->
    <script src="../assets/js/jquery.slim.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/d3.v5.min.js"></script>
    <script src="../assets/js/c3.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script type="text/javascript" charset="utf8" src="../assets/plugins/DataTables/datatables.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_id').DataTable({

            });


        });

        function deleteF(id) {

            $('#delete_calf').val(id)
        }
    </script>
</body>

</html>