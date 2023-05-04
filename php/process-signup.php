<?php
// Developed by Akhil Mathew
// The information from signup.php is sent here and added into the database if
// everything is entered correctly. Then redirected back to index.php to login
include "db_conn.php";

// Get the form data
$fnameR = $_POST['fnameRegister'];
$lnameR = $_POST['lnameRegister'];
$emailR = $_POST['emailRegister'];
$passwordR = $_POST['passwordRegister'];
$DOBR = $_POST['dateRegister'];
$user_typeR = $_POST['typeRegister'];

// Insert the new item into the database
$sql = "INSERT INTO User (User_Email, User_Password, User_FName, User_LName, User_DOB, User_Type) VALUES ('$emailR', '$passwordR', '$fnameR', '$lnameR', '$DOBR', '$user_typeR')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Account Successfully Created!";
    // header("Location: index.php");
    // exit();
} else {
    echo "Error creating account: " . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- <button><a href="index.php">Back to Login</a></button> -->
    <form method="post" action="index.php">
        <button type="submit">Go to Login</button>
    </form>
</head>
</html>

