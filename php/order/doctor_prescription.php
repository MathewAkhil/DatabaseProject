<?php

session_start();
include "../db_conn.php";

?>
<!DOCTYPE html>
    <html>
    <head>

        <title>Doctor Prescriptions</title>
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
    <body>
        
        <h1> Here is the Prescription Page </h1>
        
        <?php
        
        if(isset($_GET['presc'])) {
            
            $presc = $_GET['presc'];
            echo "PRESCRIPTION TABLE FOR ORDER_ID: " . $presc;
            
        
            $sql = "SELECT * FROM `prescription` WHERE Order_ID = '$presc'";
            $result = mysqli_query($conn,$sql);

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
            // if ($result->num_rows > 0) {
            //     // output data of each row
            //     while($row = $result->fetch_assoc()) {
            //         echo "<br> Prescription_ID: ". $row["Prescription_ID"]. " - Drug_ID: ". $row["Drug_ID"]. "- Prescription_Quantity " . $row["Prescription_Quantity"] . "<br>";
            //     }
            // } else {
            //     echo "0 results";
            // }
        }

        
        ?>
        <br>
        DRUGS TABLE
        <?php
        // $presc = $_GET['presc'];
        $sql = "SELECT * FROM `drug`";
        $result = mysqli_query($conn,$sql);
        if ($result->num_rows > 0) {
            // output data of each row
            // while($row = $result->fetch_assoc()) {
            //     echo "<br> Drug_ID: ". $row["Drug_ID"]. " - Drug_Quantity: ". $row["Drug_Quantity"]. "- Drug_Name " . $row["Drug_Name"] . "<br>";
            // }
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
        <form method="post" action="add_product.php">
            <label for="prescription_id">Prescription_ID:</label>
            <input type="text" name="prescription_id" id="prescription_id">
            
            <label for="order_id">Order_ID:</label>
            <input type="text" name="order_id" id="order_id">

            <label for="drug_id">Drug_ID:</label>
            <input type="text" name="drug_id" id="drug_id">
            
            <label for="quantity">Prescription_Quantity:</label>
            <input type="text" name="quantity" id="quantity">
            
            
            <input type="submit" value="Add Prescription">
        </form>

        <br>
        Update a prescription:
        <form method="post" action="update_product.php">
            <label for="prescription_id">Prescription_ID:</label>
            <input type="text" name="prescription_id" id="prescription_id">
            
            <label for="order_id">Order_ID:</label>
            <input type="text" name="order_id" id="order_id">

            <label for="drug_id">Drug_ID:</label>
            <input type="text" name="drug_id" id="drug_id">
            
            <label for="quantity">Prescription_Quantity:</label>
            <input type="text" name="quantity" id="quantity">
            
            
            <input type="submit" value="Update Prescription">
            </form>
        <br>
        Delete a prescription:
        <form action="delete_row.php" method="POST">
            <label for="prescription_id">Enter the ID of the row to delete:</label>
            <input type="text" name="prescription_id" required>
            <button type="submit" name="delete_btn">Delete Prescription</button>
        </form>
        <br>
        
        <a href="doctor_order.php">Orders</a>
        <a href="../doctor_home.php">Home</a>
    </body>
    </html>
