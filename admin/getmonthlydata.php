<?php

//db connection
require_once '../login/dbconfig.php';
$db = new DB();
$conn = $db->getCon();

$month = intval($_GET['q']);
$year = date("Y");
$conn = new PDO("mysql:host=localhost;dbname=cms", "root", "");
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$query = "select *  from milk_records where YEAR(date)='" . $year . "' and MONTH(date)='" . $month ."' and isMilked = true";

$result = $conn->query($query);

echo json_encode($result->fetchAll(), false);



//CREATE TABLE `cms`.`milk_records`
// ( `id` INT(10) NOT NULL AUTO_INCREMENT ,
// `cow_id` VARCHAR(190) NOT NULL ,
// `morning` FLOAT NOT NULL , `evening` FLOAT NOT NULL ,
// `date` DATETIME NOT NULL , `isMilked` BOOLEAN NOT NULL
// DEFAULT FALSE , PRIMARY KEY (`id`)) ENGINE = InnoDB;