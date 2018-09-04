<nav class="navbar navbar-expand-lg navbar-dark rounded" style="background-color: #6d7fcc;">
    <div class="container-fluid">

        <span id="sidebarCollapse" style="cursor: pointer;"><i class="fa fa-bars fa-2x mr-2 text-light" ></i></span>

        <a class="navbar-brand" href="#"><h3>Admin</h3></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>

            </ul>
            <a href="adminOnlineHelp.php"  class="btn btn-outline-light m-1 ">Online Help</a>

            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#logoutModal">Logout</a>

        </div>
    </div>
</nav>

<div class="modal fade bottom" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-full-height modal-bottom modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->

            <div class="modal-header">
                <p class="heading lead">Logout</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <p>Do you want to logout?</p>
            </div>
            <div class="modal-footer">
                <a href="../logout.php" class="btn btn-danger"  >Yes

                </a>
                <a role="button" class="btn btn-danger waves-effect" data-dismiss="modal">No, thanks</a>
            </div>

            <!--/.Content-->

        </div>
    </div>

</div>

