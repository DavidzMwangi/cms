<?php
/**
 * Created by PhpStorm.
 * User: Muntaz
 * Date: 7/17/2018
 * Time: 9:38 AM
 */

class CalfManager
{
    private $db;
    public function __construct()
    {
        require_once "config.php";
        $DB=new DB_FACADE();
        $this->db=$DB;
    }
    public function addCalf(){


    }
}