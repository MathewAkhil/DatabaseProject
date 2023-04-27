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

	<h2>Admin View Appointments</h2>

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

		// Fetch all appointments from the database
		$sql = "SELECT * FROM appointment";
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
			echo "<a href='admin_update_appointment.php?id=" . $row['Appointment_ID'] . "'>Update</a>";
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
	<a href="../admin_home.php">Home</a>
	<br><br>
	<a href="admin_appointment.php">make another appointment</a>

</body>
</html>



