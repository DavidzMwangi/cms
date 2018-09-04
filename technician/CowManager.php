<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 7/15/2018
 * Time: 3:07 PM
 */

class CowManager
{


    private  $db;
    public function __construct()
    {
        require_once 'config.php';
        $DB=new DB_FACADE();
        $this->db=$DB;
    }

    public function addCow($cow_id,$nick_name,$dob,$breed_id)
    {
        $sql="INSERT INTO cows (cow_id,nick_name,DOB, breed_id) VALUES ('".$cow_id."','".$nick_name."', '".$dob."','".$breed_id."')";

        if($this->db->connect()->query($sql) == TRUE){
            return true;

        }else{
            return false;
        }

        }

    public function updateCow($old_cow_id,$cow_id,$nickname,$dob,$breed_id)
    {
        $sql="UPDATE cows SET cow_id='".$cow_id."',nick_name='".$nickname."',DOB='".$dob."', breed_id='".$breed_id."' WHERE cow_id='".$old_cow_id."'";
        if($this->db->connect()->query($sql)){
            return true;
        }else{
            return false;
        }
    }
    public function availableCows()
    {

        $sql="SELECT * FROM cows WHERE deleted_at is null ";


        return mysqli_query($this->db->connect(),$sql);
    }

    public function breedResolver($breed_id)
    {
        $sql="SELECT name FROM breed WHERE id='".$breed_id."'";
        $query1=$this->db->connect()->query($sql);
        $row=$query1->num_rows;
        if ($row==1){
            $record=$query1->fetch_assoc();
            return $record['name'];
        }else{
            return null;
        }
    }

    public function singleCow($cow_id)
    {
        $sql="SELECT * FROM cows WHERE id='".$cow_id."'";


        $result=$this->db->connect()->query($sql);
//        $result=mysqli_query($this->db->connect(),$sql);
        $row=$result->num_rows;
        if ($row==1){
            $record=$result->fetch_assoc();
            return $record['breed_id'];
        }else{
            return null;
//                return '<span class="alert-danger">Unknown Cow</span>';
        }

    }
    public function deleteCow($id)

    {
        $now=date("Y-m-d h:i:s");
        $sql="UPDATE cows SET deleted_at='".$now."' WHERE id='".$id."'";
        if ($this->db->connect()->query($sql)){
            return true;
        }else{
            return false;
        }




    }


}
