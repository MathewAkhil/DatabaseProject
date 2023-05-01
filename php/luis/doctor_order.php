<?php
session_start();
include "../db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    
    ?>

    <!DOCTYPE html>
    <html>
    <head>

        <title>Doctor Orders</title>
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
        <h1> Check Your Orders </h1>
        <?php
        // $sql = "SELECT * FROM `order`";
        // $result = mysqli_query($conn,$sql);
        // if ($result->num_rows > 0) {
        //     // output data of each row
        //     while($row = $result->fetch_assoc()) {
        //         echo "<br> Order_ID: ". $row["Order_ID"]. " - Doctor_ID: ". $row["Doctor_ID"]. "- Pharmacy_ID " . $row["Pharmacy_ID"] . "<br>";
        //     }
        // } else {
        //     echo "0 results";
        // }

        $id = $_SESSION['id'];
        
        $sql = "SELECT * FROM `order` WHERE Doctor_ID = '$id'";
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
        <form action="doctor_prescription.php" method="GET">

            <label for="presc"> Enter Order_ID: </label>
            <input type="text" name="presc" id="presc"><br>
            <button type="submit"> Submit</button>
        </form>
        
        <a href="../doctor_home.php">Home</a>
        
    </body>
    </html>

    <?php
}
else {
    header("Location: ../index.php");
    exit();
}

?>