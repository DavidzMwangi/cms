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

                <li><a href="">Dashboard</a></li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
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