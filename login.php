<?php
session_start();
//session_destroy();
require_once 'login/User.php';
$user = new User;
if ($user->isloggedIn()) {
    if ($user->isAdmin())
        header("location:admin/index.php");
    else
        header("location:technician/index.php");
}

if (isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $login = $user->login($_REQUEST['email'], $_REQUEST['password']);
        $user = new User;
        if ($user->isloggedIn()) {
            
            if($user->isAdmin()){
                header("location:admin/index.php");
            }
            else{
                header("location:technician/index.php");
            }
        } else {
            $errors[] = "Sign in failed, Check your  credentials";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">


    <title>Log in</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">-->
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?php
            if (isset($errors)) {
                foreach ($errors as $error) {
                    ?>
                    <div class="alert alert-danger">
                        <h6><?= $error ?></h6>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="card">

                <div class="card-body">
                    <form class="form-signin" method="post">
                        <h2 class="form-signin-heading">Please Sign in</h2>

                        <div class="form-group">
                            <input type="text" id="inputEmail" class="form-control" placeholder="Email address"
                                   name="email" required autofocus>

                        </div>
                        <div class="form-group">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password"
                                   name="password" required>
                        </div>
                        <div>
                            <button class="btn btn     </button>
                        </div>
                  -lg btn-primary btn-block" type="submit" name="submit">Sign in
                         </form>

                </div>
            </div>
        </div>
    </div>


</body>
</html>
