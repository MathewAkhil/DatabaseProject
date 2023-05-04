<?php
    // Developed by Cyrus Buhariwala
    // Administrators can delete a review using this page.

    session_start();
    
    // Include the database connection file
    require_once('../db_conn.php');

    // Check if the form has been submitted
    if(isset($_POST['submit'])) {

        // Get the form data
        $review_id = $_POST['review_id'];

        // Check if there is already a review for this appointment
        $query = "SELECT * FROM review WHERE Review_ID = '$review_id'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 0) {
            echo "Error: A review for this appointment does not exist. To add your review, click 'Add Review' instead of 'Delete Review'";
        }
        else {
            // Delete the review data in the database
            $query = "DELETE FROM review WHERE Review_ID = $review_id";
            $result = mysqli_query($conn, $query);
            header("Location: admin_reviews.php");
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Delete Review</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<h1>Hello, Administrator <?php echo $_SESSION['fname']; ?>!</h1>
<h2><a href="../admin_home.php">Home</a> | <a href="admin_reviews.php">Review Table</a> | <a href="admin_detailed_reviews.php">Detailed Table</a> | <a href="admin_delete_review.php">Delete Review</a></h2>	

    <table>
		<tr>
			<th>Review ID</th>
			<th>Appoinment ID</th>
			<th>Date</th>
			<th>Doctor</th>
			<th>Patient</th>
            <th>5 Star Rating</th>
			<th>Feedback Text</th>
		</tr>
    
		<!-- Let's fill out the table -->
        <?php
		
		// Establish a connection to the database
		include('../db_conn.php');
        
		// Get the patient ID
		$patient_id = $_SESSION['id'];

		// Create the query
        $sql = "SELECT review.*, appointment.Appointment_Date, appointment.Doctor_ID, appointment.Patient_ID
			FROM review
			LEFT JOIN appointment ON review.Appointment_ID = appointment.Appointment_ID";
		
		// Execute the query and fetch the results
		$result = mysqli_query($conn, $sql);
		
		// Loop through the results and display the details
		while ($row = mysqli_fetch_assoc($result)) {

			// Fetch the Doctor's Last Name
			$doctor_id = $row['Doctor_ID'];
			$doctor_query = "SELECT * FROM user where User_ID = '$doctor_id'";
			$doctor_result = mysqli_query($conn, $doctor_query);
			$doctor_row = mysqli_fetch_assoc($doctor_result);

			// Fetch the Patient's Name
			$patient_id = $row['Patient_ID'];
			$patient_query = "SELECT * FROM user where User_ID = '$patient_id'";
			$patient_result = mysqli_query($conn, $patient_query);
			$patient_row = mysqli_fetch_assoc($patient_result);		
			
			// Set up info to be displayed
			$Review_ID = $row['Review_ID'];
			$Appointment_ID = $row['Appointment_ID'];
			$Appointment_Date = $row['Appointment_Date'];
			$Doctor_LName = $doctor_row['User_LName'];
			$Patient_FName = $patient_row['User_FName'];
			$Patient_LName = $patient_row['User_LName'];
			$Star_Rating = $row['Star'];
			$Feedback_Text = $row['Feedback_Text'];
			
			// Display info on table
			echo "<tr>";
			echo "<td>" . $Review_ID . "</td>";
			echo "<td>" . $Appointment_ID . "</td>";
			echo "<td>" . $Appointment_Date . "</td>";
			echo "<td>Dr. " . $Doctor_LName . "</td>";
			echo "<td>" . $Patient_FName . " " .$Patient_LName . "</td>";
			echo "<td>" . $Star_Rating . "</td>";
			echo "<td>" . $Feedback_Text . "</td>";
			echo "</tr>";
		}
	
		// Close the database connection
		mysqli_close($conn);

		?>

	</table>

	<br><hr><br>

    <center>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <b><label for="review_id">Review ID:</label></b><br>
            <input type="text" name="review_id" required><br><br>

            <input type="submit" name="submit" value="Delete Review">

        </form>
    </center>
</body>
</html>