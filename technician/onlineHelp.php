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
    <link rel="stylesheet" type="text/css" href="../assets/plugins/DataTables/datatables.css">


</head>

<body>
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

                    <h3> Online Help</h3>
                    <hr>
                </div>

                <div class="card-body">

<!--                    <iframe src="../technician/aula1.pdf" height="500" width="500"></iframe>-->
                    <embed src="technician%20manual.pdf" type="application/pdf" class="col-md-12 col-lg-12" height="800">


                </div>
<!--                    <object data="aula1.pdf" type="application/pdf" >-->
<!--                        alt : <a href="aula1.pdf">html tutorial pdf</a>  <!this embeds a pdf file in html  !>-->
<!--                    </object>-->


                </div>
            </div>

        </div>
    </div>


<!-- js scripts -->
<script src="js/jquery.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/main.js"></script>
<script type="text/javascript" charset="utf8" src="../assets/plugins/DataTables/datatables.js"></script>

</body>
</html>