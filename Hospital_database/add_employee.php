<?php

include "db.php";

$message = "";

if (isset($_POST["add_employee"])) {

    $name = $_POST["full_name"];
    $gender = $_POST["gender"];
    $dob = $_POST["date_of_birth"];
    $role = $_POST["role"];
    $department = $_POST["department"];
    $qualification = $_POST["qualification"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $salary = $_POST["salary"];
    $joiningDate = $_POST["joining_date"];

    $sql = "INSERT INTO employees
    (full_name, gender, date_of_birth, role, department,
    qualification, phone, email, address, salary, joining_date)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssssssssds",
        $name,
        $gender,
        $dob,
        $role,
        $department,
        $qualification,
        $phone,
        $email,
        $address,
        $salary,
        $joiningDate
    );

    if ($stmt->execute()) {
        $message = "Employee added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
</head>

<body>

<h2>Add New Employee</h2>

<?php if ($message != ""): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">

    Full Name:
    <input type="text" name="full_name" required>
    <br><br>

    Gender:
    <select name="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>
    <br><br>

    Date of Birth:
    <input type="date" name="date_of_birth" required>
    <br><br>

    Role:
    <input type="text" name="role" required>
    <br><br>

    Department:
    <input type="text" name="department" required>
    <br><br>

    Qualification:
    <input type="text" name="qualification">
    <br><br>

    Phone:
    <input type="text" name="phone">
    <br><br>

    Email:
    <input type="email" name="email">
    <br><br>

    Address:
    <textarea name="address"></textarea>
    <br><br>

    Salary:
    <input type="number" name="salary" step="0.01" required>
    <br><br>

    Joining Date:
    <input type="date" name="joining_date" required>
    <br><br>

    <button type="submit" name="add_employee">
        Add Employee
    </button>

</form>

<p>
    <a href="list_employees.php">View Employee List</a>
</p>

</body>
</html>