<?php
//Developed by Luis Martinez Morales
//Patients can see all of the Prescriptions with the Order_ID they submitted. They can also see the Drugs Table. 
//They can also go back to Orders or to the Home page.

session_start();
// Establish a connection to the database
include "../db_conn.php";

?>
<!DOCTYPE html>
    <html>
    <head>

        <title>Patient Prescription</title>
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
            echo "<tr><th>Drug ID</th> <th>Drug Name</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Drug_ID"] . "</td><td>" . $row["Drug_Name"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        
        ?>
        <br>        
        
        <!-- Button to go to homepage -->
        <a href="../patient_home.php">Home</a>
        <!-- Button to go to Orders -->
        <a href="patient_order.php">Orders</a>
        
    </body>
    </html>
