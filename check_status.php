<?php

$error_message = "";
$id_card = "";
$success_data = null;

if (isset($_POST["submit"]) && $_POST["submit"] === "check_status") {
    $conn = mysqli_connect("localhost", "root", "", "hospital_wifi");

    if (mysqli_connect_errno()) {
        $error_message = "มีบางอย่างผิดพลาดในการเชื่อมต่อฐานข้อมูล: " . mysqli_connect_error();
    } else {
        $id_card = mysqli_real_escape_string($conn, $_POST["id_card"]);
        $query = "SELECT * FROM wifi_requests WHERE id_card='$id_card'";
        $result = mysqli_query($conn, $query);

        if (!$result || mysqli_num_rows($result) == 0) {
            $error_message = "ไม่พบข้อมูลคำขอของคุณ";
        } else {
            $success_data = mysqli_fetch_assoc($result);
        }

        mysqli_close($conn);
    }
}

if (isset($_GET["id_card"])) {
    $conn = mysqli_connect("localhost", "root", "", "hospital_wifi");

    if (mysqli_connect_errno()) {
        $error_message = "มีบางอย่างผิดพลาดในการเชื่อมต่อฐานข้อมูล: " . mysqli_connect_error();
    } else {
        $id_card = mysqli_real_escape_string($conn, $_GET["id_card"]);
        $query = "SELECT * FROM wifi_requests WHERE id_card='$id_card'";
        $result = mysqli_query($conn, $query);

        if (!$result || mysqli_num_rows($result) == 0) {
            $error_message = "ไม่พบข้อมูลคำขอของคุณ";
        } else {
            $success_data = mysqli_fetch_assoc($result);
        }

        mysqli_close($conn);
    }
}

function format_thai_datetime($datetime_str)
{
    $months_th = [
        "",
        "มกราคม",
        "กุมภาพันธ์",
        "มีนาคม",
        "เมษายน",
        "พฤษภาคม",
        "มิถุนายน",
        "กรกฎาคม",
        "สิงหาคม",
        "กันยายน",
        "ตุลาคม",
        "พฤศจิกายน",
        "ธันวาคม"
    ];

    $timestamp = strtotime($datetime_str);
    $day = date("j", $timestamp);
    $month = $months_th[intval(date("n", $timestamp))];
    $year = date("Y", $timestamp) + 543; // แปลงเป็น พ.ศ.
    $time = date("H:i", $timestamp);

    return "$day $month $year เวลา $time น.";
}

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบสถานะคำขอ</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tailwind css CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>

    <div class="min-vh-100 bg-gray-100 w-full d-flex flex-column align-items-center pt-5">
        <div class="container">
            <?php if ($error_message !== ""): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error_message) ?>
                </div>
            <?php endif; ?>
        </div>

        <h1 class="text-success">ตรวจสอบสถานะคำขอ</h1>
        <label class="text-muted">ตรวจสอบสถานะคำขอมีบัญชีผู้ใช้โปรแกรม HOSXP</label>

        <div class="w-1/2 max-lg:w-full max-lg:px-2 mt-4">
            <form action="./check_status.php" method="post">
                <label for="id_card">เลขบัตรประจำตัวประชาชน</label>
                <div class="input-group mb-3">
                    <input autocomplete="off" value="<?= htmlspecialchars($id_card) ?>" type="text" name="id_card"
                        id="id_card" required class="form-control" placeholder="กรอกรหัสบัตรประชาชน">
                    <button name="submit" value="check_status" class="btn btn-outline-primary" type="submit">
                        <i class="bi bi-search"></i> ค้นหา
                    </button>
                </div>
            </form>

            <?php if ($success_data !== null): ?>
                <div class="card mt-3 rounded-xl shadow">
                    <div class="card-body">
                        <h5 class="text-primary">
                            ข้อมูลส่วนตัว
                        </h5>
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <th class="border p-2 w-52">
                                        รหัสคำขอ
                                    </th>
                                    <td class="border p-2">
                                        <?= htmlspecialchars($success_data["id"] ?? "-") ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border p-2 w-52">
                                        ชื่อ
                                    </th>
                                    <td class="border p-2">
                                        <?= htmlspecialchars($success_data["name_th"] ?? "-") ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border p-2 w-52">
                                        รหัสบัตรประชาชน
                                    </th>
                                    <td class="border p-2">
                                        <?= htmlspecialchars($success_data["id_card"] ?? "-") ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border p-2 w-52">
                                        ขอเมื่อวันที่
                                    </th>
                                    <td class="border p-2">
                                        <?= isset($success_data["created_at"]) ? format_thai_datetime($success_data["created_at"]) : "-" ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="./dowload.php?id_card=<?php echo $success_data["id_card"]; ?>"
                            class="btn btn-success mt-3">
                            <i class="bi bi-cloud-arrow-down-fill"></i> ดาวโหลดเอกสารคำขอ
                        </a>
                        <hr>
                        <h5 class="text-success">
                            การอณุมัติการใช้งาน
                        </h5>
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <th class="border p-2 w-52">
                                        จากผู้บังคับบัญชา
                                    </th>
                                    <td class="border p-2">
                                        <?php if ($success_data["status_leader"] !== "รอดำเนินการ"): ?>
                                            <?= format_thai_datetime($success_data["status_leader"]); ?>
                                        <?php else: ?>
                                            <div class="flex gap-2 items-center">
                                                <div class="spinner-border spinner-border-sm text-warning" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                <div class="text-warning">
                                                    กำลังดำเนินการ
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border p-2 w-52">
                                        จากผู้อำนวยการ
                                    </th>
                                    <td class="border p-2">
                                        <?php if ($success_data["status_director"] !== "รอดำเนินการ"): ?>
                                            <?= format_thai_datetime($success_data["status_director"]); ?>
                                        <?php else: ?>
                                            <div class="flex gap-2 items-center">
                                                <div class="spinner-border spinner-border-sm text-warning" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                <div class="text-warning">
                                                    กำลังดำเนินการ
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border p-2 w-52">
                                        จากผู้ดูแลระบบ
                                    </th>
                                    <td class="border p-2">
                                        <?php if ($success_data["status_it"] !== "รอดำเนินการ"): ?>
                                            <?= format_thai_datetime($success_data["status_it"]); ?>
                                        <?php else: ?>
                                            <div class="flex gap-2 items-center">
                                                <div class="spinner-border spinner-border-sm text-warning" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                <div class="text-warning">
                                                    กำลังดำเนินการ
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>