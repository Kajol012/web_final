<?php
session_start();


session_unset();


session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Complete</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container success">

    <h1>Registration Completed!</h1>

    <p>
        Your university registration has been completed successfully.
    </p>

    <p>
        Your session data has been removed.
    </p>

    <a href="index.php" class="button">
        Register Again
    </a>

</div>

</body>
</html>