<?php
// Developed by Akhil Mathew
// Doctor home page that has links to redirect you to the appropriate php files
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    ?>

    <!DOCTYPE html>
    <html>
    <head>

        <title>HOME</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Hello, Doctor <?php echo $_SESSION['fname']; ?>!</h1>
        <a href="doctor_profile.php">Profile</a>
        <br><br>
        <a href="order/doctor_order.php">Orders</a>
        <br><br>
        <a href="appointment/doctor_appointment.php">Appointment</a>
        <br><br>
        <a href="review/doctor_reviews.php">Reviews</a>
        <br><br>
        <a href="logout.php">Logout</a>
    </body>
    </html>

    <?php
}
else {
    header("Location: index.php");
    exit();
}
?>