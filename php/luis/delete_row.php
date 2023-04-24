<?php
include "db_conn.php";

// Check if the delete button was clicked and an ID was submitted
if (isset($_POST['delete_btn']) && isset($_POST['prescription_id'])) {
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

    $sql = "SELECT * FROM `prescription`";
    $result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
        // output data of each row
        echo "<table>";
        echo "<tr><th>Prescription ID</th><th>Drug ID</th><th>Prescription Quantity</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["Prescription_ID"] . "</td><td>" . $row["Drug_ID"] . "</td><td>" . $row["Prescription_Quantity"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    


    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}
?>