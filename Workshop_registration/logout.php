<?php

session_start();


session_unset();


session_destroy();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Registration Completed</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container success">

    <h1>Registration Session Ended</h1>

    <p>
        Your registration session has been cleared.
    </p>

    <a href="registration.php" class="button">
        Register Again
    </a>

</div>

</body>

</html>