<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Appointments</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		th {
			background-color: #4CAF50;
			color: white;
		}
	</style>
</head>
<body>
<h1>Hello, Patient <?php echo $_SESSION['fname']; ?>!</h1>
	<h2>Make your appointments</h2>

	<table>
		<tr>
			<th>Appointment ID</th>
			<th>Doctor ID</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Date</th>
			<th>Action</th>
		</tr>

		<?php
		
		// Establish a connection to the database
		include('../db_conn.php');

		// Check if join button is clicked
		if(isset($_POST['join'])) {
			// Get the patient ID
			$patient_id = $_SESSION['id'];

			// Get the appointment ID to be joined
			$appointment_id = $_POST['appointment_id'];

			// Insert the patient ID into the appointment record
			$sql = "UPDATE appointment SET Patient_ID = '$patient_id' WHERE Appointment_ID = '$appointment_id'";
			if(mysqli_query($conn, $sql)) {
				echo "Appointment joined successfully.";
			} else {
				echo "Error joining appointment: " . mysqli_error($conn);
			}
		}

		$sql = "SELECT * FROM appointment";
		$result = mysqli_query($conn, $sql);

		// Display each appointment in a row of the table
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>" . $row['Appointment_ID'] . "</td>";
			echo "<td>" . $row['Doctor_ID'] . "</td>";
			echo "<td>" . $row['Appointment_StartTime'] . "</td>";
			echo "<td>" . $row['Appointment_EndTime'] . "</td>";
			echo "<td>" . $row['Appointment_Date'] . "</td>";
			echo "<td>";
			if (empty($row['Patient_ID'])) {
				echo "<form method='post' action=''>";
				echo "<input type='hidden' name='appointment_id' value='" . $row['Appointment_ID'] . "'/>";
				echo "<input type='submit' name='join' value='Join'>";
				echo "</form>";
			} else {
				echo "Joined";
			}
			echo "</td>";
			echo "</tr>";
		}

		// Close the database connection
		mysqli_close($conn);
		?>

	</table>

	<br>
	<a href="../patient_home.php">Home</a>
	<br><br>
    <a href="patient_view_appointments.php">View my appointments</a>

</body>
</html>
