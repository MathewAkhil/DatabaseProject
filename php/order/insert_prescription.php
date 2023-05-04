<!-- 
//Developed by Luis Martinez Morales
//This page is used by both the Administrator and the Doctor to Insert a Prescription
//It outputs the entire Prescription Table. 
-->
<!DOCTYPE html>
    <html>
    <head>

        <title>Adding Prescription</title>
        <link rel="stylesheet" href="../styles.css">
    </head>
    </html>


<?php
// Establish a connection to the database
include "../db_conn.php";

// Get the form data
$prescription_id = $_POST['prescription_id'];
$order_id = $_POST['order_id'];
$drug_id = $_POST['drug_id'];
$quantity = $_POST['quantity'];

// Insert the new item into the database
$sql = "INSERT INTO Prescription (Prescription_ID, Order_ID, Drug_ID, Prescription_Quantity) VALUES ('$prescription_id', '$order_id', '$drug_id', '$quantity')";
$result = mysqli_query($conn, $sql);

if ($result) {
    // if it is a success print this out
    echo "New product added successfully!";
} else {
    // if it didn't work display the error
    echo "Error adding new product: " . mysqli_error($conn);
}
?>
