<?php
class MilkManager{

        private  $db;

    public function __construct()
    {
        require_once 'config.php';
        $db=new DB_FACADE();

        $this->db=$db;
    }


    public function milkRecords()
    {
        $today=date('Y-m-d');

        return mysqli_query($this->db->connect(),"SELECT * FROM milk_records WHERE date='".$today."'");


    }

    public function SingleDailyMilkRecords()
    {
        $today=date('Y-m-d');

        $sql="SELECT * FROM milk_records WHERE date='".$today."'";
        return $this->db->connect()->query($sql);


    }
    public function cowNameResolver($cow_id)
    {
        $sql="SELECT nick_name FROM cows WHERE cow_id='".$cow_id."' ";
        $query=mysqli_query($this->db->connect(),$sql);
        $row=mysqli_num_rows($query);
        if ($row==1){
            $record=mysqli_fetch_assoc($query);
                return $record['nick_name'];
        }else{
                return ' ';
//                return '<span class="alert-danger">Unknown Cow</span>';
        }
    }

    public function editMilk($milk_record_id,$morning_amount,$evening_amount,$cow_id)
    {
        $sql="UPDATE milk_records SET evening='".$evening_amount."' ,morning='".$morning_amount."', cow_id='".$cow_id."' WHERE id='".$milk_record_id."'";
        if ($this->db->connect()->query($sql)==true){
            return true;
        }else{
            return false;

        }
    }

    public function deleteMilkRecord()
    {
        echo "deleting";
    }
}