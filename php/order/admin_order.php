<?php
//Developed by Luis Martinez Morales
//Administrators can see all of the Orders in Order Table. They can submit
//a request to see specific Oorders which takes them to the Prescription Page

session_start();
// Establish a connection to the database
include "../db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    
    ?>

    <!DOCTYPE html>
    <html>
    <head>

        <title>Admin Orders</title>
        <link rel="stylesheet" href="../styles.css">
    </head>
    <body>
        <h1> Check All Orders </h1>
        <?php
        
        // Create the query
        $sql = "SELECT * FROM `order`";
        // Execute the query and fetch the results
        $result = mysqli_query($conn, $sql);
        
        // Loop through the results and display the details
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
        // Create a query and get the Pharmacy Table
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
        <form action="admin_prescription.php" method="GET">

            <label for="presc"> Enter Order_ID: </label>
            <input type="text" name="presc" id="presc" required>
            <button type="submit"> Submit</button>
        </form>
        <br>
        
        <!-- Button to go to homepage -->
        <a href="../admin_home.php">Home</a>
        
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