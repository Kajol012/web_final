<?php

session_start();

require "db.php";

header("Content-Type: application/json");


// Get submitted data
$student_id = trim($_POST['student_id'] ?? "");
$student_name = trim($_POST['student_name'] ?? "");
$email = trim($_POST['email'] ?? "");
$department = trim($_POST['department'] ?? "");
$workshop_id = $_POST['workshop_id'] ?? "";




if ($student_id == "" ||
    $student_name == "" ||
    $email == "" ||
    $department == "" ||
    $workshop_id == "") {

    echo json_encode([
        "success" => false,
        "message" => "Please fill in all fields."
    ]);

    exit();
}



if (!preg_match("/^[A-Za-z0-9-]+$/", $student_id)) {

    echo json_encode([
        "success" => false,
        "message" => "Invalid Student ID."
    ]);

    exit();
}



if (!preg_match("/^[A-Za-z ]+$/", $student_name)) {

    echo json_encode([
        "success" => false,
        "message" => "Name should contain only letters and spaces."
    ]);

    exit();
}



if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    echo json_encode([
        "success" => false,
        "message" => "Please enter a valid email."
    ]);

    exit();
}



$workshop_id = (int)$workshop_id;

$sql = "SELECT *
        FROM workshops
        WHERE id = $workshop_id";

$result = mysqli_query($connection, $sql);

if (!$result || mysqli_num_rows($result) == 0) {

    echo json_encode([
        "success" => false,
        "message" => "Workshop not found."
    ]);

    exit();
}

$workshop = mysqli_fetch_assoc($result);


// Check available seats
if ($workshop['available_seats'] <= 0) {

    echo json_encode([
        "success" => false,
        "message" => "Sorry, no seats are available."
    ]);

    exit();
}



$check_sql = "SELECT id
              FROM registrations
              WHERE student_id = '$student_id'";

$check_result = mysqli_query(
    $connection,
    $check_sql
);

if (mysqli_num_rows($check_result) > 0) {

    echo json_encode([
        "success" => false,
        "message" => "This Student ID is already registered."
    ]);

    exit();
}



$insert_sql = "INSERT INTO registrations
               (student_id, student_name, email,
                department, workshop_id)
               VALUES
               ('$student_id',
                '$student_name',
                '$email',
                '$department',
                $workshop_id)";


if (mysqli_query($connection, $insert_sql)) {


    $update_sql = "UPDATE workshops
                   SET available_seats =
                   available_seats - 1
                   WHERE id = $workshop_id";

    mysqli_query($connection, $update_sql);


    $_SESSION['student_id'] = $student_id;
    $_SESSION['student_name'] = $student_name;
    $_SESSION['email'] = $email;
    $_SESSION['department'] = $department;
    $_SESSION['workshop_id'] = $workshop_id;
    $_SESSION['workshop_name'] =
        $workshop['workshop_name'];


   
    if (isset($_POST['remember'])) {

        setcookie(
            "student_id",
            $student_id,
            time() + (86400 * 30),
            "/"
        );
    }


    echo json_encode([
        "success" => true,
        "message" =>
        "Registration successful!"
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" =>
        "Registration failed. Please try again."
    ]);
}

?>