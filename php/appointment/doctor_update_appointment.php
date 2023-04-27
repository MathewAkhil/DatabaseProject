<?php
session_start();
// Connect to database
include("../db_conn.php");

// Check if form is submitted
if(isset($_POST['update'])) {
    
    // Get values from form
    $id = $_POST['id'];
    $doctor_id = $_POST['doctor_id'];
    $patient_id = $_POST['patient_id'] != '' ? $_POST['patient_id'] : null;
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $date = $_POST['date'];
    
    // Update appointment in database
    $sql = "UPDATE appointment SET Doctor_ID='$doctor_id', Patient_ID=".($patient_id === null ? "NULL" : "'$patient_id'").", Appointment_StartTime='$start_time', Appointment_EndTime='$end_time', Appointment_Date='$date' WHERE Appointment_ID='$id'";
    $result = mysqli_query($conn, $sql);
    
    // Check if appointment is updated successfully
    if($result) {
        echo "Appointment updated successfully. <br><br>";
        echo "<a href='doctor_view_appointments.php?id=$doctor_id'>View Appointments</a>";
    } else {
        echo "Error updating appointment: " . mysqli_error($conn);
    }
}

// Check if appointment ID is provided in URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Retrieve appointment information from database
    $sql = "SELECT * FROM appointment WHERE Appointment_ID='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    // Check if appointment is found
    if($row) {
        $doctor_id = $row['Doctor_ID'];
        $patient_id = $row['Patient_ID'];
        $start_time = $row['Appointment_StartTime'];
        $end_time = $row['Appointment_EndTime'];
        $date = $row['Appointment_Date'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Update Appointment</title>
</head>
<body>
    <h2>Doctor Update Appointment</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="hidden" name="doctor_id" value="<?php echo $doctor_id;?>">
        <label>Patient ID:</label>
        <input type="text" name="patient_id" value="<?php echo $patient_id;?>"><br><br>
        <label>Appointment Start Time:</label>
        <input type="time" name="start_time" value="<?php echo date('H:i', strtotime($start_time));?>" required><br><br>
        <label>Appointment End Time:</label>
        <input type="time" name="end_time" value="<?php echo date('H:i', strtotime($end_time));?>" required><br><br>
        <label>Appointment Date:</label>
        <input type="date" name="date" value="<?php echo $date;?>" required><br><br>
        <input type="submit" name="update" value="Update">
    </form>
    <br>
    <a href="doctor_view_appointments.php?id=<?php echo $doctor_id;?>">Go back to view Appointments page</a>
</body>
</html>

<?php
    } else {
        echo "Appointment not found.";
    }
} 
?>

