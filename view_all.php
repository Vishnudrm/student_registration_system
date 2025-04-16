<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <button onclick="window.location.href='index.php'" class="home-btn">Go to Home</button>
        <h1>All Students</h1>

        <?php
        if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
            echo "<div class='deleted-message'>Student deleted successfully!</div>";
        }

        $stmt = $conn->prepare("SELECT * FROM students");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Course</th><th>Address</th><th>Date of Join</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['student_id']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['phone']}</td><td>{$row['course']}</td><td>{$row['address']}</td><td>{$row['date_of_join']}</td>";
                echo "<td><a href='delete.php?id={$row['student_id']}' class='delete-btn'>Delete</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No students found.</p>";
        }
        ?>
    </div>
</body>
</html>
