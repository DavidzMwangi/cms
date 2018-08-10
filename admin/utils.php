<?php

require_once '../technician/config.php';
$DB=new DB_FACADE();
if (isset($_GET['specific_date_milk'])){
    $date=$_GET['specific_date_milk'];

    $sql="SELECT * FROM milk_records WHERE date LIKE '%".$date."%'";
    $query=$DB->connect()->query($sql);

    $results=$query->fetch_all();
    echo json_encode($results);
}

?>