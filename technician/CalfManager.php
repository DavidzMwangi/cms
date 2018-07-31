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

    public function allCalves()
    {
        $sql="SELECT * FROM calf";

        return mysqli_query($this->db->connect(),$sql);

    }
    public function deleteCalf ($ID){

        $sql = "DELETE FROM calf WHERE id= '".$ID."'";
        if ( $this->db->connect()->query($sql)==true){
            return true;
        }else{
            return false;
        }

    }

}