<?php
// Requires database connection.
define("CONN_DB", true);
require_once("../inc/database.php");
$db = $conn;

// Variable to store the error message.
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect the values from the login form submission and log the user into the system.
    $continue_ = isset($_POST["submit"]) && 
    isset($_POST["username"]) && 
    isset($_POST["password"]);

    if ($continue_) {
        $username = $_POST["username"];
        $password = md5($_POST["password"]);

        # First verify that the username exists in the system.
        $usernameQuery = "SELECT username FROM users WHERE username='$username'";
        $result = $db->query($usernameQuery);
        if ($result->num_rows > 0) {
            // Continue and verify the password.
            $passwordQuery = "SELECT id, email, acc_num, balance, phone, username, fname, lname FROM users WHERE username='$username' AND password='$password'";
            $result = $db->query($passwordQuery);
            if ($result->num_rows > 0) {
                # This means that both the email and password are registerd. Hence, we login.
                $data = $result->fetch_object();
                $_SESSION['email'] = $data->email;
                $_SESSION['phone'] = $data->phone ;
                $_SESSION['username'] = $data->username;
                $_SESSION['uid'] = $data->id;
                $_SESSION['balance'] = $data->balance;
                $_SESSION['fname'] = $data->fname;
                $_SESSION['lname'] = $data->lname;
                $_SESSION['acc_num'] = $data->acc_num;
                header("Location: ../pages/index.php");
            } else {
                $error_msg = "The provided password is invalid.";
            }
        } else {
            $error_msg = "The provided username is invalid.";
        }
    } else {
        $error_msg = "Credentials not provided.";
    }
}