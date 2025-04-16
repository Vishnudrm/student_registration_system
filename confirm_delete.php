<?php
include 'db.php';

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Prepare the SQL query to delete the student by ID
    $stmt = $conn->prepare("DELETE FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Student with ID: $student_id has been deleted.');</script>";
        echo "<script>window.location.href='delete.php';</script>";
    } else {
        echo "<script>alert('Failed to delete the student.');</script>";
        echo "<script>window.location.href='delete.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.');</script>";
    echo "<script>window.location.href='delete.php';</script>";
}
?>
