<?php

if (isset($_GET['q'])){
    $date = $_GET['q']; //2018-07-10 date format
}else{
    $date = date("Y-m-d");
}

$conn = new PDO("mysql:host=localhost;dbname=cms", "root", "");
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$sql = "SELECT * FROM milk_records WHERE DATE(date)= '$date'";

$result = $conn->query($sql);
echo json_encode($result->fetchAll(), false);

