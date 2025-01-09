<?php
include 'db_config.php';

// Define all the subjects
$subjects = ['CSC101', 'CSE203', 'CSE306', 'CSE303', 'CSE213', 'CSE309'];

// Handle form submission to save syllabus
if (isset($_POST['save_syllabus'])) {
    $course_name = $_POST['course_name'];
    $syllabus_text = $_POST['syllabus_text'];

    $sql = "INSERT INTO syllabus (course_name, syllabus_text) VALUES ('$course_name', '$syllabus_text')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Syllabus saved successfully!');</script>";
    } else {
        echo "<script>alert('Error saving syllabus: " . $conn->error . "');</script>";
    }
}

// Fetch all syllabi from the database
function getAllSyllabi() {
    global $conn;
    $sql = "SELECT * FROM syllabus ORDER BY course_name ASC";
    $result = $conn->query($sql);
    $syllabi = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $syllabi[] = $row;
        }
    }
    return $syllabi;
}

$all_syllabi = getAllSyllabi();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700,900|Ubuntu:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Add Syllabus</title>
</head>

<body>
    <nav class="sticky">
        <a href="faculty_dashboard.php" class="logo"></a>
        <ul class="navLinks">
            <li><a href="faculty_dashboard.php">Home</a></li>
            <li><a href="addSyllabus.php">Add Syllabus</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="myContainer">
        <h1>Add Syllabus</h1>

        <!-- Add Syllabus Form -->
        <form method="POST" action="addSyllabus.php">
            <div class="form-group">
                <label for="course_name">Select Course</label>
                <select name="course_name" id="course_name" class="form-control" required>
                    <?php foreach ($subjects as $subject) { ?>
                    <option value="<?php echo $subject; ?>"><?php echo $subject; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="syllabus_text">Syllabus</label>
                <textarea name="syllabus_text" id="syllabus_text" class="form-control" rows="10" required></textarea>
            </div>
            <button type="submit" name="save_syllabus" class="btn btn-primary">Save Syllabus</button>
        </form>

        <hr>

        <!-- Display Syllabus Data -->
        <h2>All Syllabus</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Syllabus</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($all_syllabi) > 0) {
                    foreach ($all_syllabi as $syllabus) { ?>
                <tr>
                    <td><?php echo $syllabus['course_name']; ?></td>
                    <td><?php echo nl2br($syllabus['syllabus_text']); ?></td>
                </tr>
                <?php }
                } else { ?>
                <tr>
                    <td colspan="2">No syllabus available.</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

    <?php include 'footer.php'; ?>

</body>

</html>