<?php
require_once 'config.php';
$db=new DB_FACADE();

$cow_id=$_POST['cow'];
$milking_time=$_POST['milking_time'];
$amount=$_POST['litres_amount'];

if ($milking_time==1){
    $morning_milk_amount=$amount;
    $evening_milk_amount=null;
}else if ($milking_time==2){
    $morning_milk_amount=null;
    $evening_milk_amount=$amount;
}
$today=date('Y-m-d');

if (isset($_POST['submit'])){

    //determine whether there exist a record on the day so that you can update rather than create a new record
    $sql11="SELECT morning_amount,evening_amount FROM milking WHERE cow_id='".$cow_id."' AND date='".$today."'";
    $results11=mysqli_query($db->connect(),$sql11);
    $row11=mysqli_num_rows($results11);

    if ($row11==1){
        //there is an already existing record update the record depending on what time is selected
        if ($milking_time==1){
            //morning
//UPDATE `milking` SET `id`=[value-1],`cow_id`=[value-2],`morning_amount`=[value-3],`evening_amount`=[value-4],`date`=[value-5],`created_at`=[value-6],`updated_at`=[value-7] WHERE 1
       $sqli22="UPDATE milking SET morning_amount='".$amount."' WHERE cow_id='".$cow_id."' AND date='".$today."'";
       if ($db->connect()->query($sqli22)== true){

           echo '<script>
            window.location="index.php";
</script>';
       }else{
           echo 'error saving';
       }
        }else{
            //evening
            $sqli33="UPDATE milking SET evening_amount='".$amount."' WHERE cow_id='".$cow_id."' AND date='".$today."'";
            if ($db->connect()->query($sqli33)==true){
                echo '<script>
            window.location="index.php";
</script>';
            }else{
                echo 'error saving';

            }
        }

    }elseif ($row11>1){
        //error in the database since such a record should only appear once in the table
        //error very unlikely to happen
    }else{
        //no record exist hence create a new record
        //save the record in the database

        $sql="INSERT  INTO milking (cow_id,morning_amount,evening_amount,date) VALUES ('".$cow_id."','".$morning_milk_amount."','".$evening_milk_amount."','".$today."')";
        if($db->connect()->query($sql) == TRUE){
            echo '<script>
            window.location="index.php";
</script>';
    }



    }

}else{
        echo "error has occurred when  attempting to save the data. Please retry ";
}