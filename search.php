<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Student</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="container">
        <button onclick="window.location.href='index.php'" class="home-btn">Go to Home</button>
        <h1>Search Student</h1>
        <form class="search-form" method="GET" action="search.php">
            <input type="text" name="q" placeholder="Enter Student ID or Name" required>
            <button type="submit">Search</button>
        </form>

        <div id="search-result">
            <?php
                if (isset($_GET['q'])) {
                    $q = $_GET['q'];
                    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ? OR name LIKE ?");
                    $likeQ = "%" . $q . "%";
                    $stmt->bind_param("ss", $q, $likeQ);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Course</th><th>Address</th><th>Date of Join</th><th>Action</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>{$row['student_id']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['phone']}</td><td>{$row['course']}</td><td>{$row['address']}</td><td>{$row['date_of_join']}</td>";
                            echo "<td><button class='delete-btn' onclick='confirmDelete(\"{$row['student_id']}\", \"{$row['name']}\")'>Delete</button></td></tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>No results found for '$q'.</p>";
                    }
                }
            ?>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2>Are you sure you want to delete this student?</h2>
            <p id="studentName"></p>
            <button id="confirmDeleteBtn" onclick="deleteStudent()">Yes, Delete</button>
            <button onclick="closeModal()">Cancel</button>
        </div>
    </div>

    <script>
        function confirmDelete(id, name) {
            document.getElementById('studentName').textContent = `ID: ${id}, Name: ${name}`;
            document.getElementById('confirmDeleteBtn').setAttribute('data-id', id);
            document.getElementById('confirmDeleteBtn').setAttribute('data-name', name);
            document.getElementById('confirmModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('confirmModal').style.display = 'none';
        }

        function deleteStudent() {
            var id = document.getElementById('confirmDeleteBtn').getAttribute('data-id');
            var name = document.getElementById('confirmDeleteBtn').getAttribute('data-name');
            window.location.href = `delete.php?id=${id}&name=${name}`;
        }
    </script>
</body>
</html>
