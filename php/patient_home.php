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
        <h1>Hello, Patient <?php echo $_SESSION['fname']; ?>!</h1>
        <a href="luis/patient_order.php">Orders</a>
        <br><br>
        <a href="appointment/patient_appointment.php">Appointments</a>
        <br><br>
        <a href="review/patient_reviews.php">Reviews</a>
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