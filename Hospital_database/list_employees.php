<?php

include "db.php";

$notice = "";

if (isset($_GET["remove"])) {

    $id = (int)$_GET["remove"];

    $deleteSQL = "DELETE FROM employees WHERE employee_id = ?";
    $delete = $conn->prepare($deleteSQL);

    $delete->bind_param("i", $id);

    if ($delete->execute()) {
        $notice = "Employee deleted successfully.";
    } else {
        $notice = "Unable to delete employee.";
    }

    $delete->close();
}


$getEmployees = "SELECT * FROM employees ORDER BY employee_id DESC";
$result = $conn->query($getEmployees);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
</head>

<body>

<h2>All Employees</h2>

<?php if ($notice != ""): ?>
    <p><?= htmlspecialchars($notice) ?></p>
<?php endif; ?>

<p>
    <a href="add_employee.php">Add New Employee</a>
</p>

<table border="1" cellpadding="6" cellspacing="0">

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Gender</th>
        <th>DOB</th>
        <th>Role</th>
        <th>Department</th>
        <th>Salary</th>
        <th>Joining Date</th>
        <th>Action</th>
    </tr>

    <?php while ($employee = $result->fetch_assoc()): ?>

    <tr>

        <td>
            <?= $employee["employee_id"] ?>
        </td>

        <td>
            <?= htmlspecialchars($employee["full_name"]) ?>
        </td>

        <td>
            <?= htmlspecialchars($employee["gender"]) ?>
        </td>

        <td>
            <?= $employee["date_of_birth"] ?>
        </td>

        <td>
            <?= htmlspecialchars($employee["role"]) ?>
        </td>

        <td>
            <?= htmlspecialchars($employee["department"]) ?>
        </td>

        <td>
            <?= $employee["salary"] ?>
        </td>

        <td>
            <?= $employee["joining_date"] ?>
        </td>

        <td>

            <a href="update_employee.php?id=<?= $employee["employee_id"] ?>">
                Edit
            </a>

            |

            <a href="list_employees.php?remove=<?= $employee["employee_id"] ?>"
               onclick="return confirm('Are you sure you want to delete this employee?');">
                Delete
            </a>

        </td>

    </tr>

    <?php endwhile; ?>

</table>

</body>
</html>