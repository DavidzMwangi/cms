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
?>