<!-- 
//Developed by Luis Martinez Morales
//This page is used by both the Administrator and the Doctor to Update a Prescription
//It outputs the entire Prescription Table. 
-->
<!DOCTYPE html>
    <html>
    <head>

        <title>Updating Prescription</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            th {
                background-color: #4CAF50;
                color: white;
            }
        </style>
    </head>
    </html>

<?php
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
        echo "Updated Table successfully!";
        
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
}
?>

<?php
        
    // $presc = $_GET['presc'];
    $sql = "SELECT * FROM `prescription`";
    $result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
        // output data of each row
        // while($row = $result->fetch_assoc()) {
        //     echo "<br> Prescription_ID: ". $row["Prescription_ID"]. " - Drug_ID: ". $row["Drug_ID"]. "- Prescription_Quantity " . $row["Prescription_Quantity"] . "<br>";
        // }
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