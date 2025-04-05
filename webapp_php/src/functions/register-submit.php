<?php
// Connect to the database, and remap the connection to $db.
define("CONN_DB", true);
require("../inc/database.php");
$db = $conn;

// Variable to store the error message.
$error_msg = "";

// Handle registration submission and create new users.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $continue_registration = isset($_POST["submit"]) && 
        isset($_POST["fname"]) && 
        isset($_POST["lname"]) && 
        isset($_POST["email"]) && 
        isset($_POST["password"]) && 
        isset($_POST["phone"]) &&
        isset($_POST["pin"]) &&
        isset($_POST["username"]);

    // Continue registration
    if ($continue_registration) {
        // Extract all the information
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $phone = $_POST["phone"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $balance = 0;
        $pin = $_POST["pin"];
        if (isset($_POST["balance"])) {
            $balance =  $_POST["balance"];
        }
        $acc_num = bin2hex(uniqid());
        
        $usernameQuery = "SELECT username FROM users WHERE email='$email' OR username='$username' LIMIT 1";
        $usernameResults = $db->query($usernameQuery);
        if ($usernameResults->num_rows >= 1) {
            $error_msg = "Account already exists with that username or email.";
        } else {
            // Create a new account with that information.            
            $insert_query = "INSERT INTO users (fname, lname, username, email, password, phone, balance, acc_num, pin) VALUES ('$fname', '$lname', '$username', '$email', '$password', '$phone', '$balance', '$acc_num', '$pin')";
            $insert_query_result = $db->query($insert_query);
            if ($insert_query_result) {      
                $getData = "SELECT id, acc_num, email, phone, fname, lname, balance FROM users WHERE acc_num=\"$acc_num\"";
                $data = $db->query($getData)->fetch_object();
                $uid = $data->id;
                $_SESSION['uid'] = $data->id;
                $_SESSION['acc_num'] = $data->acc_num;
                $_SESSION['email'] = $data->email;
                $_SESSION['phone'] = $data->phone;
                $_SESSION['fname'] = $data->fname;
                $_SESSION['lname'] = $data->lname;
                $_SESSION['balance'] = $data->balance;
                header("Location: ../pages/index.php");
            } else {
                $error_msg = "Error inserting the data to the database.";
            }
        }       
    } else {
        $error_msg = "Internal Server Error.";
    }
}