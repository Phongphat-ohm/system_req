<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "hospital_wifi");


if (mysqli_connect_errno()) {
    echo "มีข้อผิดพลาดในการต่อเชื่อต่อฐานข้อมูล" . mysqli_connect_error();
}

if (!isset($_SESSION["private_data"])) {
    header("Location: /system_req");
    return;
} else if (!isset($_SESSION["account_detail"])) {
    header("Location: /system_req/set-account-data.php");
    return;
} else if ($_POST["function_set"] == "comfirm") {
    $private_data = $_SESSION["private_data"];
    $account_detail = $_SESSION["account_detail"];

    $id_card = $private_data["id_card"];
    $name_th = $private_data["prefix-th"] . " " . $private_data["first_name_th"] . " " . $private_data["last_name_th"];
    $name_en = $private_data["prefix-en"] . " " . $private_data["first_name_en"] . " " . $private_data["last_name_en"];
    $birthdate = $private_data["birth"];
    $position = $private_data["position"];
    $department = $private_data["department"];
    $license_no = $private_data["license_number"];
    $phone = $private_data["phone"];
    $email = $private_data["email"];
    $username = $account_detail["username"];
    $password = $account_detail["password"];
    $account_type = $account_detail["account_type"];
    $account_detail_db = $account_detail["account_detail"] . (isset($account_detail["account_deatil_txt"]) ? " จาก " . $account_detail["account_deatil_txt"] : "");
    $account_expire_date = $account_detail["account_deatil_date"];

    if (isset($id_card) && isset($name_th) && isset($name_en) && isset($birthdate) && isset($position) && isset($department) && isset($license_no) && isset($phone) && isset($email) && isset($username) && isset($password)) {
        $query = "INSERT INTO `wifi_requests` (`id_card`, `name_th`, `name_en`, `birthdate`, `position`, `department`, `license_no`, `phone`, `email`, `username`, `password_hash`, `account_type`, `account_detail`, `expire_date`) VALUES ('$id_card', '$name_th', '$name_en', '$birthdate', '$position', '$department', '$license_no', '$phone', '$email', '$username', '$password', '$account_type', '$account_detail_db', '$account_expire_date')";
        $result = mysqli_query($connection, $query);
        if ($result) {
            echo "บันทึกข้อมูลเรียบร้อยแล้ว";
            session_unset();
            $_SESSION["success_data"] = array(
                "id_card" => $id_card,
                "name_th" => $name_th,
                "name_en" => $name_en,
                "birthdate" => $birthdate,
                "position" => $position,
                "department" => $department,
                "license_no" => $license_no,
                "phone" => $phone,
                "email" => $email,
                "username" => $username,
                "password_hash" => $password,
                "account_type" => $account_type,
                "account_detail" => $account_detail_db,
                "expire_date" => $account_expire_date
            );
            header("Location: /system_req/success.php");
            return;
        } else {
            echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($connection);
            header("Location: /system_req/confirm.php");
            return;
        }
    } else {
        header("Location: /system_req/confirm.php");
        return;
    }
} else {
    header("Location: /system_req/confirm.php");
    return;
}