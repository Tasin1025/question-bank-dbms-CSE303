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
        <a href="faculty_dashboard.php" class="logo"></a>
        <ul class="navLinks" id="navLinks">
            <li><a href="faculty_dashboard.php">Home</a></li>
            <li><a href="addPaper.php">add paper</a></li>
            <li><a href="logout.php">Logout</a></li>

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
                <p>Add Question Paper</p>
            </div>

            <div class="row" id="myRow">
                <div class="col-md-6 mx-auto">
                    <p id="pageTitle">Paper Information</p>

                    <form class="myForm" action="addPaper.php" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6 pr-0">
                                    <label>Level</label>
                                    <select class="form-control">
                                        <option>SSC</option>
                                        <option>HSC</option>
                                    </select>
                                </div>
                                <div class="col-6 pl-0">
                                    <label>Year</label>
                                    <input type="number" class="form-control" name="year">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Subject</label>
                            <select class="form-control" name="subject">
                                <option>Physics</option>
                                <option>Higher Mathematics</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Origin</label>
                            <select class="form-control" name="board">
                                <option>Model Question</option>
                                <option>Dhaka Board</option>
                                <option>Rajshahi Board</option>
                                <option>Comilla Board</option>
                                <option>Jessore Board</option>
                                <option>Chittagong Board</option>
                                <option>Barisal Board</option>
                                <option>Sylhet Board</option>
                                <option>Dinajpur Board</option>
                                <option>Madrasah Board</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Full Marks</label>
                            <input type="text" class="form-control" name="marks">
                        </div>

                        <div class="form-group">
                            <label>Time</label>
                            <input type="text" class="form-control" name="time">
                        </div>

                        <div class="form-group">
                            <label>[N.B. — ]</label>
                            <textarea type="text" class="form-control" name="note" rows="4"></textarea>
                        </div>

                        <div id="buttonContainer">
                            <input type="hidden" name="form_submitted" value="1" />
                            <input class="myButton" name="submit" type="submit" value="Next">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- code End -->

        <?php include 'footer.php'; ?>
</body>

</html>
<script src="navbar.js"></script>