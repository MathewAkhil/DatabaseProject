<?php
// Developed by Akhil Mathew
// Logs out of the account and redirected back to index.php
session_start();

session_unset();
session_destroy();

header("Location: index.php");