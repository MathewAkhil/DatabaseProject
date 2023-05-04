<?php
// Developed by Akhil Mathew
// This is when the admin chooses the doctor user type. They can see all current
// doctor profiles and edit any account's information or an account.
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    
    // Include the database connection file
    require_once('db_conn.php');

    // $doctorID = $_POST['doctorID'];

    if(isset($_POST['delete'])) {

        // Get the form data
        $doctorID = $_POST['doctorID'];
        // $checkID = "SELECT User_Type FROM user WHERE User_ID = '$doctorID'";

        // Check if there is already a user
        $query = "SELECT * FROM user WHERE User_ID = '$doctorID'";
        $result = mysqli_query($conn, $query);

        $q = "SELECT * FROM doctor WHERE User_ID = '$doctorID'";
        $r = mysqli_query($conn, $q);
        if(mysqli_num_rows($result) == 0 && mysqli_num_rows($r) == 0) {
            echo "Error: This account does not exist";
        }
        // else if($checkID != 2) {
        //     echo "Error: This user is not a doctor";
        // }
        else {

            $checkID = "SELECT User_Type FROM user WHERE User_ID = '$doctorID'";
            $checkResult = mysqli_query($conn, $checkID);

            $row = mysqli_fetch_assoc($result);
            $userType = $row['User_Type'];
            
            if($userType != 2) {
                // echo $userType;
                echo "Error: This user is not a doctor";
            }
            else {
                // Delete the review data in the database
                $query1 = "DELETE FROM user WHERE User_ID = $doctorID";
                $result1 = mysqli_query($conn, $query1);

                $query2 = "DELETE FROM doctor WHERE User_ID = $doctorID";
                $result2 = mysqli_query($conn, $query2);
                header("Location: admin_doctor_profile.php");
            }
        }
    }
    // Check if the form has been submitted
    if(isset($_POST['submit'])) {

        // Get the form data
        $doctorID = $_POST['doctorID'];
        $fnameDU = $_POST['fnameDoctorUpdate'];
        $lnameDU = $_POST['lnameDoctorUpdate'];
        $emailDU = $_POST['emailDoctorUpdate'];
        $passwordDU = $_POST['passwordDoctorUpdate'];
        $dobDU = $_POST['dobDoctorUpdate'];
        $specialityDU = $_POST['specialityDoctorUpdate'];


        // Check if there is already a review for this appointment
        if(empty($fnameDU) && empty($lnameDU) && empty($emailDU) && empty($passwordDU) && empty($dobDU) && empty($specialityDU)){
            header("Location: admin_doctor_profile.php");
        }
        else{
            $query = "SELECT * FROM user WHERE User_ID = '$doctorID'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) == 0) {
                echo "Error: This user does not exist. Please verify the info you have input and try again.";
            }
            // else if($checkID != 2) {
            //     echo "Error: This user is not a doctor";
            // }
            else {

                $checkID = "SELECT User_Type FROM user WHERE User_ID = '$doctorID'";
                $checkResult = mysqli_query($conn, $checkID);

                $row = mysqli_fetch_assoc($result);
                $userType = $row['User_Type'];

                if($userType != 2) {
                    // echo $userType;
                    echo "Error: This user is not a doctor";
                }
                else {

                    $query = "UPDATE user SET ";
                    $count = 0;
                    if (!empty($fnameDU)) {
                        $query .= "User_FName='$fnameDU',";
                        $count = 1;
                    }

                    if (!empty($lnameDU)) {
                        $query .= "User_LName='$lnameDU',";
                        $count = 1;
                    }

                    if (!empty($emailDU)) {
                        $query .= "User_Email='$emailDU',";
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
                    header("Location: admin_doctor_profile.php");
                }
            }
        }
    }
?>

<html>
<head>
    <title>Doctor Profile</title>
</head>
<body>

<h1>Profile Page</h1>
<h2>Doctor Information</h2>
    <?php
        // Include the database connection file
        require_once('db_conn.php');
        
        $sql5 = "SELECT * FROM `user` WHERE User_Type = '2'";
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
            echo "There are no doctors";
        }
    ?>

    <h2>Doctor Specialties</h2>
        <?php
            // Include the database connection file
            require_once('db_conn.php');
            
            $sql6 = "SELECT * FROM `doctor`";
            // $sql5 = "SELECT * FROM `user`";
            $result6 = mysqli_query($conn, $sql6);
            
            if ($result6->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>User ID</th><th>Doctor Speciality</th></tr>";
            
                while($row = $result6->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["User_ID"] . "</td>";
                    echo "<td>" . $row["Doctor_Speciality"] . "</td>";
                    echo "</tr>";
                }
                
                echo "</table>";
            } else {
                echo "There are no doctors";
            }
        ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <div>
            <label for="doctorID">User ID</label>
            <input type="text" name="doctorID" required>
        </div>

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
    <h3><a href="admin_home.php">Home</a></h3>
    <h3><a href="admin_profile.php">User Selection</a></h3>
</body>
</html>