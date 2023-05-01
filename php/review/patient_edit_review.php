<?php
    session_start();
    
    // Include the database connection file
    require_once('../db_conn.php');

    // Check if the form has been submitted
    if(isset($_POST['submit'])) {

        // Get the form data
        $review_id = $_POST['review_id'];
        $appointment_id = $_POST['appointment_id'];
        $star = $_POST['star'];
        $feedback_text = $_POST['feedback_text'];

        // Check if there is already a review for this appointment
        $query = "SELECT * FROM review WHERE Review_ID = '$review_id'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 0) {
            echo "Error: This review does not exist. Please verify the info you have input and try again.";
        }
        else {
            // Edit the review data in the database
            $query = "UPDATE review SET Appointment_ID='$appointment_id', Star='$star', Feedback_Text='$feedback_text' WHERE Review_ID='$review_id'";
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
	<h2>Editing a Review | <a href="patient_reviews.php">Return to Reviews</a> | <a href="../patient_home.php">Home</a></h2>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <label for="review_id">Review ID:</label><br>
        <input type="text" name="review_id" required><br><br>

        <label for="appointment_id">Appointment ID:</label><br>
        <input type="text" name="appointment_id" required><br><br>

        <label for="star">Star Rating (out of 5):</label><br>
        <input type="text" name="star"><br><br>

        <label for="feedback_text">Feedback:</label><br>
        <input type="text" name="feedback_text" required><br><br>

        <input type="submit" name="submit" value="Update Review">

    </form>
</body>
</html>