<?php
// Developed by Akhil Mathew
// Gets all the basic user information and sends it to process-signup.php
session_start();
include "db_conn.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Signup</h1>

    <form action="process-signup.php" method="post">
        <div>
            <label for="fnameRegister">First Name</label>
            <input type="text" id="fnameRegister" name="fnameRegister" required>
        </div>

        <div>
            <label for="lnameRegister">Last Name</label>
            <input type="text" id="lnameRegister" name="lnameRegister" required>
        </div>

        <div>
            <label for="emailRegister">Email</label>
            <input type="email" id="emailRegister" name="emailRegister" required>
        </div>

        <div>
            <label for="passwordRegister">Password</label>
            <input type="password" id="passwordRegister" name="passwordRegister" required>
        </div>

        <div>
            <label for="dateRegister">DOB</label>
            <input type="date" id="dateRegister" name="dateRegister" required>
        </div>

        <div>
            <label for="typeRegister">Type</label>
            <input type="text" id="typeRegister" name="typeRegister" required>
        </div>

        <button>Sign up</button>
    </form>
    
    <form method="post" action="index.php">
        <button type="submit">Go to Login</button>
    </form>
</body>
</html>