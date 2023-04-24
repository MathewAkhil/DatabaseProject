<?php
include "db_conn.php";

// Get the form data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$DOB = $_POST['DOB'];
$user_type = $_POST['user_type'];

// Insert the new item into the database
$sql = "INSERT INTO User (User_Email, User_Password, User_FName, User_LName, User_DOB, User_Type) VALUES ('$email', '$password', '$fname', '$lname', '$DOB', '$user_type')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "User Added!";
} else {
    echo "Error adding new user: " . mysqli_error($conn);
}
?>