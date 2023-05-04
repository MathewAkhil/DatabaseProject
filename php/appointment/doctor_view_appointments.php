<?php

//Developed by Yingchen Dong
//Doctors can view and delete their current appointments in this page

session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>View Appointments</title>
	<link rel="stylesheet" href="../styles.css">
</head>
<body>
<h1>Doctor <?php echo $_SESSION['fname']; ?></h1>
<h2>Your Id:  <?php echo $_SESSION['id']; ?></h1>
	<h2>View your Appointments</h2>

	<table>
		<tr>
			<th>Appointment ID</th>
			<th>Patient ID</th>
			<th>Doctor ID</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Date</th>
			<th>Action</th>
		</tr>

		<?php
		
		// Establish a connection to the database
		include('../db_conn.php');

		// Check if delete button is clicked
		if(isset($_POST['delete'])) {
			// Get the appointment ID to be deleted
			$appointment_id = $_POST['appointment_id'];

			// Delete the appointment from the database
			$sql = "DELETE FROM appointment WHERE Appointment_ID = '$appointment_id'";
			if(mysqli_query($conn, $sql)) {
				echo "Appointment deleted successfully.";
			} else {
				echo "Error deleting appointment: " . mysqli_error($conn);
			}
		}

       
            $doctor_id = $_SESSION['id'];
            $sql = "SELECT * FROM appointment WHERE Doctor_ID = '$doctor_id'";
		    $result = mysqli_query($conn, $sql);
        

		// Display each appointment in a row of the table
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>" . $row['Appointment_ID'] . "</td>";
			echo "<td>" . $row['Patient_ID'] . "</td>";
			echo "<td>" . $row['Doctor_ID'] . "</td>";
			echo "<td>" . $row['Appointment_StartTime'] . "</td>";
			echo "<td>" . $row['Appointment_EndTime'] . "</td>";
			echo "<td>" . $row['Appointment_Date'] . "</td>";
			echo "<td>";
            echo "<a href='doctor_update_appointment.php?id=" . $row['Appointment_ID'] . "&doctor_id=" . $doctor_id . "'>Update</a>";
			echo "<form method='post' action=''>";
			echo "<input type='hidden' name='appointment_id' value='" . $row['Appointment_ID'] . "'/>";
			echo "<input type='submit' name='delete' value='Delete'>";
			echo "</form>";
			echo "</td>";
			echo "</tr>";
		}

		// Close the database connection
		mysqli_close($conn);
		?>

	</table>

	<br>
	<a href="../doctor_home.php">Home</a>
	<br><br>
	<a href="doctor_appointment.php">make another appointment</a>

</body>
</html>

