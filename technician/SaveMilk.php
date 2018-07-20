<?php


class SaveMilk{
    private $cow_id;
    private $milking_time;
    private $amount;
    private $db;
    public function __construct($cow_id,$milking_time,$amount)
    {
        $this->cow_id=$cow_id;
        $this->milking_time=$milking_time;
        $this->amount=$amount;

//        require_once 'config.php';
        $this->db=new DB_FACADE();

    }

    public function saveMilk(){
        $today=date('Y-m-d');
        if ($this->milking_time==1){
            $morning_milk_amount=$this->amount;
            $evening_milk_amount=null;
        }else if ($this->milking_time==2){
            $morning_milk_amount=null;
            $evening_milk_amount=$this->amount;
        }else{
            return false;
        }

        //determine whether there exist a record on the day so that you can update rather than create a new record
        $sql11="SELECT morning_amount,evening_amount FROM milking WHERE cow_id='".$this->cow_id."' AND date='".$today."'";
        $results11=mysqli_query($this->db->connect(),$sql11);
        $row11=mysqli_num_rows($results11);

        if ($row11==1){
            //there is an already existing record update the record depending on what time is selected
            if ($this->milking_time==1){
                //morning
                $sqli22="UPDATE milking SET morning_amount='".$this->amount."' WHERE cow_id='".$this->cow_id."' AND date='".$today."'";
                if ($this->db->connect()->query($sqli22)== true){

                   return true;
                }else{
                    return false;
                }
            }else{
                //evening
                $sqli33="UPDATE milking SET evening_amount='".$this->amount."' WHERE cow_id='".$this->cow_id."' AND date='".$today."'";
                if ($this->db->connect()->query($sqli33)==true){
                    return true;
                }else{
                    return false;

                }
            }

        }elseif ($row11>1){
            //error in the database since such a record should only appear once in the table
            //error very unlikely to happen
        }else{
            //no record exist hence create a new record
            //save the record in the database

            $sql="INSERT  INTO milking (cow_id,morning_amount,evening_amount,date) VALUES ('".$this->cow_id."','".$morning_milk_amount."','".$evening_milk_amount."','".$today."')";
            if($this->db->connect()->query($sql) == TRUE){
                return true;
            }else{return false;}



        }

        return true;
    }


}
