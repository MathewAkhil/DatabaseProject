<?php
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
        <h1>Hello, Dr. <?php echo $_SESSION['lname']; ?>!</h1>
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
    header("Location: ../index.php");
    exit();
}
?>