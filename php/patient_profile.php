<?php
// Developed by Akhil Mathew
// This is the profile page for the patients. They can update their information and
// that update will be reflected in the database. They can also delete their account
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    
    // Include the database connection file
    require_once('db_conn.php');

    if(isset($_POST['delete'])) {

        // Get the form data
        $patientID = $_SESSION['id'];

        // Check if there is already a user
        $query = "SELECT * FROM user WHERE User_ID = '$patientID'";
        $result = mysqli_query($conn, $query);

        $q = "SELECT * FROM patient WHERE User_ID = '$patientID'";
        $r = mysqli_query($conn, $q);
        if(mysqli_num_rows($result) == 0 && mysqli_num_rows($r) == 0) {
            echo "Error: This account does not exist";
        }
        else {
            // Delete the review data in the database
            $query1 = "DELETE FROM user WHERE User_ID = $patientID";
            $result1 = mysqli_query($conn, $query1);

            $query2 = "DELETE FROM patient WHERE User_ID = $patientID";
            $result2 = mysqli_query($conn, $query2);
            header("Location: index.php");
        }
    }
    // Check if the form has been submitted
    if(isset($_POST['submit'])) {

        // Get the form data
        $patientID = $_SESSION['id'];
        $fnamePU = $_POST['fnamePatientUpdate'];
        $lnamePU = $_POST['lnamePatientUpdate'];
        $emailPU = $_POST['emailPatientUpdate'];
        $passwordPU = $_POST['passwordPatientUpdate'];
        $dobPU = $_POST['dobPatientUpdate'];
        $allergenPU = $_POST['allergenPatientUpdate'];


        // Check if there is already a review for this appointment
        if(empty($fnamePU) && empty($lnamePU) && empty($emailPU) && empty($passwordPU) && empty($dobPU) && empty($allergenPU)){
            header("Location: patient_profile.php");
        }
        else{
            $query = "SELECT * FROM user WHERE User_ID = '$patientID'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) == 0) {
                echo "Error: This user does not exist. Please verify the info you have input and try again.";
            }
            else {
                $query = "UPDATE user SET ";
                $count = 0;
                if (!empty($fnamePU)) {
                    $query .= "User_FName='$fnamePU',";
                    $_SESSION['fname'] = $fnamePU;
                    $count = 1;
                }

                if (!empty($lnamePU)) {
                    $query .= "User_LName='$lnamePU',";
                    $_SESSION['lname'] = $lnamePU;
                    $count = 1;
                }

                if (!empty($emailPU)) {
                    $query .= "User_Email='$emailPU',";
                    $_SESSION['user_name'] = $emailPU;
                    $count = 1;
                }

                if (!empty($passwordPU)) {
                    $query .= "User_Password='$passwordPU',";
                    $count = 1;
                }

                if (!empty($dobPU)) {
                    $query .= "User_DOB='$dobPU',";
                    $count = 1;
                }

                $query = rtrim($query, ","); // Remove the trailing comma
                $query .= " WHERE User_ID='$patientID'";
                
                if($count == 1) {
                    $result = mysqli_query($conn, $query);
                }

                if(!empty($allergenPU)) {
                    $patientQuery = "UPDATE patient SET Patient_Allergens='$allergenPU' WHERE User_ID='$patientID'";
                    $result2 = mysqli_query($conn, $patientQuery);
                }
                header("Location: patient_home.php");
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
            <label for="fnamePatientUpdate">First Name</label>
            <input type="text" name="fnamePatientUpdate">
        </div>

        <div>
            <label for="lnamePatientUpdate">Last Name</label>
            <input type="text" name="lnamePatientUpdate">
        </div>

        <div>
            <label for="emailPatientUpdate">Email</label>
            <input type="email" name="emailPatientUpdate">
        </div>

        <div>
            <label for="passwordPatientUpdate">Password</label>
            <input type="text" name="passwordPatientUpdate">
        </div>

        <div>
            <label for="dobPatientUpdate">DOB</label>
            <input type="date" name="dobPatientUpdate">
        </div>

        <div>
            <label for="allergenPatientUpdate">Allergens</label>
            <input type="text" name="allergenPatientUpdate">
        </div>

        <div>
            <input type="submit" name="submit" value="Save Changes">
        </div>

        <br></br>
        <div>
            <input type="submit" name="delete" value="Delete Account">
        </div>
        

    </form>
    <h3><a href="patient_home.php">Home</a></h3>
</body>
</html>