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
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>

<body>
<div class="form">
    <h1>Welcome <?php $user->fullname($id);?></h1>
    <p align="right"><a href="?q=logout">LOGOUT</a></p>
</div>
</body>

</html>


