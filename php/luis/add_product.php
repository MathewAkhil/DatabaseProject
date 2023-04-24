<?php
include "db_conn.php";

// Get the form data
$prescription_id = $_POST['prescription_id'];
$order_id = $_POST['order_id'];
$drug_id = $_POST['drug_id'];
$quantity = $_POST['quantity'];

// Insert the new item into the database
$sql = "INSERT INTO Prescription (Prescription_ID, Order_ID, Drug_ID, Prescription_Quantity) VALUES ('$prescription_id', '$order_id', '$drug_id', '$quantity')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "New product added successfully!";
} else {
    echo "Error adding new product: " . mysqli_error($conn);
}
?>

<?php
        
    // $presc = $_GET['presc'];
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
        
?>