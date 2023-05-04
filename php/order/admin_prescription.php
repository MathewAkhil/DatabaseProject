<?php
//Developed by Luis Martinez Morales
//Administrators can see all of the Prescriptions with the Order_ID they submitted. They can also see the Drugs Table.
//They can Insert, Update, and Delete a Prescription by entering the appropriate fields. 
//They can also go back to Orders or to the Home page.

session_start();
// Establish a connection to the database
include "../db_conn.php";

?>
<!DOCTYPE html>
    <html>
    <head>

        <title>Admin Prescriptions</title>
        <link rel="stylesheet" href="../styles.css">
    </head>
    <body>
        
        <h1> Here is the Prescription Page </h1>
        
        <?php
        
        if(isset($_GET['presc'])) {
            
            // Get the Prescriptions requested from admin_order.php
            $presc = $_GET['presc'];

            // Display the Order_ID:
            echo "PRESCRIPTION TABLE FOR ORDER_ID: " . $presc;
            
            // Create the query
            $sql = "SELECT * FROM `prescription` WHERE Order_ID = '$presc'";
            // Execute the query and fetch the results
            $result = mysqli_query($conn,$sql);

            // Loop through the results and display the details
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Prescription ID</th><th>Drug ID</th><th>Prescription Quantity</th></tr>";
            
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Prescription_ID"] . "</td><td>" . $row["Drug_ID"] . "</td><td>" . $row["Prescription_Quantity"] . "</td></tr>";
                }
                
                echo "</table>";
            } else {
                echo "0 results";
            }
        }

        
        ?>
        <br>
        DRUGS TABLE
        <?php
        // Create the query to display the Drug table
        $sql = "SELECT * FROM `drug`";
        // Execute the query and fetch the results
        $result = mysqli_query($conn,$sql);

        // Loop through the results and display the details
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Drug ID</th><th>Drug Quantity</th><th>Drug Name</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Drug_ID"] . "</td><td>" . $row["Drug_Quantity"] . "</td><td>" . $row["Drug_Name"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        
        ?>
        <br>
        Add a new prescription:
        <!-- form for adding a new prescription -->
        <form method="post" action="insert_prescription.php">
            <!-- it requires a prescription_id -->
            <label for="prescription_id">Prescription_ID:</label>
            <input type="text" name="prescription_id" id="prescription_id" required>
            
            <!-- it requires an order_id -->
            <label for="order_id">Order_ID:</label>
            <input type="text" name="order_id" id="order_id" required>

            <!-- it requires a drug_id -->
            <label for="drug_id">Drug_ID:</label>
            <input type="text" name="drug_id" id="drug_id" required>
            
            <!-- it requires a quantity -->
            <label for="quantity">Prescription_Quantity:</label>
            <input type="text" name="quantity" id="quantity" required>
            
            <input type="submit" value="Add Prescription">
        </form>

        <br>
        Update a prescription:
        <!-- form for adding a new prescription -->
        <form method="post" action="update_prescription.php">
            <!-- it requires a prescription_id -->
            <label for="prescription_id">Prescription_ID:</label>
            <input type="text" name="prescription_id" id="prescription_id" required>
            
            <!-- it requires a order_id -->
            <label for="order_id">Order_ID:</label>
            <input type="text" name="order_id" id="order_id" required>
            
            <!-- it requires a drug_id -->
            <label for="drug_id">Drug_ID:</label>
            <input type="text" name="drug_id" id="drug_id" required>
            
            <!-- it requires a quantity -->
            <label for="quantity">Prescription_Quantity:</label>
            <input type="text" name="quantity" id="quantity" required>
            
            <input type="submit" value="Update Prescription">
            </form>
        
        <br>
        Delete a prescription:
        <!-- form for adding a new prescription -->
        <form action="delete_prescription.php" method="POST">
            <!-- it requires a order_id -->
            <label for="prescription_id">Enter the ID of the row to delete:</label>
            <input type="text" name="prescription_id" required>

            <button type="submit" name="delete_btn">Delete Prescription</button>
        </form>
        <br>
        
        <!-- Button to go to homepage -->
        <a href="../admin_home.php">Home</a>
        <!-- Button to go to Orders -->
        <a href="admin_order.php">Orders</a>
        
    </body>
    </html>
