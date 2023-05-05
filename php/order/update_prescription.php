<!-- 
//Developed by Luis Martinez Morales
//This page is used by both the Administrator and the Doctor to Update a Prescription
//It outputs the entire Prescription Table. 
-->
<!DOCTYPE html>
    <html>
    <head>

        <title>Updating Prescription</title>
        <link rel="stylesheet" href="../styles.css">
    </head>
    </html>

<?php
// Establish a connection to the database
include "../db_conn.php";

if (isset($_POST['prescription_id']) && isset($_POST['order_id']) && isset($_POST['drug_id']) && isset($_POST['quantity'])) {
  // Get the form data
    $var1 = $_POST['prescription_id'];
    $var2 = $_POST['order_id'];
    $var3 = $_POST['drug_id'];
    $var4 = $_POST['quantity'];

    // Update the item in the database
    $sql = "UPDATE Prescription SET Order_ID='$var2', Drug_ID='$var3', Prescription_Quantity='$var4' WHERE Prescription_ID=$var1";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // if it is a success print this out
        echo "Updated Table successfully!";
        
    } else {
        // if it didn't work display the error
        echo "Error updating product: " . mysqli_error($conn);
    }
}
?>