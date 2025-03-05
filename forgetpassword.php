<?php
session_start();
include('db_connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['emailid']);
    // Check if the email exists in the database
    $sql = "SELECT * FROM user WHERE email_id = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Email found, redirect to register.php with email as a parameter
        header("Location: signup.php?email=$email");
        exit();
    } else {
        // Email not found
        $_SESSION['message'] = "No account found with this email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Inventory Management System">
    <meta name="author" content="IMS">
    <title>Inventory Management System</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="account-page">
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset ">
                        <div class="login-userheading">
                            <h3>Forgot password?</h3>
                            <h4>Don’t warry! it happens. Please enter the address <br>
                                associated with your account.</h4>
                        </div>
                        <form class="user" method="POST" action="">
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input type="text" placeholder="Enter your email address" id="exampleInputEmail" name="emailid" aria-describedby="emailHelp" required>
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                </div>
                                <span id="emailError" class="error-message">
                                    <?php 
                                        if (isset($_SESSION['message'])) {
                                            echo $_SESSION['message']; 
                                            unset($_SESSION['message']); // Clear the message after displaying it
                                        }
                                    ?>
                                </span>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login" href="signin.php">Submit</button>
                            </div>
                        </form>
                        <div class="signinform text-center">
                            <h4>Already a user? <a href="signin.php" class="hover-a">Sign In</a></h4>
                        </div>
                    </div>
                </div>
                <div class="login-img">
                    <img src="assets/img/login_background.svg" alt="img">
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>