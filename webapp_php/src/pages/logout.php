<?php
// Log the user out of the system.
if (session_status() == PHP_SESSION_NONE) session_start();
// UNSET SPECIFIC SESSION VARIABLES.
unset($_SESSION['email']);
unset($_SESSION['phone']);
unset($_SESSION['username']);
unset($_SESSION['uid']);
unset($_SESSION['balance']);
unset($_SESSION['fname']);
unset($_SESSION['lname']);
unset($_SESSION['acc_num']);

header("Location: ../pages/index.php");
