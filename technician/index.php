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
    
</head>
<body>
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

               <div class="row">
                   <div class="col-md-12 col-lg-12 col-sm-12">

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
</body>
</html>