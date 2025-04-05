<?php
// Requires database connection.
define("CONN_DB", true);
require_once("../inc/database.php");
$db = $conn;

// Variable to store the error message.
$error_msg = "";
$success_msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect the values from the login form submission and log the user into the system.
    $continue_ = isset($_POST["submit"]) && 
    isset($_POST["amount"]) && 
    isset($_POST["pin"]) &&
    isset($_POST["acc_num"]);

    if ($continue_) {
        // Get the amount, pin and account number.
        $current_user_id = $_SESSION["uid"];
        $current_user_query = "SELECT * FROM users WHERE id='$current_user_id'";
        $result = $db->query($current_user_query);
        if ($result->num_rows > 0) {
            $data = $result->fetch_object();
            $current_user_info = array(
                "id"=>$data->id,
                "balance"=>$data->balance,
                "pin"=>$data->pin,
            );
            // Get the other user info.
            $other_user_accnum = $_POST["acc_num"];
            $other_user_query = "SELECT * FROM users WHERE acc_num='$other_user_accnum'";
            $result = $db->query($other_user_query);
            if ($result->num_rows > 0) {
                $data = $result->fetch_object();
                $other_user_info = array(
                    "balance"=>$data->balance,
                    "id"=>$data->id,
                );
                // Now check whether the pin entered matches or not for the current user.
                if ($_POST["pin"] == $current_user_info["pin"]) {
                    // Check whether the current user has sufficient funds to transfer.
                    if ($_POST["amount"] <= $current_user_info["balance"]) {
                        // Continue;
                        $other_user_final_balance = $_POST["amount"] + $other_user_info["balance"];
                        $other_user_id = $other_user_info["id"];
                        $current_user_final_balance = $current_user_info["balance"] - $_POST["amount"];
                        $current_user_id = $current_user_info["id"];

                        // Finally make the necessary queries.
                        $q1 = "UPDATE users SET balance=$other_user_final_balance WHERE id=$other_user_id";
                        $q2 = "UPDATE users SET balance=$current_user_final_balance WHERE id=$current_user_id";
                        $result1 = $db->query($q1);
                        $result2 = $db->query($q2);
                        if ($result1 && $result2){
                            $_SESSION["balance"] = $current_user_final_balance;
                            $success_msg = "Funds sucessfully transferred.";
                        } else {
                            $error_msg = "Failed to transfer funds.";
                        }
                    } else {
                        $amount = $_POST["amount"];
                        $current = $current_user_info["balance"];
                        $error_msg = "Current user doesn't have the sufficient funds to transfer.";
                    }

                } else {
                    $error_msg = "Entered pin is incorret for the current user.";
                }
            } else {
                $error_msg = "The user with the given account number doesn't exist in the system";
            }
        }
    } else {
        $error_msg = "Values not provided.";
    }
}