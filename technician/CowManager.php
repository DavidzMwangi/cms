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

    public function addCow($nick_name,$dob,$breed_id)
    {
        $sql="INSERT INTO cows (nick_name,DOB, breed_id) VALUES ('".$nick_name."', '".$dob."','".$breed_id."')";

        if($this->db->connect()->query($sql) == TRUE){
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
            return ' ';
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
}