<?php
    // Developed by Cyrus Buhariwala
    // Administrators can delete a review using this page.

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
            header("Location: admin_reviews.php");
        }
    }
?>

<html>
<head>
    <title>Admin - Delete Review</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<h1>Hello, Administrator <?php echo $_SESSION['fname']; ?>!</h1>
	<h2>Deleting a Review | <a href="admin_reviews.php">Return to Reviews</a> | <a href="../admin_home.php">Home</a></h2>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <label for="review_id">Review ID:</label><br>
        <input type="text" name="review_id" required><br><br>

        <input type="submit" name="submit" value="Delete Review">

    </form>
</body>
</html>