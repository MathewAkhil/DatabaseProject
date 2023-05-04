<?php session_start();
	// Developed by Cyrus Buhariwala
    // Patients can view reviews for THEIR OWN appointments using this page.
	// Doctors can ONLY view their reviews, as they should not be able to add/edit/delete reviews for themselves.
		// To delete a review, they would have to ask an administrator to do so.
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../styles.css">
	<title>Patient - View Reviews</title>
</head>
	
<body>
<h1>Hello, Patient <?php echo $_SESSION['fname']; ?>!</h1>
	<h2>Viewing Possible Reviews | <a href="../patient_home.php">Home</a></h2>

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
		
		echo "</table>";

		// Close the database connection
		mysqli_close($conn); ?>
		
		</table>
	<h3><a href="patient_add_review.php">Add Review</a> | <a href="patient_edit_review.php">Edit Review</a> | <a href="patient_delete_review.php">Delete Review</a></h3>
</body>
</html>