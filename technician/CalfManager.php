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
    public function addCalf($nick_name,$birth_weight,$dob,$breed){

        $sql="INSERT INTO calf (nick_name,Birth_weight,breed_id,DOB) VALUES ('".$nick_name."','".$birth_weight."','".$breed."','".$dob."')";

       if( $this->db->connect()->query($sql)==true){
           return true;

       }else{
           return false;

       }


    }

    public function showCalf()
    {
        $sql="SELECT * FROM calf ";

        $query=mysqli_query($this->db->connect(),$sql);

        return $query;

    }
}