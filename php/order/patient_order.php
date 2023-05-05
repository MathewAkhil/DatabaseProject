<?php
//Developed by Luis Martinez Morales
//Patients can see all of the Orders with their Patient_ID. They can submit
//a request to see specific Oorders which takes them to the Prescription Page

session_start();
// Establish a connection to the database
include "../db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    
    ?>

    <!DOCTYPE html>
    <html>
    <head>

        <title>Patient Orders</title>
        <link rel="stylesheet" href="../styles.css">
    </head>
    <body>
        <h1> Check Your Orders </h1>
        <?php
        
        // Get the User_ID
        $id = $_SESSION['id'];
        
        // Create a query and only get the Orders with the Patient_ID
        $sql = "SELECT * FROM `order` WHERE Patient_ID = '$id'";
        // Execute the query and fetch the result
        $result = mysqli_query($conn, $sql);
        
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Order ID</th><th>Doctor ID</th><th>Pharmacy ID</th></tr>";
        
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Order_ID"] . "</td><td>" . $row["Doctor_ID"] . "</td><td>" . $row["Pharmacy_ID"] . "</td></tr>";
            }
            
            echo "</table>";
        } else {
            echo "0 results";
        }
        ?>
        <br>
        Available Pharmacies
        <?php
        // Create a query and only get the Orders with the Patient_ID
        $sql = "SELECT * FROM `Pharmacy`";
        // Execute the query and fetch the result
        $result = mysqli_query($conn, $sql);
        
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Pharmacy ID</th><th>Pharmacy Name</th></tr>";
        
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Pharmacy_ID"] . "</td><td>" . $row["Pharmacy_Name"] .  "</td></tr>";
            }
            
            echo "</table>";
        } else {
            echo "0 results";
        }
        
        
        // entering the Order_ID to display the asociated prescriptions
        ?>
        <form action="patient_prescription.php" method="GET">

            <label for="presc"> Enter Order_ID: </label>
            <input type="text" name="presc" id="presc" required>
            <button type="submit"> Submit</button>
        </form>
        <br>
        
        <!-- Button to go to homepage -->
        <a href="../patient_home.php">Home</a>
        
    </body>
    </html>

    <?php
}
else {
    // If you are signed out or any other errors, go back to index.php
    header("Location: ../index.php");
    exit();
}

?>