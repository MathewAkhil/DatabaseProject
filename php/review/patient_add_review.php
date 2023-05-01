<?php
    session_start();
    
    // Include the database connection file
    require_once('../db_conn.php');

    // Check if the form has been submitted
    if(isset($_POST['submit'])) {

        // Get the form data
        $appointment_id = $_POST['appointment_id'];
        $star = $_POST['star'];
        $feedback_text = $_POST['feedback_text'];

        // Check if there is already a review for this appointment
        $query = "SELECT * FROM review WHERE Appointment_ID = '$appointment_id'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0) {
            echo "Error: You've already reviewed this appointment. To edit your review, click 'Edit Review' instead of 'Add Review'";
        }
        else {
            // Insert the new review data into the database
            $query = "INSERT INTO review (Appointment_ID, Star, Feedback_Text) VALUES ('$appointment_id', '$star', '$feedback_text')";
            $result = mysqli_query($conn, $query);
            header("Location: patient_reviews.php");
        }
    }
?>

<html>
<head>
    <title>Patient - Add Review</title>
</head>
<body>

<h1>Hello, Patient <?php echo $_SESSION['fname']; ?>!</h1>
	<h2>Adding a Review | <a href="patient_reviews.php">Return to Reviews</a> | <a href="../patient_home.php">Home</a></h2>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <label for="appointment_id">Appointment ID:</label><br>
        <input type="text" name="appointment_id" required><br><br>

        <label for="star">Star Rating (out of 5):</label><br>
        <input type="text" name="star"><br><br>

        <label for="feedback_text">Feedback:</label><br>
        <input type="text" name="feedback_text" required><br><br>

        <input type="submit" name="submit" value="Leave Review">

    </form>
</body>
</html>