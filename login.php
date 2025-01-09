<?php
include 'db_config.php';

session_start(); // Start the session to store user info

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role == "student") {
        $sql = "SELECT * FROM students WHERE email = ?";
    } elseif ($role == "faculty") {
        $sql = "SELECT * FROM faculty WHERE email = ?";
    } else {
        echo "<script>alert('Invalid role selected!'); window.history.back();</script>";
        exit;
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) { // No password hashing
            // Store user information in the session
            $_SESSION['user_name'] = $user['name']; // Store the student's name
            $_SESSION['user_role'] = $role; // Store the role (student or faculty)
            
            // Redirect to appropriate dashboard
            if ($role === "student") {
                echo "<script>alert('Login successful! Redirecting to Student Dashboard.'); window.location.href='student_dashboard.php';</script>";
            } elseif ($role === "faculty") {
                echo "<script>alert('Login successful! Redirecting to Faculty Dashboard.'); window.location.href='faculty_dashboard.php';</script>";
            }
        } else {
            echo "<script>alert('Invalid password!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
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
    <title>Login</title>
</head>

<body>
    <nav class="sticky">
        <a href="index.php" class="logo"></a>
        <ul class="navLinks">
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </nav>

    <div class="myContainer">
        <div class="row" id="myRow">
            <div class="col-md-6 mx-auto">
                <p id="pageTitle">Login</p>
                <form class="myForm" action="login.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Login as:</label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="student">Student</option>
                            <option value="faculty">Faculty</option>
                        </select>
                    </div>
                    <div id="buttonContainer">
                        <button class="myButton btn btn-primary" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>