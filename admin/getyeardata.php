<?php

$conn = new PDO("mysql:host=localhost;dbname=cms", "root", "");
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$sql = "SELECT avg(morning) as morning, avg(evening) as evening, MONTH (date) as month FROM milk_records  GROUP by MONTH (date)";

$result = $conn->query($sql);
echo json_encode($result->fetchAll(), false);