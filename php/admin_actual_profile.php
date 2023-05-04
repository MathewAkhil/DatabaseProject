<?php
// Developed by Akhil Mathew
// This is when the admin chooses the admin user type. They can see all current
// admin profiles (including thiers) and edit any of account's information or 
// delete their account.
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    
    // Include the database connection file
    require_once('db_conn.php');

    // $doctorID = $_POST['doctorID'];

    if(isset($_POST['delete'])) {

        // Get the form data
        $adminID = $_POST['adminID'];
        // $checkID = "SELECT User_Type FROM user WHERE User_ID = '$doctorID'";

        // Check if there is already a user
        $query = "SELECT * FROM user WHERE User_ID = '$adminID'";
        $result = mysqli_query($conn, $query);

        $q = "SELECT * FROM doctor WHERE User_ID = '$adminID'";
        $r = mysqli_query($conn, $q);
        if(mysqli_num_rows($result) == 0 && mysqli_num_rows($r) == 0) {
            echo "Error: This account does not exist";
        }
        else {

            $checkID = "SELECT User_Type FROM user WHERE User_ID = '$adminID'";
            $checkResult = mysqli_query($conn, $checkID);

            $row = mysqli_fetch_assoc($result);
            $userType = $row['User_Type'];
            
            if($userType != 0) {
                // echo $userType;
                echo "Error: This user is not an admin";
            }
            else {
                // Delete the review data in the database
                $query1 = "DELETE FROM user WHERE User_ID = $adminID";
                $result1 = mysqli_query($conn, $query1);

                if($adminID == $_SESSION['id']) {
                    session_unset();
                    session_destroy();
                    header("Location: index.php");
                }
                else {
                    header("Location: admin_actual_profile.php");
                }
            }
        }
    }
    // Check if the form has been submitted
    if(isset($_POST['submit'])) {

        // Get the form data
        $adminID = $_POST['adminID'];
        $fnameDU = $_POST['fnameAdminUpdate'];
        $lnameDU = $_POST['lnameAdminUpdate'];
        $emailDU = $_POST['emailAdminUpdate'];
        $passwordDU = $_POST['passwordAdminUpdate'];
        $dobDU = $_POST['dobAdminUpdate'];
        // $changeUserAU = $_POST['changeAdminUser'];


        // Check if there is already a review for this appointment
        if(empty($fnameDU) && empty($lnameDU) && empty($emailDU) && empty($passwordDU) && empty($dobDU) && empty($changeUserAU)){
            header("Location: admin_actual_profile.php");
        }
        else{
            $query = "SELECT * FROM user WHERE User_ID = '$adminID'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) == 0) {
                echo "Error: This user does not exist. Please verify the info you have input and try again.";
            }
            else {

                $checkID = "SELECT User_Type FROM user WHERE User_ID = '$adminID'";
                $checkResult = mysqli_query($conn, $checkID);

                $row = mysqli_fetch_assoc($result);
                $userType = $row['User_Type'];

                if($userType != 0) {
                    // echo $userType;
                    echo "Error: This user is not an admin";
                }
                else {

                    $query = "UPDATE user SET ";
                    if (!empty($fnameDU)) {
                        $query .= "User_FName='$fnameDU',";

                        if($adminID == $_SESSION['id']) {
                            $_SESSION['fname'] = $fnameDU;
                        }
                    }

                    if (!empty($lnameDU)) {
                        $query .= "User_LName='$lnameDU',";
                    }

                    if (!empty($emailDU)) {
                        $query .= "User_Email='$emailDU',";
                    }

                    if (!empty($passwordDU)) {
                        $query .= "User_Password='$passwordDU',";
                    }

                    if (!empty($dobDU)) {
                        $query .= "User_DOB='$dobDU',";
                    }

                    // if (!empty($changeUserAU)) {
                    //     $query .= "User_Type='$changeUserAU',";
                    // }

                    $query = rtrim($query, ","); // Remove the trailing comma
                    $query .= " WHERE User_ID='$adminID'";
                    
                    $result = mysqli_query($conn, $query);
                    header("Location: admin_actual_profile.php");
                }
            }
        }
    }
?>

<html>
<head>
    <title>Admin Profile</title>
</head>
<body>

<h1>Profile Page</h1>
    <h2>Admin Information</h2>
            <?php
                // Include the database connection file
                require_once('db_conn.php');
                
                $sql5 = "SELECT * FROM `user` WHERE User_Type = '0'";
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
                    echo "There are no admins";
                }
            ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <div>
            <label for="adminID">User ID</label>
            <input type="text" name="adminID" required>
        </div>

        <div>
            <label for="fnameAdminUpdate">First Name</label>
            <input type="text" name="fnameAdminUpdate">
        </div>

        <div>
            <label for="lnameAdminUpdate">Last Name</label>
            <input type="text" name="lnameAdminUpdate">
        </div>

        <div>
            <label for="emailAdminUpdate">Email</label>
            <input type="email" name="emailAdminUpdate">
        </div>

        <div>
            <label for="passwordAdminUpdate">Password</label>
            <input type="text" name="passwordAdminUpdate">
        </div>

        <div>
            <label for="dobAdminUpdate">DOB</label>
            <input type="date" name="dobAdminUpdate">
        </div>

        <!-- <div>
            <label for="changeAdminUser">User Type</label>
            <input type="text" name="changeAdminUser">
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