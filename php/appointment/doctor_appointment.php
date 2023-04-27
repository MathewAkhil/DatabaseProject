<?php
session_start();
// Include the database connection file
require_once('../db_conn.php');

// Set the default timezone to use
date_default_timezone_set('America/Chicago');

// Check if the form has been submitted
if(isset($_POST['submit'])) {
    // Get the form data
    $doctor_id = $_SESSION['id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $date = $_POST['date'];

    // Check if the start time is before the end time
    if(strtotime($start_time) >= strtotime($end_time)) {
        echo "Error: The start time must be before the end time.";
    } else {
        // Check if the appointment slot is already booked
        $query = "SELECT * FROM appointment WHERE Doctor_ID = '$doctor_id' AND Appointment_Date = '$date' AND ((Appointment_StartTime <= '$start_time' AND Appointment_EndTime > '$start_time') OR (Appointment_StartTime >= '$start_time' AND Appointment_StartTime < '$end_time'))";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0) {
            echo "Error: The appointment slot is already booked.";
        } else {
            // Insert the appointment data into the database
            $query = "INSERT INTO appointment (Patient_ID, Doctor_ID, Appointment_StartTime, Appointment_EndTime, Appointment_Date) VALUES ( NULL, '$doctor_id', '$start_time', '$end_time', '$date')";
            $result = mysqli_query($conn, $query);
            header("Location: doctor_view_appointments.php?id=$doctor_id");
        }
    }
}

?>

<html>
<head>
    <title>Doctor Make appointment</title>
</head>
<body>

<h1>Hello, Doctor <?php echo $_SESSION['fname']; ?>!</h1>
        <h2>Make your appointment</h2>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">



        <label for="start_time">Start Time:</label>
        <input type="time" name="start_time" required><br>

        <label for="end_time">End Time:</label>
        <input type="time" name="end_time" required><br>

        <label for="date">Date:</label>
        <input type="date" name="date" required><br>

        <input type="submit" name="submit" value="Make Appointment">

    </form>
    <a href="../doctor_home.php">Home</a>
    <br><br>
    <a href="doctor_view_appointments.php?id=<?php echo $doctor_id; ?>">View appointments</a>
</body>
</html>