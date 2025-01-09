<?php
session_start();

// Check if the user is logged in and is a student
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header("Location: index.php");
    exit;
}

// Retrieve the user's name from the session
$name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Student';
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
</head>

<body>
    <!--header Start-->
    <?php include 'student_header.php'; ?>
    <!--header End-->
    <div class="myContainer">

        <div id="bannerContainer">
            <img src="img/bannerIMG1.png">
            <p>Welcome Student, <?php echo htmlspecialchars($name); ?></p>
        </div>

        <div class="row" id="myRow">
            <div class="col-md-8 mx-auto">
                <p id="introPara">
                    <b>IUB Student HELP Portal</b> is a board exam question generator. HELP can streamline the process
                    of collecting and accessing previous exam questions, providing students with a comprehensive and
                    efficient platform for their board exam preparation. This not only saves time but also enhances the
                    overall effectiveness of their study routine.
                </p>

                <h1 id="getStarted">Get started with ISHP:</h1>

                <div id="linksContainer">
                    <div class="link">
                        <a href="generateSubjects.html" class="linkImg" id="linkImg1"></a>
                        <a href="generateSubjects.html" class="linkText">Generate Question Paper</a>
                    </div>
                    <div class="link">
                        <a href="generateSubjects.html" class="linkImg" id="linkImg2"></a>
                        <a href="generateSubjects.html" class="linkText">Past Question Papers</a>
                    </div>
                    <div class="link">
                        <a href="generateSubjects.html" class="linkImg" id="linkImg3"></a>
                        <a href="generateSubjects.html" class="linkText">Syllabus</a>
                    </div>
                    <div class="link">
                        <a href="addPaper.html" class="linkImg" id="linkImg4"></a>
                        <a href="addPaper.html" class="linkText">Add Question Paper</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>

<script src="navbar.js"></script>