<?php
session_start();

if (isset($_POST["function_set"])) {
    if ($_POST["function_set"] == "set_private_data") {
        $_SESSION["private_data"] = $_POST;
        header("location: ./set-account-data.php");
        return;
    }

    if ($_POST["function_set"] == "set_account") {
        $_SESSION["account_detail"] = $_POST;

        $password = $_POST["password"];
        $repassword = $_POST["repassword"];

        if ($password != $repassword) {
            $_SESSION["error_message"] = "กรุณากรอกรหัสผ่านให้ตรงกัน";
            header("location: ./set-account-data.php");
            echo $password . " : " . $repassword; 
        } else {
            header("location: ./confirm.php");
        }
        return;
    }

    header("location: /system_req");
} else {
    header("location: /system_req");
}
