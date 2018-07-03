<?php
// session_start();

require_once 'dbconfig.php';

class User
{
    private $con;
    private static $user = null;

    public function __construct()
    {
        $db = new DB;
        $this->con = $db->getCon();
    }

    public static function getInstance(){
       return new User;
    }


    public function login($email, $pass)
    {
        $pass = md5($pass);
        $check = mysqli_query($this->con, "Select * from users where email='$email' and password='$pass'");
        $data = mysqli_fetch_array($check);
        $result = mysqli_num_rows($check);
        if ($result == 1) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $data['id'];
            if ($data['USER_TYPE'] == 0) {
                $_SESSION['user_type'] = 'technician';
            } else {
                $_SESSION['user_type'] = 'admin';

            }
            return true;
        } else {
            return false;
        }
    }

    public function isAdmin(){
        return $_SESSION['user_type'] == 'admin';
    }

    public function redirect(){
        if($this->isAdmin()){
            return  header("location:admin/index.php");
        }else{
            return header("location:technician/index.php");
        }
    }


    public function fullname($id)
    {
        $result = mysqli_query($this->con, "Select * from users where id='$id'");
        $row = mysqli_fetch_array($result);
        echo $row['name'];
    }

    public function isloggedIn()
    {
        if (isset($_SESSION['id'])) {
            return $_SESSION['id'] > 0;
        }
        return false;
    }

    public function logout()
    {
        $_SESSION['login'] = false;
        session_destroy();
    }
}

?>