<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 8/12/2018
 * Time: 11:14 PM
 */

class NotificationManager
{

    private $DB;
    public function __construct()
    {
        require_once 'config.php';
        $db=new DB_FACADE();


        $this->DB=$db;
    }

    public function addNotification()
    {

        //first get the records that their is_active is true in calf weight milk
        $sql="SELECT * FROM calf_weight_milk WHERE is_active=true ";
        $query=$this->DB->connect()->query($sql);
        //get the records
        $results=array();
        while($rr=$query->fetch_array()){
            $results[]=$rr;
        }

//        create instance of calf manager in order to access week calculator
        require_once 'CalfManager.php';
        $cm=new CalfManager();

        //loop through the records determining if the week that is in the record is the same week as the current week.
        foreach ($results as $result){
            //determine the calf weight
            $db_calf_weeks=$cm->weekCalculator($result['calf_id']);
            if ($result['week']<$db_calf_weeks){
                //the db has no current week weight of the calf
                //create an instance of the notification if the record does not exist already
                if ($this->dublicatorAvoider($result['calf_id'])){
                    $sql11="INSERT INTO notifications(calf_id,is_read) VALUES ('".$result['calf_id']."',true)";
                    $this->DB->connect()->query($sql11);
                }

            }

        }
    }

    public function allActiveNotifications()
    {
        $sql="SELECT * FROM notifications WHERE is_read=true ";

        $query=$this->DB->connect()->query($sql);
        //return all the records

        return $query;
    }

    public function dublicatorAvoider($calf_id)
    {
        $sql="SELECT * FROM notifications WHERE calf_id='".$calf_id."' AND is_read=true";
        $results=$this->DB->connect()->query($sql);
        if ($results->num_rows>0){
            return false;
        }else{
            return true;
        }
    }

    public function notificationDisabler($calf_id)
    {
        $sql="SELECT * FROM notifications WHERE calf_id='".$calf_id."' AND is_read=true";
       $results= $this->DB->connect()->query($sql);

       if ($results->num_rows==1){
           $sql2="UPDATE notifications SET is_read=false WHERE calf_id='".$calf_id."'";
           $this->DB->connect()->query($sql2);

       }else if ($results->num_rows>1){
          //more than one record found. can hardly occur but incase it does occur,
            while ($row=$results->fetch_array()){
                $sql2="UPDATE notifications SET is_read=false WHERE calf_id='".$row['calf_id']."'";
                $this->DB->connect()->query($sql2);
            }


       }else{
           //no records found

       }
    }

}