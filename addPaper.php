<?php
session_start();



// Retrieve the user's name from the session
$name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Faculty Member';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate the input fields
    $subject = $_POST['subject'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];

    // Handle file upload
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == 0) {
        // Define the directory where the file will be stored
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["pdf_file"]["name"]);
        
        // Check if the file is a PDF
        $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($file_extension != "pdf") {
            echo "<script>alert('Only PDF files are allowed!'); window.history.back();</script>";
            exit;
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["pdf_file"]["tmp_name"], $target_file)) {
            // Connect to the database
            include 'db_config.php';

            // Insert the data into the database
            $sql = "INSERT INTO uploaded_papers (subject, semester, year, file_path) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssis", $subject, $semester, $year, $target_file);
            if ($stmt->execute()) {
                echo "<script>alert('Question paper uploaded successfully!'); window.location.href='faculty_dashboard.php';</script>";
            } else {
                echo "<script>alert('Error uploading question paper.'); window.history.back();</script>";
            }
            $stmt->close();
            $conn->close();
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('No file selected or there was an error with the file upload.'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700,900|Ubuntu:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Upload Question Paper</title>
</head>

<body>

    <!--header Start-->
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
    <!--header End-->

    <div class="myContainer">
        <div id="bannerContainer">
            <img src="img/bannerIMG1.png">
            <p>Welcome faculty, <?php echo htmlspecialchars($name); ?></p>
        </div>

        <div class="row" id="myRow">
            <div class="col-md-8 mx-auto">
                <h1 id="getStarted">Upload Question Paper</h1>

                <form action="addPaper.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <select name="subject" id="subject" class="form-control" required>
                            <option value="CSC101">CSC101</option>
                            <option value="CSE203">CSE203</option>
                            <option value="CSE306">CSE306</option>
                            <option value="CSE303">CSE303</option>
                            <option value="CSE213">CSE213</option>
                            <option value="CSE309">CSE309</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester:</label>
                        <select name="semester" id="semester" class="form-control" required>
                            <option value="Spring">Spring</option>
                            <option value="Summer">Summer</option>
                            <option value="Fall">Fall</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <select name="year" id="year" class="form-control" required>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pdf_file">Upload PDF:</label>
                        <input type="file" name="pdf_file" id="pdf_file" class="form-control" accept=".pdf" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>

<script src="navbar.js"></script>