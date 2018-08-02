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
            echo false;
        }


    }
}