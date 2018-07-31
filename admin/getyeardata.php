<?php

$conn = new PDO("mysql:host=localhost;dbname=cms", "root", "");
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$sql = "SELECT avg(morning) as morning, avg(evening) as evening, MONTH (date) as month
       FROM milk_records  GROUP by MONTH (date)";

$sql2 = "select count(morning) as herdCount from milk_records  GROUP by MONTH (date)";

$result = $conn->query($sql);
$result2 = $conn->query($sql2);


echo json_encode($result->fetchAll(), false);