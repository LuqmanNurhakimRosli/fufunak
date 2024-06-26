<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';

    $name = $_POST['name'];
    $message = $_POST['message'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];

    // Prepare an insert statement
    $query = "INSERT INTO contact_us (name, message, email, subject) VALUES (?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($con, $query)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssss", $name, $message, $email, $subject);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $lastId = mysqli_insert_id($con);
            if (!empty($lastId)) {
                $message = "Your contact information is saved successfully";
            }
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($con);

    header("Location: contact.php");
    exit();
}
?>