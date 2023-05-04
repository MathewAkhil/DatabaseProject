<!-- 
//Developed by Luis Martinez Morales
//This page is used by both the Administrator and the Doctor to Delete a Prescription
//It outputs the entire Prescription Table.    
-->
<!DOCTYPE html>
    <html>
    <head>

        <title>Deleting Prescription</title>
        <link rel="stylesheet" href="../styles.css">
    </head>
    </html>

<?php
// Establish a connection to the database
include "../db_conn.php";

// Check if the delete button was clicked and an ID was submitted
if (isset($_POST['delete_btn']) && isset($_POST['prescription_id'])) {
    // Get the form data
    $prescription_id = $_POST['prescription_id'];

    // Prepare and execute the SQL statement
    $sql = "DELETE FROM Prescription WHERE Prescription_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $prescription_id);
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        echo "Row deleted successfully";
    } else {
        echo "Error deleting row";
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}
?>