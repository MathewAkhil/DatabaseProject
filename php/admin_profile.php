<?php
// Developed by Akhil Mathew
// On this page, the admin will choose which user type they want to view and change
// based on that, they are redirected to the right page.
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    
    // Include the database connection file
    require_once('db_conn.php');

    // If submit is clicked, then go to the correct php file
    if(isset($_POST['submit'])) {
        $userType = $_POST['userType'];

        if($userType == 1) {
            header("Location: admin_patient_profile.php");
        }
        else if($userType == 2) {
            header("Location: admin_doctor_profile.php");
        }
        else if($userType == 0){
            header("Location: admin_actual_profile.php");
        }
        else {
            echo "Error: Please input a valid user type";
        }
    }
?>

<html>
<head>
    <title>Choose User</title>
</head>
<body>

<h1>User Selection</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <div>
            <label for="userType">User Type</label>
            <input type="text" name="userType" required>
        </div>

        <div>
            <input type="submit" name="submit" value="Submit">
        </div>

    </form>
    <h3><a href="admin_home.php">Home</a></h3>
</body>
</html>