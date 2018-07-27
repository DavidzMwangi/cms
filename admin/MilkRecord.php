<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 7/26/2018
 * Time: 11:30 PM
 */

class MilkRecord
{
        private $DB;
    public function __construct()
    {
        require_once "../technician/config.php";
        $db=new DB_FACADE();

        $this->DB=$db;

    }

    public function monthlyRecords()
    {

//        $today=date('Y-m-d');
            $sql="SELECT * FROM milk_records";

        require_once '../login/dbconfig.php';
        $db = new DB();
        $conn = $db->getCon();
        $conn = new PDO("mysql:host=localhost;dbname=cms", "root", "");
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


        $result=$conn->query($sql);
        $records=$result->fetchAll();
        $extra=array();
        foreach ($records as $record){

            $ends[]=$record;
        }
            return $ends;

    }

    public function monRec()
    {
        //$query = "select *  from milk_records where YEAR(date)='" . $year . "' and MONTH(date)='" . $month ."' and isMilked = true";
        //loop through getting all the months
        $year=date('Y');
        for ($i=0; $i<=11;$i++){
            //run the sql code to get the records of that month
            $sql_month="SELECT cow_id,morning,evening FROM milk_records WHERE YEAR(date)='".$year."' and MONTH(date)='".($i+1)."' and isMilked=true ";

            //get the records
            $query=mysqli_query($this->DB->connect(),$sql_month);
            $results=mysqli_fetch_array($query);

        }
    }

}