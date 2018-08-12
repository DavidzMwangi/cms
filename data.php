<?php
#seed milk_records db
//maximum -> 4.8
//minimum -> 1.2
//maximum-difference btn morning and evening 1.0
//jan 31, feb 28, mar 31, apr 30,may 31, june 30, jul 31, --2018

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cms";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $query  = "Delete from milk_records";
// if($conn->query($query) == true){
//     echo "Table records dropped";
// }
for($month = 6; $month < 8; $month++){
    for($day =1; $day <= 30; $day++){
        for($cow = 0;$cow < 10; $cow++){
           $cow_id = 'EU '.(300 + $cow);
           $morning = random_number(); //btn 1.2 - 4.8
           $evening = random_number(); //btn $morning +- 1;
           $date = generate_date(2018, $month, $day); // 01-01-2018

        //    $sql = "insert into milk_records (cow_id, morning, evening, date) values('".$cow_id."',")"
            $sql = "insert into milk_records (cow_id, morning, evening, date) values" .
                    " ('" . $cow_id . "','" .$morning . "','" .$evening. "','". $date ."')";
                 
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }



        }
    }
}

$conn->close();

//number btn 1.2, 4.8;;

function random_number(){
    $num = rand(1,4);
    $decimal = rand(0, 9);
    
    $randNo = $num . '.' . $decimal;
    return floatVal($randNo);
}
function generate_date($year,$month,$day){
  $string_date = $year . '-' . $month . '-' . $day;
  $date = date_create($string_date);
  $real =  date_format($date,"Y-m-d");
  return $real;
}


#cow table 
#id range btn 'EU ' . number --- 1 - 42