<?php
session_start();

if (isset($_SESSION["success_data"])) {
    $success_data = $_SESSION["success_data"];
} else {
    header("Location: /system_req");
    return;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สร้างคำขอใหม่</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tailwind css CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="bg-body-tertiary" style="min-height: 100vh;">
        <div class="d-flex flex-column justify-content-center align-items-center pt-4">
            <h1 class="text-success">
                คำขอใหม่
            </h1>
            <label class="text-secondary">
                แบบฟอร์มคำขอมีบัญชีผู้ใช้งานระบบ HOSXP โรงพยาบาลนางรอง จ.บุรีรัมย์
            </label>
        </div>


        <div class="flex gap-2 items-center justify-center my-2">
            <div class="flex flex-col items-center">
                <i class="bi bi-person-vcard fs-3 text-success"></i>
                <label class="text-success">ข้อมูลส่วนตัว</label>
            </div>
            <div class="w-30 h-1 bg-sky-500 rounded-full"></div>
            <div class="flex flex-col items-center">
                <i class="bi bi-person-bounding-box fs-3 text-success"></i>
                <label class="text-success">ชื่อผู้ใช้และรหัสผ่าน</label>
            </div>
            <div class="w-30 h-1 bg-sky-500 rounded-full"></div>
            <div class="flex flex-col items-center">
                <i class="bi bi-clipboard fs-3 text-success"></i>
                <label class="text-success">ตรวจสอบข้อมูล</label>
            </div>
            <div class="w-30 h-1 bg-sky-500 rounded-full"></div>
            <div class="flex flex-col items-center">
                <i class="bi bi-check-circle-fill fs-3 text-success"></i>
                <label class="text-success">สร้างคำขอสำเร็จ</label>
            </div>
        </div>

        <form action="/system_req/set-data.php" class="flex items-center flex-col" method="post">
            <div class="flex gap-3 mt-4 w-1/2">
                <div class="card w-full">
                    <div class="card-body h-96 flex items-center justify-center">
                        <div class="flex flex-col items-center">
                            <img src="/system_req/images/success-icon.gif" class="w-20" alt="">
                            <h1 class="fs-2 text-success mt-2">
                                สร้างคำขอใหม่สำเร็จ
                            </h1>
                            <a href="./dowload.php" style="text-decoration: none;" class="btn btn-outline-primary my-2">
                                <i class="bi bi-cloud-download"></i> ดาวโหลดไฟล์
                            </a>
                            <div class="flex gap-1 items-center">
                                <label class="text-gray-400">
                                    สามารถดูสถานะคำขอได้
                                </label>
                                <a href="./check_status.php" class="text-primary"> กดที่นี่</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>