<?php
    session_start();
    
    // Include the database connection file
    require_once('../db_conn.php');

    // Check if the form has been submitted
    if(isset($_POST['submit'])) {

        // Get the form data
        $review_id = $_POST['review_id'];

        // Check if there is already a review for this appointment
        $query = "SELECT * FROM review WHERE Review_ID = '$review_id'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 0) {
            echo "Error: A review for this appointment does not exist. To add your review, click 'Add Review' instead of 'Delete Review'";
        }
        else {
            // Delete the review data in the database
            $query = "DELETE FROM review WHERE Review_ID = $review_id";
            $result = mysqli_query($conn, $query);
            header("Location: patient_reviews.php");
        }
    }
?>

<html>
<head>
    <title>Patient - Delete Review</title>
</head>
<body>

<h1>Hello, Patient <?php echo $_SESSION['fname']; ?>!</h1>
	<h2>Deleting a Review | <a href="patient_reviews.php">Return to Reviews</a> | <a href="../patient_home.php">Home</a></h2>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <label for="review_id">Review ID:</label><br>
        <input type="text" name="review_id" required><br><br>

        <input type="submit" name="submit" value="Delete Review">

    </form>
    <h3><a href="patient_add_review.php">Add Review</a> | <a href="patient_edit_review.php">Edit Review</a> | <a href="patient_delete_review.php">Delete Review</a></h3>
</body>
</html>