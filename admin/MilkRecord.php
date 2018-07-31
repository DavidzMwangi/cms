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

    public function totalMonthMilk()
    {
        $year=date('Y');
        $month_values=array();
        for ($i=1;$i<=12;$i++){
            $sql="SELECT avg(morning) as morning, avg(evening) as evening  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$i."'";

            $result=$this->DB->connect()->query($sql);
            if ($result->num_rows==1){
                $row=$result->fetch_assoc();
                $month_values[]= number_format(($row["morning"]+$row["evening"]));

            }else{
                $month_values[]= 0;
            }





        }
        return json_encode($month_values,JSON_NUMERIC_CHECK);

    }

    public function monthlyHerds()
    {
        $year=date('Y');
        $month_herds=array();
        for ($i=1;$i<=12;$i++){
            $sql="SELECT  COUNT(DISTINCT(cow_id)) as cow_id  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$i."'";

            $result=$this->DB->connect()->query($sql);
            if ($result->num_rows==1){
                $row=$result->fetch_assoc();
                $month_herds[]= $row['cow_id'];

            }else{
                $month_herds[]= 0;
            }

        }
        return json_encode($month_herds,JSON_NUMERIC_CHECK);
    }

    public function monthlySum($month)
    {
        $year=date('Y');
        $sql="SELECT sum(morning) as morning,sum(evening) as evening FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$month."'";

        $result=$this->DB->connect()->query($sql);
        if ($result->num_rows==1){
            $row=$result->fetch_assoc();

            $month_sum=$row['morning']+$row['evening'];

            return $month_sum;
        }else{
            return 0;
        }

    }
    public function monRec($month)
    {

        $year=date('Y');
        $month_name=null;

//        for ($i=1;$i<=12;$i++){
            switch ($month){
                case 1:
                    $sql_months="SELECT avg(morning) as morning, avg(evening) as evening, COUNT(DISTINCT(cow_id)) as cow_id  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$month."'";
                    $month_name="January";
                    break;

                case 2:
                    $sql_months="SELECT avg(morning) as morning, avg(evening) as evening, COUNT(DISTINCT(cow_id)) as cow_id  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$month."'";
                    $month_name="February";

                    break;
                case 3:
                    $sql_months="SELECT avg(morning) as morning, avg(evening) as evening, COUNT(DISTINCT(cow_id)) as cow_id  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$month."'";
                    $month_name="March";

                    break;
                case 4:
                    $sql_months="SELECT avg(morning) as morning, avg(evening) as evening, COUNT(DISTINCT(cow_id)) as cow_id  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$month."'";
                    $month_name="April";

                    break;
                case 5:
                    $sql_months="SELECT avg(morning) as morning, avg(evening) as evening, COUNT(DISTINCT(cow_id)) as cow_id  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$month."'";
                    $month_name="May";

                    break;
                case 6:
                    $sql_months="SELECT avg(morning) as morning, avg(evening) as evening, COUNT(DISTINCT(cow_id)) as cow_id  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$month."'";
                    $month_name="June";

                    break;
                case 7:
                    $sql_months="SELECT avg(morning) as morning, avg(evening) as evening, COUNT(DISTINCT(cow_id)) as cow_id  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$month."'";
                    $month_name="July";

                    break;
                case 8:
                    $sql_months="SELECT avg(morning) as morning, avg(evening) as evening, COUNT(DISTINCT(cow_id)) as cow_id  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$month."'";
                    $month_name="August";

                    break;
                case 9:
                    $sql_months="SELECT avg(morning) as morning, avg(evening) as evening, COUNT(DISTINCT(cow_id)) as cow_id  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$month."'";
                    $month_name="September";

                    break;
                case 10:
                    $sql_months="SELECT avg(morning) as morning, avg(evening) as evening, COUNT(DISTINCT(cow_id)) as cow_id  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$month."'";
                    $month_name="October";

                    break;
                case 11:
                    $sql_months="SELECT avg(morning) as morning, avg(evening) as evening, COUNT(DISTINCT(cow_id)) as cow_id  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$month."'";
                    $month_name="November";

                    break;
                case 12:
                    $sql_months="SELECT avg(morning) as morning, avg(evening) as evening, COUNT(DISTINCT(cow_id)) as cow_id  FROM milk_records WHERE YEAR(date)='".$year."' AND MONTH(date)='".$month."'";
                    $month_name="December";

                    break;
//            }
        }

        $result=$this->DB->connect()->query($sql_months);

        if ($result->num_rows>0){

            while ($row=$result->fetch_assoc()){
//
                return "<tr>

                        <td>".$month_name."</td>
                        <td>".$row['cow_id']."</td>
                        <td>".number_format($this->monthlySum($month),2)."</td>
                        <td>".number_format($row['morning'],2)."</td>
                        <td>".number_format($row['evening'],2)."</td>
                        <td>".number_format(($row['morning']+ $row['evening'])/2,2)."</td>
                    </tr>";
            }

        }


    }

}