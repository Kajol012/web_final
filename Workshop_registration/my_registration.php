<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: registration.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>My Workshop Registration</h1>

    <div class="registration-box">

        <p>
            <strong>Student ID:</strong>
            <?php echo htmlspecialchars($_SESSION['student_id']); ?>
        </p>

        <p>
            <strong>Name:</strong>
            <?php echo htmlspecialchars($_SESSION['student_name']); ?>
        </p>

        <p>
            <strong>Email:</strong>
            <?php echo htmlspecialchars($_SESSION['email']); ?>
        </p>

        <p>
            <strong>Department:</strong>
            <?php echo htmlspecialchars($_SESSION['department']); ?>
        </p>

        <p>
            <strong>Workshop:</strong>
            <?php echo htmlspecialchars($_SESSION['workshop_name']); ?>
        </p>

    </div>


  
    <button type="button"
            onclick="window.location.href='registration.php';">
        Back to Registration
    </button>


    <button type="button"
            onclick="window.location.href='logout.php';">
        Complete / Logout
    </button>

</div>

</body>

</html>