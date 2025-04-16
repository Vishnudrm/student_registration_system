<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $address = $_POST['address'];
    $date_of_join = $_POST['date_of_join'];

    // Check for duplicate student ID
    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('Student ID already exists!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (student_id, name, email, phone, course, address, date_of_join) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $student_id, $name, $email, $phone, $course, $address, $date_of_join);
        if ($stmt->execute()) {
            echo "<script>alert('Student Registered Successfully!'); window.location.href='registration.php';</script>";
        } else {
            echo "<script>alert('Error in registration!');</script>";
        }
    }
}
?>
