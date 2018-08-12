<?php

$conn = new PDO("mysql:host=localhost;dbname=cms", "root", "");
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
if (isset($_GET['q'])){
    $month = $_GET['q'];//7
}else{
    $month = date("m")-1;
}

$sql ="select avg(morning) as morning, avg(evening) as evening, cow_id 
from milk_records where MONTH(date) = '".$month ."' group by cow_id";



$result = $conn->query($sql);

// $data = array_merge($result->fetchAll(),$conn->query($sql2)->fetchAll());
echo json_encode($result->fetchAll(), false);