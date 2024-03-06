<?php include('./config/constents.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <!-- Link to your existing CSS file -->
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
        // Display login messages if available
        if (isset($_SESSION['login'])) 
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }

        ?>
        <br><br>

        <!-- Login Form Starts end here -->
        <form action="login.php" method="POST" class="text-center">
            <!-- Use labels for better accessibility -->
            <label class="lav-login" for="username"> Username:</label>
            <input class="inp-login" type="text" name="username" id="username" placeholder="Enter Username" required> <br><br>

            <!-- Password:  -->
            <label class="lav-login" for="password">Password:</label>
            <input class="inp-login" type="password" name="password" id="password" placeholder="Enter Password" required> <br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary inp-login">
            <br><br>
        </form>
        <!-- Login Form Ends here -->

        <!-- <p class="text-center"> Created By - <a href="www.alamin.com"> Al Amin Emon </a></p> -->
        <p class="text-center">Created By - <a href="http://www.alamin.com">Al Amin Emon</a></p>

    </div>
</body>
</html>

<?php
// Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Process for login 
    // 1. Get the data from the login form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

    // 2. Use prepared statement to check whether the user with username exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username=? AND password = ?";
    
    // 3. Execute the query using prepared statement
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    // 4. Check whether the user exists and validate the password
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // User available, login successful
        $_SESSION['login'] = "<div class='succes'>Login Successful.</div>";
        $_SESSION['user'] = $username;//Tcheck Whether the user i slog in or not and logged in or not ,and kogout will unset it

        // Redirect to manage admin page
        header('location:' . SITEURL . 'admin/');
        exit(); // Ensure script termination after header redirection
    } else {
        // User not available, login fail
        $_SESSION['login'] = "<div class='error text-center'>Username or password did not match.</div>";

        // Redirect to Home page/deshbord
        header('location:' . SITEURL . 'admin/login.php');
        exit(); // Ensure script termination after header redirection
    }
}
?>
