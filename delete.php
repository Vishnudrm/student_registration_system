<?php
include 'db.php';

$searchResults = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['q'])) {
    $q = trim($_GET['q']);
    
    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id LIKE ? OR name LIKE ?");
    $likeQ = "%$q%";
    $stmt->bind_param("ss", $likeQ, $likeQ);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function confirmDelete(id, name) {
            if (confirm(`Are you sure you want to delete student ${name} with ID: ${id}?`)) {
                window.location.href = `confirm_delete.php?id=${id}`;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <button onclick="window.location.href='index.php'" class="home-btn">Go to Home</button>
        <h1>Delete Student</h1>

        <form class="search-form" method="GET" action="delete.php">
            <input type="text" name="q" placeholder="Enter Student ID or Name" required>
            <button type="submit">Search</button>
        </form>

        <?php if (!empty($searchResults)): ?>
            <table>
                <tr>
                    <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Course</th><th>Address</th><th>Date of Join</th><th>Action</th>
                </tr>
                <?php foreach ($searchResults as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['student_id']) ?></td>
                        <td><?= htmlspecialchars($student['name']) ?></td>
                        <td><?= htmlspecialchars($student['email']) ?></td>
                        <td><?= htmlspecialchars($student['phone']) ?></td>
                        <td><?= htmlspecialchars($student['course']) ?></td>
                        <td><?= htmlspecialchars($student['address']) ?></td>
                        <td><?= htmlspecialchars($student['date_of_join']) ?></td>
                        <td>
                            <a href="#" class="delete-btn" onclick="confirmDelete('<?= $student['student_id'] ?>', '<?= $student['name'] ?>')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php elseif (isset($_GET['q'])): ?>
            <p>No students found for '<?= htmlspecialchars($_GET['q']) ?>'.</p>
        <?php endif; ?>
    </div>
</body>
</html>
