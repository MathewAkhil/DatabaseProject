<?php
    // Developed by Cyrus Buhariwala
    // Patients delete a review using this page.

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
            header("Location: patient_reviews.php");
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient - Delete Review</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<h1>Hello, Patient <?php echo $_SESSION['fname']; ?>!</h1>
	
    <!-- Display Hotbar -->
    <h2><a href="../patient_home.php">Home</a> | <a href="patient_reviews.php">View Reviews</a> | <a href="patient_add_review.php">Add Review</a> | <a href="patient_edit_review.php">Edit Review</a> | <a href="patient_delete_review.php">Delete Review</a></h2>

    <table>
		<tr>
			<th>Appointment ID</th>
			<th>Doctor</th>
			<th>Date</th>
            <th>5 Star Rating</th>
			<th>Review</th>
			<th>Revew ID</th>
		</tr>
    
		<!-- Let's fill out the table -->
        <?php
		
		// Establish a connection to the database
		include('../db_conn.php');
        
		// Get the patient ID
		$patient_id = $_SESSION['id'];

		// Create the query
        $sql = "SELECT appointment.*, review.Star, review.Feedback_Text, review.Review_ID 
			FROM appointment
			LEFT JOIN review ON appointment.Appointment_ID = review.Appointment_ID
			WHERE appointment.Patient_ID = $patient_id";
		
		// Execute the query and fetch the results
		$result = mysqli_query($conn, $sql);
		
		// Loop through the results and display the details
		while ($row = mysqli_fetch_assoc($result)) {

			// Fetch the Doctor's Last Name
			$doctor_id = $row['Doctor_ID'];
			$doctor_query = "SELECT * FROM user where User_ID = $doctor_id";
			$doctor_result = mysqli_query($conn, $doctor_query);
			$doctor_row = mysqli_fetch_assoc($doctor_result);
			
			// Set up info to be displayed
			$Appointment_ID = $row['Appointment_ID'];
			$Doctor_LName = $doctor_row['User_LName'];
			$Appointment_Date = $row['Appointment_Date'];
			$Star_Rating = $row['Star'];
			$Feedback_Text = $row['Feedback_Text'];
			$Review_ID = $row['Review_ID'];

			// Display info on table
			echo "<tr>";
			echo "<td>" . $Appointment_ID . "</td>";
			echo "<td>Dr. " . $Doctor_LName . "</td>";
			echo "<td>" . $Appointment_Date . "</td>";
			echo "<td>" . ($Star_Rating ? $Star_Rating : "No rating yet...") . "</td>";
			echo "<td>" . ($Feedback_Text ? $Feedback_Text : "No review yet...") . "</td>";
			echo "<td>" . ($Review_ID ? $Review_ID : "N/A") . "</td>";
			echo "</tr>";
			
		}
		
		// Close the database connection
		mysqli_close($conn); ?>
		
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