<?php

/**
 * Created by PhpStorm.
 * User: Muntaz
 * Date: 7/24/2018
 * Time: 8:47 AM
 */
class TechnicianManager
{
    private $DB;

    public function __construct()
    {
        require_once "../technician/config.php";
        $db = new DB_FACADE();
        $this->DB = $db;

    }

    public function addTechnician($username, $password)
    {
        $u = 0;
        $password = md5($password);
        $sql = "INSERT INTO users (username,password,user_type)VALUES ('" . $username . "','" . $password . "','" . $u . "')";

        if ($this->DB->connect()->query($sql) == true) {
            return true;
        } else {
            return false;
        }


    }

    public function allTechnicians()
    {
        $sql="SELECT * FROM users WHERE user_type=0";
        return $this->DB->connect()->query($sql);
    }

    public function deleteTechnician($technican_id)
    {
        $sql="DELETE FROM users where id='".$technican_id."'";
        if ($this->DB->connect()->query($sql)){
            return true;
        }else{
            return false;
        }
    }

    public function changePassword($id,$new_password)
    {
        $password=md5($new_password);
        $sql="UPDATE users SET password='".$password."' WHERE id='".$id."'";

        if ($this->DB->connect()->query($sql)){
            return true;
        }else{
            return false;
        }
    }
}