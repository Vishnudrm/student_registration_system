<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $address = $_POST['address'];
    $date_of_join = $_POST['date_of_join'];

    // Check if student ID already exists
    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Student ID already exists
        echo "<script>alert('Student ID $student_id already exists. Please choose a different ID.');</script>";
    } else {
        // Insert student data into the database if ID is unique
        $stmt = $conn->prepare("INSERT INTO students (student_id, name, email, phone, course, address, date_of_join) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $student_id, $name, $email, $phone, $course, $address, $date_of_join);
        $stmt->execute();

        // Show pop-up for successful insertion
        echo "<script>alert('Student $name has been successfully registered.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css"> <!-- Include your CSS file -->
</head>
<body>

    <!-- Main Container -->
    <div class="main-container">
        <h1>Student Registration</h1>

        <!-- Registration Form -->
        <form method="post" action="registration.php" class="registration-form">
            <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" id="student_id" name="student_id" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="course">Course:</label>
                <input type="text" id="course" name="course" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>

            <div class="form-group">
                <label for="date_of_join">Date of Join:</label>
                <input type="date" id="date_of_join" name="date_of_join" required>
            </div>

            <div class="form-buttons">
                <input type="submit" value="Register" class="submit-btn">
                <a href="index.php" class="home-btn">Go to Home</a> <!-- Home Button -->
            </div>
        </form>
    </div>

    <!-- Popup Modal (for future use) -->
    <div id="popup" class="popup">
        <p id="popup-message">Student has been successfully registered!</p>
    </div>

    <script src="scrpt.js"></script> <!-- Include your JS file -->
</body>
</html>
