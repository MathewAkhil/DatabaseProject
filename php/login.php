<?php
// Developed by Akhil Mathew
// Gets information from index.php and makes sure that email and password match with
// what is in the database. If so, the user will be redirected to the appropriate home
// page based on user type.
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

$sql = "SELECT * FROM USER WHERE User_Email='$uname' AND User_Password='$pass'"; # CHANGE THIS AFTER SPECIALIZATION IS IMPLEMENTED

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['User_Email'] === $uname && $row['User_Password'] === $pass) {
        echo "Logged In!";
        $_SESSION['user_name'] = $row['User_Email'];
        $_SESSION['fname'] = $row['User_FName'];
        $_SESSION['id'] = $row['User_ID'];
        $_SESSION['lname'] = $row['User_LName'];
        $_SESSION['user_type'] = $row['User_Type'];
        $_SESSION['pass'] = $row['User_Password']
        $_SESSION['dob'] = $row['User_DOB']
        //header("Location: home.php");
        //exit();

        if($row['User_Type'] === '2') {
            header("Location: doctor_home.php");
            exit();
        }
        else if($row['User_Type'] === '1') {
            header("Location: patient_home.php");
            exit();
        }
        else if($row['User_Type'] === '0') {
            header("Location: admin_home.php");
            exit();
        }
        else {
            // handle unknown user type
            die("This user type is unknown");
        }
    }
    else{
        header("Location: index.php?error=Incorrect User Name or Password");
        exit();
    }
}
else{
    header("Location: index.php?error=Incorrect User Name or Password");
    exit();
}