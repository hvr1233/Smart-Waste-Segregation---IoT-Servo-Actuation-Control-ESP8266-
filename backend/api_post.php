<?php
include('connection.php');

$value1 = $_POST['value1'];
$value2 = $_POST['value2'];


if($value1 == 0){
    $val1 = "on";
} else{
    $val1 = "off";
}

$a = array("wet" => "$val1");
$a = json_encode($a);
file_put_contents("light.json", $a);

date_default_timezone_set("Asia/Kolkata");
$timestamp = date("Y-m-d H:i:s");



// Insert data into the database
$sql = "INSERT INTO 4421_dustbin (value1,value2, reading_time) VALUES ('$value1', '$value2', '$timestamp')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "new data inserted";
} else {
    echo "value not inserted" . mysqli_error($conn);
}

// Delete old records if there are more than 50 entries
$sql1 = "SELECT * FROM 4421_dustbin";
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result1) > 50) {
    $sql2 = "DELETE FROM 4421_dustbin ORDER BY id ASC LIMIT 1";
    $result2 = mysqli_query($conn, $sql2);

    if ($result2) {
        echo "deleted successfully";
    }
}


?>
