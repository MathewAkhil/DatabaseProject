<!DOCTYPE html>
<!-- Developed by Akhil Mathew
This is the starting page. User will be asked for login info and then redirected to 
login.php or they can click signup and be redirected to signup.php -->
<html>
<head>
    <title> LOGIN </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="login.php" method="post">
        <h2>LOGIN</h2>
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"> <?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label> Email</label>
        <input type="text" name="uname" placeholder="User Name"><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit">Login</button>
    </form>

    <form method="post" action="signup.php">
        <button type="submit">Go to Signup</button>
    </form>
</body>
</html>
