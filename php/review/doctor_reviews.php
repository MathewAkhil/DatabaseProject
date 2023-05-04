<?php session_start();
    // Developed by Cyrus Buhariwala
    // Doctors can view reviews for THEIR OWN appointments using this page.
	// Doctors can ONLY view the reviews, as they should not be able to add/edit/delete their own reviews.
		// To delete a review, they would have to ask an administrator to do so.
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../styles.css">
	<title>Doctor - View Reviews</title>
</head>
<body>
<h1>Hello, Dr. <?php echo $_SESSION['lname']; ?>!</h1>
	<h2>Viewing Your Reviews | <a href="../doctor_home.php">Home</a></h2>

	<table>
		<tr>
			<th>Patient's First Name</th>
			<th>Patient's Last Name</th>
			<th>Date</th>
            <th>5 Star Rating</th>
			<th>Review</th>
		</tr>
    
		<!-- Let's fill the table -->
        <?php
		
		// Establish a connection to the database
		include('../db_conn.php');
        
		// Get the patient ID
		$doctor_id = $_SESSION['id'];

		// Create the query
        $sql = "SELECT appointment.*, review.Star, review.Feedback_Text 
			FROM appointment
			LEFT JOIN review ON appointment.Appointment_ID = review.Appointment_ID
			WHERE appointment.Doctor_ID = $doctor_id";
		
		// Execute the query and fetch the results
		$result = mysqli_query($conn, $sql);
		
		// Loop through the results and display the details
		while ($row = mysqli_fetch_assoc($result)) {
			
			// Fetch the Doctor's Last Name
			$patient_id = $row['Patient_ID'];
			$patient_query = "SELECT * FROM user where User_ID = $patient_id";
			$patient_result = mysqli_query($conn, $patient_query);
			$patient_row = mysqli_fetch_assoc($patient_result);
			
			// Set up info to be displayed
			//$Appointment_ID = $row['Appointment_ID'];
			$Patient_FName = $patient_row['User_FName'];
			$Patient_LName = $patient_row['User_LName'];
			$Appointment_Date = $row['Appointment_Date'];
			$Star_Rating = $row['Star'];
			$Feedback_Text = $row['Feedback_Text'];

			// Display info on table
			echo "<tr>";
			//echo "<td>" . $Appointment_ID . "</td>";
			echo "<td>" . $Patient_FName . "</td>";
			echo "<td>" . $Patient_LName . "</td>";
			echo "<td>" . $Appointment_Date . "</td>";
			echo "<td>" . ($Star_Rating ? $Star_Rating : "No rating yet...") . "</td>";
			echo "<td>" . ($Feedback_Text ? $Feedback_Text : "No review yet...") . "</td>";
			echo "</tr>";

		}
		
		echo "</table>";

		// Close the database connection
		mysqli_close($conn);

		?>
</body>
</html>