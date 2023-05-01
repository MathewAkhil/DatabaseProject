<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    
    ?>

    <!DOCTYPE html>
    <html>
    <head>

        <title>HOME</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Hello, <?php echo $_SESSION['user_name']; ?></h1>
        <h2> Here is the homepage!</h2>
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
        
        $sql = "SELECT * FROM `order`";
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
        <form action="admin_prescription.php" method="GET">

            <label for="presc"> Enter Order_ID: </label>
            <input type="text" name="presc" id="presc"><br>
            <button type="submit"> Submit</button>
        </form>


        <a href="../index.php">Logout</a>
        <a href="../admin_home.php">Home</a>
        
    </body>
    </html>

    <?php
}
else {
    header("Location: ../index.php");
    exit();
}

?>