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
    <nav class="sticky">
        <a href="index.html" class="logo"></a>
        <ul class="navLinks" id="navLinks">
            <li><a href="index.html">Home</a></li>
            <li><a href="generateSubjects.html">generate</a></li>
            <li><a href="generateSubjects.html">past papers</a></li>
            <li><a href="generateSubjects.html">syllabus</a></li>
            <li><a href="addPaper.html">add paper</a></li>
        </ul>
        <div id="hamburger"></div>
    </nav>
    <!--header End-->
    <div class="myContainer">
        <!-- code start -->
        <div class="myContainer">

            <!-------------- Write Code Here: -------------->

            <div id="bannerContainer">
                <img src="img/bannerIMG2.png">
                <p>Generate Question Paper</p>
            </div>

            <div class="row" id="myRow">
                <div class="col-md-8 mx-auto">
                    <p id="pageTitle">
                        Choose a subject to generate a new question paper:
                    </p>

                    <div id="subjectsContainer">
                        <a href="generateMain.html" class="subject" id="higherMath">Higher Mathematics</a>
                        <a href="generateMain.html" class="subject" id="physics">Physics</a>
                        <span class="subject">Chemistry</span>
                        <span class="subject">Biology</span>
                        <span class="subject">Mathematics</span>
                        <span class="subject">Bangla</span>
                        <span class="subject">English</span>
                        <span class="subject">Religion</span>
                        <span class="subject">ICT</span>
                        <span class="subject">Accounting</span>
                        <span class="subject">Finance</span>
                        <span class="subject">Business</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- code End -->

        <?php include 'footer.php'; ?>
</body>

</html>
<script src="navbar.js"></script>