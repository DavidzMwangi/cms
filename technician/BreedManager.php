<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 7/15/2018
 * Time: 11:40 AM
 */

class BreedManager
{

        private $db;
    public function __construct()
    {
        require_once 'config.php';
        $DB=new DB_FACADE();
        $this->db=$DB;
    }

    public function allBreeds()
    {

        $sql="SELECT id,name FROM breed WHERE deleted_at IS NULL ";
        return $this->db->connect()->query($sql);
        
    }

    public function saveBreed($name)
    {
        $sql="INSERT INTO breed (name) VALUE ('".$name."')";



        return $this->db->connect()->query($sql);
    }

    public function deleteBreed($breed_id)
    {
        $now=date("Y-m-d h:i:s");
        $sql="UPDATE breed SET deleted_at='".$now."' WHERE id='".$breed_id."'";
        if ($this->db->connect()->query($sql)){
            return true;
        }else{
            return false;
        }
    }
}