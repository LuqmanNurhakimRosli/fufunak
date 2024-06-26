<?php
require('db.php');

// When form submitted, insert values into the database.
if (isset($_REQUEST['username'])) {
    // Remove backslashes and escape special characters
    $name = mysqli_real_escape_string($con, stripslashes($_REQUEST['name']));
    $username = mysqli_real_escape_string($con, stripslashes($_REQUEST['username']));
    $user_phoneNO = mysqli_real_escape_string($con, stripslashes($_REQUEST['contactnumber']));
    $email = mysqli_real_escape_string($con, stripslashes($_REQUEST['email']));
    $password = mysqli_real_escape_string($con, stripslashes($_REQUEST['password']));

    // Hash the password using password_hash
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Use a prepared statement to insert the user into the database
    $stmt = $con->prepare("INSERT INTO users (name, username, password, user_phoneNo, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $username, $hashed_password, $user_phoneNO, $email);

    if ($stmt->execute()) {
        echo "<div class='form'>
              <h3>You are registered successfully.</h3><br/>
              <p class='link'>Click here to <a href='index.php'>login</a></p>
              </div>";
    } else {
        echo "<div class='form'>
              <h3>Required fields are missing.</h3><br/>
              <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
              </div>";
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\login.css">
    <title>Registration</title>
    
</head>
<body>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="name" placeholder="Name" required />
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="contactnumber" placeholder="Contact Number" required />
        <input type="email" class="login-input" name="email" placeholder="Email Address" required />
        <input type="password" class="login-input" name="password" placeholder="Password" required />
        <input type="submit" name="submit" value="Register" class="login-button" />
        <p class="link">
            <a href="index.php">Click to Login</a>
        </p>
    </form>
</body>
</html>
