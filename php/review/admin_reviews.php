<?php session_start();
    // Developed by Cyrus Buhariwala
    // Administrators can view ALL reviews with the pure review table with this page.
	// Administrator can ONLY delete reviews, as they should not be able to leave or edit reviews.
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../styles.css">
	<title>Admin - View Reviews</title>
</head>
	
<body>
<h1>Hello, Administrator <?php echo $_SESSION['fname']; ?>!</h1>
	<h2><a href="../admin_home.php">Home</a> | <a href="admin_reviews.php">Review Table</a> | <a href="admin_detailed_reviews.php">Detailed Table</a> | <a href="admin_delete_review.php">Delete Review</a></h2>

	<table>
		<tr>
			<th>Review ID</th>
			<th>Appoinment ID</th>
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
        $sql = "SELECT * FROM review";
		
		// Execute the query and fetch the results
		$result = mysqli_query($conn, $sql);
		
		// Loop through the results and display the details
		while ($row = mysqli_fetch_assoc($result)) {
			
			// Set up info to be displayed
			$Review_ID = $row['Review_ID'];
			$Appointment_ID = $row['Appointment_ID'];
			$Star_Rating = $row['Star'];
			$Feedback_Text = $row['Feedback_Text'];
			

			// Display info on table
			echo "<tr>";
			echo "<td>" . $Review_ID . "</td>";
			echo "<td>" . $Appointment_ID . "</td>";
			echo "<td>" . $Star_Rating . "</td>";
			echo "<td>" . $Feedback_Text . "</td>";
			echo "</tr>";
		}
	
		// Close the database connection
		mysqli_close($conn);

		?>
	
	</table>

	<br><hr><br>

</body>
</html>