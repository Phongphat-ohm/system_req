<?php
session_start();
$private_data = array();
$account_detail = array();

$private_data = $_SESSION["private_data"];
$account_detail = $_SESSION["account_detail"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คำขอใหม่</title>
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
        <div class="container">
            <div class="d-flex flex-column justify-content-center align-items-center pt-4">
                <h1 class="text-success">
                    คำขอใหม่
                </h1>
                <label class="text-secondary text-center">
                    แบบฟอร์มคำขอมีบัญชีผู้ใช้งานระบบ HOSXP โรงพยาบาลนางรอง จ.บุรีรัมย์
                </label>
            </div>

            <div class="flex gap-2 items-center justify-center my-2 max-lg:hidden">
                <a href="/system_req" style="text-decoration: none;" class="flex flex-col items-center">
                    <i class="bi bi-person-vcard fs-3 text-success"></i>
                    <label class="text-success">ข้อมูลส่วนตัว</label>
                </a>
                <div class="w-30 h-1 bg-sky-500 rounded-full"></div>
                <a href="/system_req/set-account-data.php" style="text-decoration: none;"
                    class="flex flex-col items-center">
                    <i class="bi bi-person-bounding-box fs-3 text-success"></i>
                    <label class="text-success">ชื่อผู้ใช้และรหัสผ่าน</label>
                </a>
                <div class="w-30 h-1 bg-sky-500 rounded-full"></div>
                <div class="flex flex-col items-center">
                    <i class="bi bi-clipboard fs-3 text-danger"></i>
                    <label class="text-danger">ตรวจสอบข้อมูล</label>
                </div>
                <div class="w-30 h-1 bg-sky-500 rounded-full"></div>
                <div class="flex flex-col items-center">
                    <i class="bi bi-check-circle-fill fs-3 text-gray-400"></i>
                    <label class="text-gray-400">สร้างคำขอสำเร็จ</label>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="flex gap-3 mt-4 w-1/2 max-lg:w-full">
                    <i class="bi bi-person-check fs-3 text-primary"></i>
                    <div class="card w-full">
                        <div class="card-header">
                            ข้อมูลส่วนตัว
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td class="w-54">ชื่อ (ภาษาไทย)</td>
                                        <td><?= htmlspecialchars($private_data["prefix-th"] . $private_data["first_name_th"] . " " . $private_data["last_name_th"] ?? "-") ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-54">ชื่อ (ภาษาอังกฤษ)</td>
                                        <td><?= htmlspecialchars($private_data["prefix-en"] . $private_data["first_name_en"] . " " . $private_data["last_name_en"] ?? "-") ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-54">เลขบัตรประจำตัวประชาชน</td>
                                        <td><?= htmlspecialchars($private_data["id_card"] ?? "-") ?></td>
                                    </tr>
                                    <tr>
                                        <td class="w-54">ว/ด/ป เกิด (คศ)</td>
                                        <td><?= htmlspecialchars($private_data["birth"] ?? "-") ?></td>
                                    </tr>
                                    <tr>
                                        <td class="w-54">ตำแหน่ง</td>
                                        <td><?= htmlspecialchars($private_data["position"] ?? "-") ?></td>
                                    </tr>
                                    <tr>
                                        <td class="w-54">แผนก/หน่วยงาน</td>
                                        <td><?= htmlspecialchars($private_data["department"] ?? "-") ?></td>
                                    </tr>
                                    <tr>
                                        <td class="w-54">เลขที่ใบประกอบวิชาชีพ</td>
                                        <td><?= htmlspecialchars($private_data["license"] ?? "-") ?></td>
                                    </tr>
                                    <tr>
                                        <td class="w-54">หมายเลขโทรศัพท์</td>
                                        <td><?= htmlspecialchars($private_data["phone"] ?? "-") ?></td>
                                    </tr>
                                    <tr>
                                        <td class="w-54">อีเมลล์</td>
                                        <td><?= htmlspecialchars($private_data["email"] ?? "-") ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3 mt-4 w-1/2 max-lg:w-full">
                    <i class="bi bi-fingerprint fs-3 text-cyan-800"></i>
                    <div class="card w-full">
                        <div class="card-header">
                            ข้อมูลการเข้าสู่ระบบ
                        </div>
                        <div class="card-body">
                            <div class="flex gap-2 max-lg:flex-col">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="w-20">ชื่อผู้ใช้</td>
                                            <td><?= htmlspecialchars($account_detail["username"] ?? "-") ?></td>
                                        </tr>
                                        <tr>
                                            <td class="w-20">รหัสผ่าน</td>
                                            <td><?= htmlspecialchars($account_detail["password"] ?? "-") ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="w-30">ประเภทผู้ใช้งาน</td>
                                            <td><?= htmlspecialchars($account_detail["account_type"] ?? "-") ?></td>
                                        </tr>
                                        <tr>
                                            <td class="w-30">รายละเอียด</td>
                                            <td>
                                                <?php
                                                $detail = $account_detail["account_detail"] ?? "";
                                                $detail_txt = $account_detail["account_deatil_txt"] ?? "";

                                                if (!empty($detail_txt)) {
                                                    echo htmlspecialchars($detail . " จาก " . $detail_txt);
                                                } elseif (!empty($detail)) {
                                                    echo htmlspecialchars($detail);
                                                } else {
                                                    echo "-";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-30">
                                                ใช้งานถึง
                                            </td>
                                            <td>
                                                <?php echo htmlspecialchars($account_detail["account_deatil_date"] ?? "-"); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="post" action="/system_req/confirm_function.php"
                    class="flex justify-center mt-3 gap-2 pb-20">
                    <a href="/system_req/set-account-data.php" style="text-decoration: none;" class="btn btn-warning"
                        disabled type="button">
                        ย้อนกลับ
                    </a>
                    <a href="./cancel.php" style="text-decoration: none;" class="btn btn-danger">ยกเลิก</a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        ต่อไป
                    </button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title text-danger fs-5" id="exampleModalLabel">ยืนยันข้อกำหนด</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ข้าพเจ้ายินดีที่จะปฏิบัติตามระเบียบข้อบังคับของโรงพยาบาลและรับผิดชอบเกี่ยวกับการใช้งานตาม
                                    พ.ร.บ. คอมพิวเตอร์ 2550 แก้ไข เพิ่มเติม 2560
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">ยกเลิก</button>
                                    <button value="comfirm" name="function_set" class="btn btn-success" type="submit">
                                        ต่อไป
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>

</html>