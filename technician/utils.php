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
    echo "kimoda";
}
?>