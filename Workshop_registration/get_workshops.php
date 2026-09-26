<?php

require "db.php";


$sql = "SELECT * FROM workshops
        WHERE available_seats > 0
        ORDER BY workshop_date";

$result = mysqli_query($connection, $sql);

$workshops = array();

if ($result) {

    while ($row = mysqli_fetch_assoc($result)) {

        $workshops[] = $row;
    }
}


header("Content-Type: application/json");

echo json_encode($workshops);

?>