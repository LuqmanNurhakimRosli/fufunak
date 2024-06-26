<?php
session_start();
require('db.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle form submission for updating profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, stripslashes($_POST['username']));
    $user_phoneNo = mysqli_real_escape_string($con, stripslashes($_POST['user_phoneNo']));
    $email = mysqli_real_escape_string($con, stripslashes($_POST['email']));
    $password = mysqli_real_escape_string($con, stripslashes($_POST['password']));

    // Hash the password before storing it (ensure secure hashing)
    $hashed_password = md5($password); // Replace md5 with a more secure hash function if possible

    $update_query = "UPDATE users SET username='$username', user_phoneNo='$user_phoneNo', email='$email', password='$hashed_password' WHERE user_id='$user_id'";

    if ($con->query($update_query) === TRUE) {
        echo "Profile updated successfully";
    } else {
        echo "Error updating profile: " . $con->error;
    }
}

// Retrieve user data
$query = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h1>Profile Page</h1>
    <form method="POST" action="">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>"><br><br>
        
        <label for="user_phoneNo">Phone Number:</label><br>
        <input type="text" id="user_phoneNo" name="user_phoneNo" value="<?php echo $user['user_phoneNo']; ?>"><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" value=""><br><br>
        
        <input type="submit" value="Update Profile">
    </form>
</body>
</html>
