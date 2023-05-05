<?php
// Developed by Akhil Mathew
// This is the profile page for the doctor. They can update their information and
// that update will be reflected in the database. They can also delete their account
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    
    // Include the database connection file
    require_once('db_conn.php');

    // If the delete button is clicked, do this
    if(isset($_POST['delete'])) {

        // Get the form data
        $doctorID = $_SESSION['id'];

        // Check if there is already a user
        $query = "SELECT * FROM user WHERE User_ID = '$doctorID'";
        $result = mysqli_query($conn, $query);

        $q = "SELECT * FROM doctor WHERE User_ID = '$doctorID'";
        $r = mysqli_query($conn, $q);
        if(mysqli_num_rows($result) == 0 && mysqli_num_rows($r) == 0) {
            echo "Error: This account does not exist";
        }
        else {
            // Delete the doctor data in the database
            $query1 = "DELETE FROM user WHERE User_ID = $doctorID";
            $result1 = mysqli_query($conn, $query1);

            $query2 = "DELETE FROM doctor WHERE User_ID = $doctorID";
            $result2 = mysqli_query($conn, $query2);
            header("Location: index.php");
        }
    }
    // Check if the form has been submitted
    if(isset($_POST['submit'])) {

        // Get the form data
        $doctorID = $_SESSION['id'];
        $fnameDU = $_POST['fnameDoctorUpdate'];
        $lnameDU = $_POST['lnameDoctorUpdate'];
        $emailDU = $_POST['emailDoctorUpdate'];
        $passwordDU = $_POST['passwordDoctorUpdate'];
        $dobDU = $_POST['dobDoctorUpdate'];
        $specialityDU = $_POST['specialityDoctorUpdate'];


        // Error checking
        if(empty($fnameDU) && empty($lnameDU) && empty($emailDU) && empty($passwordDU) && empty($dobDU) && empty($specialityDU)){
            header("Location: doctor_profile.php");
        }
        else{
            $query = "SELECT * FROM user WHERE User_ID = '$doctorID'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) == 0) {
                echo "Error: This user does not exist. Please verify the info you have input and try again.";
            }
            else {
                $query = "UPDATE user SET ";
                $count = 0;
                if (!empty($fnameDU)) {
                    $query .= "User_FName='$fnameDU',";
                    $_SESSION['fname'] = $fnameDU;
                    $count = 1;
                }

                if (!empty($lnameDU)) {
                    $query .= "User_LName='$lnameDU',";
                    $_SESSION['lname'] = $lnameDU;
                    $count = 1;
                }

                if (!empty($emailDU)) {
                    $query .= "User_Email='$emailDU',";
                    $_SESSION['user_name'] = $emailDU;
                    $count = 1;
                }

                if (!empty($passwordDU)) {
                    $query .= "User_Password='$passwordDU',";
                    $count = 1;
                }

                if (!empty($dobDU)) {
                    $query .= "User_DOB='$dobDU',";
                    $count = 1;
                }

                $query = rtrim($query, ","); // Remove the trailing comma
                $query .= " WHERE User_ID='$doctorID'";
                
                if($count == 1) {
                    $result = mysqli_query($conn, $query);
                }

                if(!empty($specialityDU)) {
                    $doctorQuery = "UPDATE doctor SET Doctor_Speciality='$specialityDU' WHERE User_ID='$doctorID'";
                    $result2 = mysqli_query($conn, $doctorQuery);
                }
                header("Location: doctor_home.php");
            }
        }
    }
?>

<html>
<head>
    <title>Profile</title>
</head>
<body>

<h1>Profile Page</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <div>
            <label for="fnameDoctorUpdate">First Name</label>
            <input type="text" name="fnameDoctorUpdate">
        </div>

        <div>
            <label for="lnameDoctorUpdate">Last Name</label>
            <input type="text" name="lnameDoctorUpdate">
        </div>

        <div>
            <label for="emailDoctorUpdate">Email</label>
            <input type="email" name="emailDoctorUpdate">
        </div>

        <div>
            <label for="passwordDoctorUpdate">Password</label>
            <input type="text" name="passwordDoctorUpdate">
        </div>

        <div>
            <label for="dobDoctorUpdate">DOB</label>
            <input type="date" name="dobDoctorUpdate">
        </div>

        <div>
            <label for="specialityDoctorUpdate">Speciality</label>
            <input type="text" name="specialityDoctorUpdate">
        </div>

        <div>
            <input type="submit" name="submit" value="Save Changes">
        </div>

        <br></br>
        <div>
            <input type="submit" name="delete" value="Delete Account">
        </div>
        

    </form>
    <h3><a href="doctor_home.php">Home</a></h3>
</body>
</html>