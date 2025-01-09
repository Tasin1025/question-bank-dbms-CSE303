<?php
include 'db_config.php';

// Define all the subjects
$subjects = ['CSC101', 'CSE203', 'CSE306', 'CSE303', 'CSE213', 'CSE309'];

// Function to fetch the number of papers for each subject
function getSubjectPaperCount($subject) {
    global $conn;
    $sql = "SELECT COUNT(*) AS paper_count FROM uploaded_papers WHERE subject = '$subject'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['paper_count'];
}

// Function to fetch papers for each subject
function getSubjectPapers($subject) {
    global $conn;
    $sql = "SELECT * FROM uploaded_papers WHERE subject = '$subject' ORDER BY year ASC";
    $result = $conn->query($sql);
    $papers = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $papers[] = $row;
        }
    }
    return $papers;
}
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
    <title>Past Papers</title>
    <script>
    function showTable(subject) {
        // Hide all tables first
        document.querySelectorAll(".subjectTable").forEach(table => {
            table.style.display = "none";
        });

        // Show the selected table
        document.getElementById(subject).style.display = "table";
    }
    </script>
</head>

<body>
    <?php include 'student_header.php'; ?>

    <div class="myContainer">
        <h1 id="getStarted">Past Papers</h1>


        <!-- Subject Selection with Paper Count -->
        <div class="row">
            <?php foreach ($subjects as $subject) {
                $paperCount = getSubjectPaperCount($subject); // Get the paper count for each subject
            ?>
            <div class="col-md-2">
                <button class="btn btn-primary" onclick="showTable('<?php echo $subject; ?>')">
                    <?php echo $subject . " (" . $paperCount . " papers)"; ?>
                </button>
            </div>
            <?php } ?>
        </div>

        <!-- Tables for each subject -->
        <?php
        foreach ($subjects as $subject) {
            $papers = getSubjectPapers($subject);

            // Start the table for the subject
            echo "<table id='$subject' class='subjectTable table table-bordered' style='display: none;'>";
            echo "<thead><tr><th>Year</th><th>Fall</th><th>Spring</th><th>Summer</th><th>Download</th></tr></thead>";
            echo "<tbody>";

            // Prepare an array with years (2020-2025)
            $years = [2020, 2021, 2022, 2023, 2024];

            // Loop through each year
            foreach ($years as $year) {
                // Initialize an empty row for the current year
                $row = [
                    'fall' => 'N/A',
                    'spring' => 'N/A',
                    'summer' => 'N/A',
                    'download' => 'N/A'
                ];

                // Loop through the papers for this subject
                foreach ($papers as $paper) {
                    // If the paper matches the current year and semester, fill the data
                    if ($paper['year'] == $year) {
                        if ($paper['semester'] == 'Fall') {
                            $row['fall'] = "<a href='" . htmlspecialchars($paper['file_path']) . "' target='_blank'>Download</a>";
                        } elseif ($paper['semester'] == 'Spring') {
                            $row['spring'] = "<a href='" . htmlspecialchars($paper['file_path']) . "' target='_blank'>Download</a>";
                        } elseif ($paper['semester'] == 'Summer') {
                            $row['summer'] = "<a href='" . htmlspecialchars($paper['file_path']) . "' target='_blank'>Download</a>";
                        }
                    }
                }

                // Add the row to the table
                echo "<tr>";
                echo "<td>$year</td>";
                echo "<td>" . $row['fall'] . "</td>";
                echo "<td>" . $row['spring'] . "</td>";
                echo "<td>" . $row['summer'] . "</td>";
                echo "<td>" . $row['download'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        }
        ?>

    </div>

    <?php include 'footer.php'; ?>
</body>

</html>