<?php
include 'db_config.php';

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
    <title>Syllabus</title>
</head>

<body>

    <?php include 'student_header.php'; ?>

    <div class="myContainer">
        <h1 id="getStarted">Syllabus List</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Syllabus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['course_name'] . "</td>
                                <td>" . nl2br($row['syllabus_text']) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No syllabus found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>