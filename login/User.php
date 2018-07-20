<?php
require_once 'dbconfig.php';

class User
{
    private $con;

    public function __construct()
    {
        $db = new DB;
        $this->con = $db->getCon();
    }

    public function login($username, $pass)
    {
        $pass = md5($pass);
        $result = mysqli_query($this->con, "Select * from users where username='$username' and password='$pass'");
//        $data = mysqli_fetch_array($check);
//        $result = mysqli_num_rows($check);
//        if ($result == 1) {
//            $_SESSION['login'] = true;
//            $_SESSION['id'] = $data['id'];
//            if ($data['USER_TYPE'] == 0) {
//                $_SESSION['user_type'] = 'technician';
//            } else {
//                $_SESSION['user_type'] = 'admin';
//            }
//            return true;
//        } else {
//            return false;
//        }

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);

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

    public function isAdmin()
    {
        return $_SESSION['user_type'] == 'admin';
    }

    public function fullname($id)
    {
        $result = mysqli_query($this->con, "Select * from users where id='$id'");
        $row = mysqli_fetch_array($result);
        echo $row['name'];
    }

    public function session()
    {
        if (isset($_SESSION['login'])) {
            return $_SESSION['login'];
        }
    }

    public function logout()
    {
        $_SESSION['login'] = false;
        session_destroy();
    }

    public function isloggedIn()
    {
        if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
            return true;
        }
        return false;
    }
}

?>
