<?php
include 'db_config.php';
session_start();



// Retrieve the user's name from the session
$name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Faculty Member';
// Handle saving syllabus when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course = $_POST['course'];
    $syllabus = $_POST['syllabus'];

    // SQL to insert syllabus data
    $sql = "INSERT INTO syllabus (course_name, syllabus_text) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $course, $syllabus);
    
    if ($stmt->execute()) {
        echo "<script>alert('Syllabus saved successfully!'); window.location.href='addSyllabus.php';</script>";
    } else {
        echo "<script>alert('Error saving syllabus!'); window.location.href='addSyllabus.php';</script>";
    }
    $stmt->close();
}

// Delete syllabus functionality (already present in the code you provided)
if (isset($_GET['delete'])) {
    $course_id = $_GET['delete'];

    // SQL to delete syllabus entry by course_id
    $sql = "DELETE FROM syllabus WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $course_id);
    if ($stmt->execute()) {
        echo "<script>alert('Syllabus deleted successfully!'); window.location.href='addSyllabus.php';</script>";
    } else {
        echo "<script>alert('Error deleting syllabus!'); window.location.href='addSyllabus.php';</script>";
    }
    $stmt->close();
}

// Fetch syllabus data from the database
$sql = "SELECT * FROM syllabus";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700,900|Ubuntu:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Add Syllabus</title>
</head>

<body>

    <nav class="sticky">
        <a href="faculty_dashboard.php" class="logo"></a>
        <ul class="navLinks" id="navLinks">
            <li><a href="faculty_dashboard.php">Home</a></li>
            <li><a href="addPaper.php">Add Paper</a></li>
            <li><a href="addSyllabus.php">Add Syllabus</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <div id="hamburger"></div>
    </nav>

    <div class="myContainer">
        <div id="bannerContainer">
            <img src="img/bannerIMG1.png">
            <p>Welcome faculty, <?php echo htmlspecialchars($name); ?></p>
        </div>

        <h1 id="getStarted">Upload Syllabus</h1>
        <div class="col-md-8 mx-auto" class="myContainer">

            <form action="addSyllabus.php" method="POST">
                <div class="form-group">
                    <label for="course">Select Course:</label>
                    <select name="course" id="course" class="form-control" required>
                        <option value="CSC101">CSC101</option>
                        <option value="CSE203">CSE203</option>
                        <option value="CSE306">CSE306</option>
                        <option value="CSE303">CSE303</option>
                        <option value="CSE213">CSE213</option>
                        <option value="CSE309">CSE309</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="syllabus">Syllabus:</label>
                    <textarea name="syllabus" id="syllabus" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save Syllabus</button>
            </form>

            <h3 class="mt-5">Syllabus List</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Syllabus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['course_name'] . "</td>
                                <td>" . nl2br($row['syllabus_text']) . "</td>
                                <td><a href='addSyllabus.php?delete=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this syllabus?\")'>Delete</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No syllabus found.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

</body>

</html>