<?php
include('db_connection.php');

// Check if this page was accessed with a GET request (i.e., redirect from forgot-password page)
$isUpdateMode = isset($_GET['email']); // Check if email is passed in URL (indicating update mode)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign user inputs
    $name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['emailid']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password if it's being updated
    $hashedpassword = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

    // Update or insert user details
    if ($isUpdateMode) {
        // Update the user in the database
        $sql = "UPDATE user SET name='$name', username='$username', email_id='$email' ";
        if ($hashedpassword) {
            $sql .= ", password='$hashedpassword'";
        }
        $sql .= " WHERE email_id='$email'";
        
        if ($conn->query($sql) === TRUE) {
            // Redirect to login page or some success page
            header("Location: signin.php");
            exit(); // Ensure no further code is executed
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Insert the user into the database for new registration
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        $defaultrole = "user";
        $sql = "INSERT INTO user (name, username, password, email_id, role) VALUES ('$name', '$username', '$hashedpassword', '$email', '$defaultrole')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to login page
            header("Location: signin.php");
            exit(); // Ensure no further code is executed
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// If the page was accessed with a valid email (for update), fetch user details
$userDetails = null;
if ($isUpdateMode) {
    $email = $_GET['email']; // Get the email from the URL
    $sql = "SELECT * FROM user WHERE email_id = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();
    } else {
        // If no user found, redirect to the forgot-password page or display an error
        header("Location: forgetpassword.php");
        exit();
    }
}
$conn->close();
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
                    <div class="login-userset">
                        <div class="login-userheading">
                            <h3><?php echo $isUpdateMode ? 'Update Your Account!' : 'Create an Account!'; ?></h3>
                            <h4>Continue where you left off</h4>
                        </div>
                        <form class="user" method="POST" action="">
                            <div class="form-login">
                                <label>Full Name</label>
                                <div class="form-addons">
                                    <input type="text" name="fullname" placeholder="Enter your full name" id="exampleFullName" value="<?php echo $isUpdateMode ? $userDetails['name'] : ''; ?>" required>
                                    <img src="assets/img/icons/users1.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Username</label>
                                <div class="form-addons">
                                    <input type="text" name="username" placeholder="Enter your username" id="exampleUserName" value="<?php echo $isUpdateMode ? $userDetails['username'] : ''; ?>" required>
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input type="text" name="emailid" placeholder="Enter your email address" id="exampleInputEmail" value="<?php echo $isUpdateMode ? $userDetails['email_id'] : ''; ?>" <?php echo $isUpdateMode ? 'readonly' : ''; ?> required>
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" name="password" class="pass-input" placeholder="Enter your password" id="exampleInputPassword" 
                                    required>
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login"><?php echo $isUpdateMode ? 'Update Account' : 'Register Account'; ?></button>
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