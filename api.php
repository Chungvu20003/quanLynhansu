<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$database = "quanlythongtin";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xử lý yêu cầu thêm nhân viên
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $department = $_POST["department"];
    $salary = $_POST["salary"];

    $sql = "INSERT INTO employees (name, department, salary) VALUES ('$name', '$department', '$salary')";

    if ($conn->query($sql) === TRUE) {
        echo "New employee added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Xử lý yêu cầu sửa thông tin nhân viên
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    parse_str(file_get_contents("php://input"), $_PUT);

    $id = $_PUT["id"];
    $name = $_PUT["name"];
    $department = $_PUT["department"];
    $salary = $_PUT["salary"];

    $sql = "UPDATE employees SET name='$name', department='$department', salary='$salary' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Employee updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    parse_str(file_get_contents("php://input"), $_DELETE);

    $id = $_DELETE["id"];

    $sql = "DELETE FROM employees WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Employee deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
