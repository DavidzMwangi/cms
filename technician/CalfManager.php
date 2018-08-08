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
    public function addCalf($nick_name,$birth_weight,$dob,$breed,$cow_id){

        $sql="INSERT INTO calf (calf_id,nick_name,Birth_weight,breed_id,DOB) VALUES ('".$cow_id."','".$nick_name."','".$birth_weight."','".$breed."','".$dob."')";

       if( $this->db->connect()->query($sql)==true){
           return true;

       }else{
           return false;

       }


    }

    public function showCalf()
    {
        $sql="SELECT * FROM calf ";

        $query=$this->db->connect()->query($sql);

        return $query;

    }

    public function allCalves()
    {
        $sql="SELECT * FROM calf";

        return $this->db->connect()->query($sql);
//        return mysqli_query($this->db->connect(),$sql);

    }
    public function deleteCalf ($ID){

        $sql = "DELETE FROM calf WHERE id= '".$ID."'";
        if ( $this->db->connect()->query($sql)==true){
            return true;
        }else{
            return false;
        }

    }

    public function weekCalculator($calf_id)
    {
        //get the date today
        $today_date=date("m/d/Y");
        $calf=$this->calfRecord($calf_id)[3];
        $calf_dob=date("m/d/Y",strtotime($calf));


        $today_date = (string)$today_date;

        $today_f=DateTime::createFromFormat('m/d/Y',$today_date);
        $dob_f=DateTime::createFromFormat('m/d/Y',$calf_dob);

      return   floor($today_f->diff($dob_f)->days/7);


    }

    public function addCalfMilk($calf_id,$calf_weight)

    {


        $week=$this->weekCalculator($calf_id);
        $sq1l="SELECT * FROM calf_weight_milk WHERE calf_id='".$calf_id."' AND is_active=true";
        //check if the record is single or are several rows
        $result=$this->db->connect()->query($sq1l);
        if ($result->num_rows==1){
            $previous_week_record=$result->fetch_assoc();

        }else if ($result->num_rows>1){
            //unlikely to happen but in case it does select the last record that is in the result
            $num_rows=$result->num_rows;
            $all_records=$result->fetch_array();
//            $previous_week_record=end($all_records);
            $previous_week_record=array_pop($all_records);

        }else{
            //no record is found meaning the calf has completed the period of being given milk or its the new instance of the calf
            $sql5="SELECT * FROM calf_weight_milk WHERE calf_id='".$calf_id."'";
            $result11=$this->db->connect()->query($sql5);
            if ($result11->num_rows>0){
                return 3; //3 means the calf has completed the period of being given milk

            }else{
                // its the first time the calf has been created in the table
                $new_milk_amount=$calf_weight*0.1;

                $sql6="INSERT INTO calf_weight_milk (calf_id,calf_weight,week,milk_amount,is_active) VALUES ('".$calf_id."','".$calf_weight."','".$week."','".$new_milk_amount."',true)";
                $this->db->connect()->query($sql6);
                return 1;
            }
        }


        //dealing with the milk amount now
        if ((int)$previous_week_record['milk_amount']>0){

            $sql2="UPDATE calf_weight_milk SET is_active=false WHERE id='".$previous_week_record['id']."'";

            $this->db->connect()->query($sql2);
            if ($previous_week_record['week']<=7){
                //new instance of the calf milk
                $new_milk_amount=$calf_weight*0.1;
                $sql3="INSERT INTO calf_weight_milk (calf_id,calf_weight,week,milk_amount,is_active) VALUES ('".$calf_id."','".$calf_weight."','".$week."','".$new_milk_amount."',true)";
                $this->db->connect()->query($sql3);

            }else{
                $new_milk_amount=$previous_week_record['milk_amount']-1;
                $sql4="INSERT INTO calf_weight_milk (calf_id,calf_weight,week,milk_amount,is_active) VALUES ('".$calf_id."','".$calf_weight."','".$week."','".$new_milk_amount."',true)";
                $this->db->connect()->query($sql4);

            }


        }else{
            //milk_amount is 0 and calf has finished taking milk

            $sql2="UPDATE calf_weight_milk SET is_active=false WHERE id='".$previous_week_record['id']."'";

            $this->db->connect()->query($sql2);

            return 3;

        }

        return 1;// the process is successfully completed
    }

    public function activeCalfMilkRecords()
    {
        $sql="SELECT * FROM calf_weight_milk WHERE is_active=true";
        return $this->db->connect()->query($sql);
    }

    public function calfRecord($calf_id)
    {
        $sql="SELECT * FROM calf WHERE calf_id='".$calf_id."'";
        $query=$this->db->connect()->query($sql);

        $result=$query->fetch_row();
        return $result;
    }
}