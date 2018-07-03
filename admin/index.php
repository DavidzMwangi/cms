<?php
session_start();
include_once '../login/User.php';
$user = new User;

// if ($user->isloggedIn()){
//     header("location:../login.php");
// }
if(!(isset($_SESSION['id']) && $_SESSION['id']>0)){
    header("location:../login.php");
}else{
    if (!$user->isAdmin()){
        header("location:../technician/index.php");
    }
}

?>
<html>

<head>
    <title>Dashboard</title>

</head>

<body>
<div class="form">
    <h1>Welcome <?//php $id = $_SESSION['id']; $user->fullname($id);?></h1>
    
</div>
</body>

</html>


