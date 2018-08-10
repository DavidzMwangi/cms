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

    public function updateCow($cow_id,$nickname,$dob,$breed_id)
    {
        $sql="UPDATE cows SET nick_name='".$nickname."',DOB='".$dob."', breed_id='".$breed_id."' WHERE cow_id='".$cow_id."'";
        if($this->db->connect()->query($sql)){
            return true;
        }else{
            return false;
        }
    }
    public function availableCows()
    {

        $sql="SELECT * FROM cows";


        return mysqli_query($this->db->connect(),$sql);
    }

    public function breedResolver($breed_id)
    {
        $sql="SELECT name FROM breed WHERE id='".$breed_id."'";

        $query=mysqli_query($this->db->connect(),$sql);

        $row=mysqli_num_rows($query);
        if ($row==1){
            $record=mysqli_fetch_assoc($query);
            return $record['name'];
        }else{
            return null;
        }
    }

    public function singleCow($cow_id)
    {
        $sql="SELECT * FROM cows WHERE id='".$cow_id."'";

        $result=mysqli_query($this->db->connect(),$sql);
        $row=mysqli_num_rows($result);
        if ($row==1){
            $record=mysqli_fetch_assoc($result);
            return $record['breed_id'];
        }else{
            return null;
//                return '<span class="alert-danger">Unknown Cow</span>';
        }

    }
    public function deleteCow($id)

    {
        $sql = "DELETE FROM cows WHERE id='".$id."'";
        if($this->db->connect()->query($sql)==true){
            return true;
        }else {
            return false;
        }


    }

//    public function deleteCalf ($ID){
//
//        $sql = "DELETE FROM calfs WHERE id= '".$ID."'";
//        if ( $this->db->connect()->query($sql)==true){
//            return true;
//        }else{
//            return false;
//        }
//
//    }
}
