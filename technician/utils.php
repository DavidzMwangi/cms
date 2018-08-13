<?php

function databaseConnector(){
    require_once  'config.php';
   return new DB_FACADE();
}

require_once  'config.php';
$DB=new DB_FACADE();
if (isset($_GET['calf_id'])){
    //get the records that belong to that cow
    $sql="SELECT * FROM calf_weight_milk WHERE calf_id='".$_GET['calf_id']."'";

   $result= $DB->connect()->query($sql);
   if ($result->num_rows>0){
       $records=$result->fetch_all();
       echo json_encode($records);

   }else{
       echo json_encode(null);

   }
//    echo $_GET['calf_id'];
}else{
    echo null;
}


if (isset($_GET['edit_cow_id'])){

    //get the record of the cow
    $sql22="SELECT * FROM cows WHERE id='".$_GET['edit_cow_id']."'";


    $result1=$DB->connect()->query($sql22);
    if ($result1->num_rows>0){
        $records1=$result1->fetch_assoc();
        echo json_encode($records1);
    }else{
        echo json_encode(null);
    }

}

if (isset($_GET['edit_milk_record_id'])){
    $milk_record_id=$_GET['edit_milk_record_id'];
    $sql33="SELECT * FROM milk_records WHERE id='".$milk_record_id."'";

    $result33=$DB->connect()->query($sql33);
    $record33=$result33->fetch_assoc();

    echo json_encode($record33);
}

if (isset($_GET['all_breeds'])){
    $sql44="SELECT id,name FROM breed";
    $result44=$DB->connect()->query($sql44);

    echo  json_encode($result44->fetch_all());
}

if (isset($_GET['edit_calf_id_id'])){

    $id_id=$_GET['edit_calf_id_id'];

    $sql55="SELECT * FROM calf WHERE id='".$id_id."'";

   $query55= $DB->connect()->query($sql55);
   echo json_encode($query55->fetch_assoc());
}


if (isset($_GET['notification_to_toggle'])){
    $id=$_GET['notification_to_toggle'];

    $sql66="UPDATE notifications SET is_read=false WHERE id='".$id."'";
    $query66=$DB->connect()->query($sql66);

    echo json_encode($query66->fetch_assoc());

}
?>