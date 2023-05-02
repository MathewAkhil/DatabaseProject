<?php
//Developed by Luis Martinez Morales
//Patients can see all of the Prescriptions with the Order_ID they submitted. They can also see the Drugs Table. 
//They can also go back to Orders or to the Home page.

session_start();
include "../db_conn.php";

?>
<!DOCTYPE html>
    <html>
    <head>

        <title>Patient Prescription</title>
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

        <a href="../patient_home.php">Home</a>
        <a href="patient_order.php">Orders</a>
    </body>
    </html>
