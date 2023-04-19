<?php
session_start();
include "db_conn.php";

if(isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$uname = validate($_POST['uname']);
$pass = validate($_POST['password']);

if(empty($uname)) {
    header ("Location: index.php?error=User Name is required"); #erro
    exit();
}
else if(empty($pass)) {
    header ("Location: index.php?error=Password is required");
    exit();
}

$sql = "SELECT * FROM PATIENT WHERE Patient_Email='$uname' AND Patient_Password='$pass'"; # CHANGE THIS AFTER SPECIALIZATION IS IMPLEMENTED

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['Patient_Email'] === $uname && $row['Patient_Password'] === $pass) {
        echo "Logged In!";
        $_SESSION['user_name'] = $row['Patient_Email'];
        $_SESSION['name'] = $row['Patient_FName'];
        $_SESSION['id'] = $row['Patient_ID'];
        header("Location: home.php");
        exit();
    }
    else{
        header("Location: index.php?error=Incorrect User Name or Password");
        exit();
    }
}
else{
    header("Location: index.php");
    exit();
}