<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    
    // Include the database connection file
    require_once('db_conn.php');

    if(isset($_POST['delete'])) {

        // Get the form data
        $patientID = $_POST['patientID'];
        // $checkID = "SELECT User_Type FROM user WHERE User_ID = '$patientID'";
        
        // Check if there is already a user
        $query = "SELECT * FROM user WHERE User_ID = '$patientID'";
        $result = mysqli_query($conn, $query);

        $q = "SELECT * FROM patient WHERE User_ID = '$patientID'";
        $r = mysqli_query($conn, $q);
        if(mysqli_num_rows($result) == 0 && mysqli_num_rows($r) == 0) {
            echo "Error: This account does not exist";
        }
        // else if($checkID != 1) {
        //     echo "Error: This user is not a patient";
        // }
        else {

            $checkID = "SELECT User_Type FROM user WHERE User_ID = '$patientID'";
            $checkResult = mysqli_query($conn, $checkID);

            $row = mysqli_fetch_assoc($result);
            $userType = $row['User_Type'];
            
            if($userType != 1) {
                // echo $userType;
                echo "Error: This user is not a patient";
            }
            else {
                // Delete the review data in the database
                $query1 = "DELETE FROM user WHERE User_ID = $patientID";
                $result1 = mysqli_query($conn, $query1);

                $query2 = "DELETE FROM patient WHERE User_ID = $patientID";
                $result2 = mysqli_query($conn, $query2);
                header("Location: admin_patient_profile.php");
            }
        }
    }
    // Check if the form has been submitted
    if(isset($_POST['submit'])) {

        // Get the form data
        // $patientID = $_POST['patientID'];
        $fnamePU = $_POST['fnamePatientUpdate'];
        $lnamePU = $_POST['lnamePatientUpdate'];
        $emailPU = $_POST['emailPatientUpdate'];
        $passwordPU = $_POST['passwordPatientUpdate'];
        $dobPU = $_POST['dobPatientUpdate'];
        $allergenPU = $_POST['allergenPatientUpdate'];
        // $changeUserPU = $_POST['changePatientUser'];

        $patientID = $_POST['patientID'];
        // $checkID = "SELECT User_Type FROM user WHERE User_ID = '$patientID'";

        // Check if there is already a review for this appointment
        if(empty($fnamePU) && empty($lnamePU) && empty($emailPU) && empty($passwordPU) && empty($dobPU) && empty($allergenPU) && empty($changeUserPU)){
            header("Location: admin_patient_profile.php");
        }
        else{
            $query = "SELECT * FROM user WHERE User_ID = '$patientID'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) == 0) {
                echo "Error: This user does not exist. Please verify the info you have input and try again.";
            }
            else {

                $checkID = "SELECT User_Type FROM user WHERE User_ID = '$patientID'";
                $checkResult = mysqli_query($conn, $checkID);

                $row = mysqli_fetch_assoc($result);
                $userType = $row['User_Type'];
                
                if($userType != 1) {
                    // echo $userType;
                    echo "Error: This user is not a patient";
                }
                else {
                    $query = "UPDATE user SET ";
                    $count = 0;
                    if (!empty($fnamePU)) {
                        $query .= "User_FName='$fnamePU',";
                        $count = 1;
                    }

                    if (!empty($lnamePU)) {
                        $query .= "User_LName='$lnamePU',";
                        $count = 1;
                    }

                    if (!empty($emailPU)) {
                        $query .= "User_Email='$emailPU',";
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

                    // if (!empty($changeUserPU)) {
                    //     $query .= "User_Type='$changeUserPU',";
                    // }

                    $query = rtrim($query, ","); // Remove the trailing comma
                    $query .= " WHERE User_ID='$patientID'";
                    
                    if($count == 1) {
                        $result = mysqli_query($conn, $query);
                    }

                    if(!empty($allergenPU)) {
                        $patientQuery = "UPDATE patient SET Patient_Allergens='$allergenPU' WHERE User_ID='$patientID'";
                        $result2 = mysqli_query($conn, $patientQuery);
                    }
                    header("Location: admin_patient_profile.php");
                }
            }
        }
    }
?>

<html>
<head>
    <title>Patient Profile</title>
</head>
<body>

<h1>Profile Page</h1>
    <h2>Doctor Information</h2>
        <?php
            // Include the database connection file
            require_once('db_conn.php');
            
            $sql5 = "SELECT * FROM `user` WHERE User_Type = '1'";
            // $sql5 = "SELECT * FROM `user`";
            $result5 = mysqli_query($conn, $sql5);
            
            if ($result5->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>User ID</th><th>Email</th><th>Password</th><th>First Name</th><th>Last Name</th><th>DOB</th><th>User Type</th></tr>";
            
                while($row = $result5->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["User_ID"] . "</td>";
                    echo "<td>" . $row["User_Email"] . "</td>";
                    echo "<td>" . $row["User_Password"] . "</td>";
                    echo "<td>" . $row["User_FName"] . "</td>";
                    echo "<td>" . $row["User_LName"] . "</td>";
                    echo "<td>" . $row["User_DOB"] . "</td>";
                    echo "<td>" . $row["User_Type"] . "</td>";
                    echo "</tr>";
                }
                
                echo "</table>";
            } else {
                echo "There are no patients";
            }
        ?>

        <h2>Patient Information</h2>
            <?php
                // Include the database connection file
                require_once('db_conn.php');
                
                $sql6 = "SELECT * FROM `patient`";
                // $sql5 = "SELECT * FROM `user`";
                $result6 = mysqli_query($conn, $sql6);
                
                if ($result6->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>User ID</th><th>Address ID</th><th>Patient Allergens</th></tr>";
                
                    while($row = $result6->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["User_ID"] . "</td>";
                        echo "<td>" . $row["Address_ID"] . "</td>";
                        echo "<td>" . $row["Patient_Allergens"] . "</td>";
                        echo "</tr>";
                    }
                    
                    echo "</table>";
                } else {
                    echo "There are no patients";
                }
            ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <div>
            <label for="patientID">User ID</label>
            <input type="text" name="patientID" required>
        </div>

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

        <!-- <div>
            <label for="changePatientUser">User Type</label>
            <input type="text" name="changePatientUser">
        </div> -->

        <div>
            <input type="submit" name="submit" value="Save Changes">
        </div>

        <br></br>
        <div>
            <input type="submit" name="delete" value="Delete Account">
        </div>
        

    </form>
    <h3><a href="admin_home.php">Home</a></h3>
    <h3><a href="admin_profile.php">User Selection</a></h3>
</body>
</html>