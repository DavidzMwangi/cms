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
        return mysqli_query($this->db->connect(),"SELECT * FROM milking");
    }

    public function cowNameResolver($cow_id)
    {
        $sql="SELECT nick_name FROM cows WHERE id='".$cow_id."' ";
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
}