<?php

include "db.php";

if (!isset($_GET["id"])) {
    die("Employee ID not found.");
}

$id = (int)$_GET["id"];
$message = "";

$sql = "SELECT * FROM employees WHERE employee_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Employee does not exist.");
}

$employee = $result->fetch_assoc();
$stmt->close();



if (isset($_POST["save_update"])) {

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

    $updateSQL = "UPDATE employees SET
        full_name = ?,
        gender = ?,
        date_of_birth = ?,
        role = ?,
        department = ?,
        qualification = ?,
        phone = ?,
        email = ?,
        address = ?,
        salary = ?,
        joining_date = ?
        WHERE employee_id = ?";

    $update = $conn->prepare($updateSQL);

    $update->bind_param(
        "sssssssssdsi",
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
        $joiningDate,
        $id
    );

    if ($update->execute()) {
        $message = "Employee updated successfully!";

        // Update displayed values
        $employee["full_name"] = $name;
        $employee["gender"] = $gender;
        $employee["date_of_birth"] = $dob;
        $employee["role"] = $role;
        $employee["department"] = $department;
        $employee["qualification"] = $qualification;
        $employee["phone"] = $phone;
        $employee["email"] = $email;
        $employee["address"] = $address;
        $employee["salary"] = $salary;
        $employee["joining_date"] = $joiningDate;

    } else {
        $message = "Update failed: " . $update->error;
    }

    $update->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
</head>

<body>

<h2>Edit Employee</h2>

<?php if ($message != ""): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">

    Full Name:
    <input type="text"
           name="full_name"
           value="<?= htmlspecialchars($employee["full_name"]) ?>"
           required>
    <br><br>

    Gender:
    <select name="gender">

        <option value="Male"
        <?= $employee["gender"] == "Male" ? "selected" : "" ?>>
            Male
        </option>

        <option value="Female"
        <?= $employee["gender"] == "Female" ? "selected" : "" ?>>
            Female
        </option>

        <option value="Other"
        <?= $employee["gender"] == "Other" ? "selected" : "" ?>>
            Other
        </option>

    </select>
    <br><br>

    Date of Birth:
    <input type="date"
           name="date_of_birth"
           value="<?= $employee["date_of_birth"] ?>"
           required>
    <br><br>

    Role:
    <input type="text"
           name="role"
           value="<?= htmlspecialchars($employee["role"]) ?>"
           required>
    <br><br>

    Department:
    <input type="text"
           name="department"
           value="<?= htmlspecialchars($employee["department"]) ?>"
           required>
    <br><br>

    Qualification:
    <input type="text"
           name="qualification"
           value="<?= htmlspecialchars($employee["qualification"]) ?>">
    <br><br>

    Phone:
    <input type="text"
           name="phone"
           value="<?= htmlspecialchars($employee["phone"]) ?>">
    <br><br>

    Email:
    <input type="email"
           name="email"
           value="<?= htmlspecialchars($employee["email"]) ?>">
    <br><br>

    Address:
    <textarea name="address"><?= htmlspecialchars($employee["address"]) ?></textarea>
    <br><br>

    Salary:
    <input type="number"
           name="salary"
           step="0.01"
           value="<?= $employee["salary"] ?>"
           required>
    <br><br>

    Joining Date:
    <input type="date"
           name="joining_date"
           value="<?= $employee["joining_date"] ?>"
           required>
    <br><br>

    <button type="submit" name="save_update">
        Update Employee
    </button>

</form>

<p>
    <a href="list_employees.php">Back to Employee List</a>
</p>

</body>
</html>