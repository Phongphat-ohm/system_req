<?php
session_start();

$account_detail = array();

if (isset($_SESSION["account_detail"])) {
    $account_detail = $_SESSION["account_detail"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คำขอใหม่</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tailwind css CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="bg-body-tertiary" style="min-height: 100vh;">
        <?php if (isset($_SESSION["error_message"])) : ?>
            <div class="container pt-2">
                <div class="alert alert-danger text-center" role="alert">
                    <?= $_SESSION["error_message"]; ?>
                </div>
            </div>
            <?php unset($_SESSION["error_message"]); ?>
        <?php endif; ?>

        <div class="d-flex flex-column justify-content-center align-items-center pt-4">
            <h1 class="text-success">
                คำขอใหม่
            </h1>
            <label class="text-secondary text-center">
                แบบฟอร์มคำขอมีบัญชีผู้ใช้งานระบบ HOSXP โรงพยาบาลนางรอง จ.บุรีรัมย์
            </label>
        </div>


        <div class="flex gap-2 items-center justify-center my-2 max-lg:hidden">
            <a style="text-decoration: none;" href="/system_req" class="flex flex-col items-center">
                <i class="bi bi-person-vcard fs-3 text-success"></i>
                <label class="text-success">ข้อมูลส่วนตัว</label>
            </a>
            <div class="w-30 h-1 bg-sky-500 rounded-full"></div>
            <div class="flex flex-col items-center">
                <i class="bi bi-person-bounding-box fs-3 text-danger"></i>
                <label class="text-danger">ชื่อผู้ใช้และรหัสผ่าน</label>
            </div>
            <div class="w-30 h-1 bg-sky-500 rounded-full"></div>
            <div class="flex flex-col items-center">
                <i class="bi bi-clipboard fs-3 text-gray-400"></i>
                <label class="text-gray-400">ตรวจสอบข้อมูล</label>
            </div>
            <div class="w-30 h-1 bg-sky-500 rounded-full"></div>
            <div class="flex flex-col items-center">
                <i class="bi bi-check-circle-fill fs-3 text-gray-400"></i>
                <label class="text-gray-400">สร้างคำขอสำเร็จ</label>
            </div>
        </div>

        <form action="/system_req/set-data.php" class="flex items-center flex-col" method="post">
            <div class="flex gap-3 mt-4 w-1/2 max-lg:w-full max-lg:px-2 max-lg:flex-col">
                <div class="w-full">
                    <div class="card">
                        <div class="card-header">
                            ประเภทผู้ใช้งาน
                        </div>
                        <div class="card-body flex flex-col gap-2">
                            <div class="flex flex-col">
                                <label>ประเภทผู้ใช้งาน</label>
                                <select required name="account_type" id="account_type" class="form-select">
                                    <option value="" disabled <?= !isset($account_detail["account_type"]) ? "selected" : "" ?>>เลือกประเภทผู้ใช้งาน</option>
                                    <option value="ผู้ใช้งานชั่วคราว" <?= (isset($account_detail["account_type"]) && $account_detail["account_type"] === "ผู้ใช้งานชั่วคราว") ? "selected" : "" ?>>ผู้ใช้งานชั่วคราว</option>
                                    <option value="ผู้ใช้งานประจำ" <?= (isset($account_detail["account_type"]) && $account_detail["account_type"] === "ผู้ใช้งานประจำ") ? "selected" : "" ?>>ผู้ใช้งานประจำ</option>
                                </select>

                            </div>
                            <select required name="account_detail" id="account_detail" disabled class="form-select mt-2">
                                <option value="" disabled <?= !isset($account_detail["account_detail"]) ? "selected" : "" ?>>รายละเอียดผู้ใช้งาน</option>

                                <?php
                                $account_type = $account_detail["account_type"] ?? "";
                                $account_detail_selected = $account_detail["account_detail"] ?? "";

                                $options = [];

                                if ($account_type === "ผู้ใช้งานชั่วคราว") {
                                    $options = ["นักศึกษาฝึกงาน", "ผู้ใช้อื่นๆ"];
                                } elseif ($account_type === "ผู้ใช้งานประจำ") {
                                    $options = ["เจ้าหน้าที่โรงพยาบาลนางรอง", "คณะกรรมการ IT", "เจ้าหน้าที่ สอ./สสอ./รพ.สต"];
                                }

                                foreach ($options as $opt) {
                                    $selected = $account_detail_selected === $opt ? "selected" : "";
                                    echo "<option value=\"$opt\" $selected>$opt</option>";
                                }
                                ?>
                            </select>

                            <input type="text" name="account_deatil_txt" id="account_deatil_txt" placeholder="จาก" disabled class="form-control mt-2">
                            <div class="flex flex-col">
                                <label>ใช้ถึงวันที่</label>
                                <input type="date" name="account_deatil_date" id="account_deatil_date" disabled class="form-control mt-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">ข้อมูลการเข้าสู่ระบบ</div>
                        </div>
                        <div class="card-body">
                            <div class="flex flex-col">
                                <div class="flex flex-col">
                                    <label class="flex gap-1">ชื่อผู้ใช้ <label class="text-red-500">*</label></label>
                                    <input autocomplete="off" value="<?php if (isset($account_detail["username"])) {
                                                                            echo $account_detail["username"];
                                                                        } ?>" required type="text" class="form-control" name="username" placeholder="บังคับ ชื่อจุดนามสกุลสองหลัก เช่น pakpoom.me">
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="flex flex-col mt-2">
                                        <label class="flex gap-1">รหัสผ่าน <label class="text-red-500">*</label></label>
                                        <input id="password" autocomplete="off" minlength="8" value="<?php if (isset($account_detail["password"])) {
                                                                                                            echo $account_detail["password"];
                                                                                                        } ?>" required type="password" class="form-control" name="password" placeholder="อย่างน้อยต้อง 8 หลักขึ้นไป">
                                    </div>
                                    <div class="flex flex-col mt-2">
                                        <label class="flex gap-1">ยืนยันรหัสผ่าน <label class="text-red-500">*</label></label>
                                        <input id="repassword" autocomplete="off" minlength="8" value="<?php if (isset($account_detail["repassword"])) {
                                                                                                            echo $account_detail["repassword"];
                                                                                                        } ?>" required type="password" class="form-control" name="repassword" placeholder="อย่างน้อยต้อง 8 หลักขึ้นไป">
                                    </div>
                                </div>
                                <div class="my-2 text-xs text-gray-500">
                                    <label>รหัสผ่านต้องประกอบไปด้วยภาษาอังกฤษตัวพิมพ์เล็กตัวพิมพ์ใหญ่ ตัวเลขและอักขระพิเศษ (!, #, %, *, @)</label>
                                </div>
                                <button class="mt-1 w-full text-xs flex justify-start gap-2" type="button" id="show-password-btn" name="show-password-btn">
                                    <i class="bi bi-eye-fill text-primary"></i> ดูรหัสผ่าน
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-3 gap-2 max-lg:mb-4">
                <a href="/system_req" style="text-decoration: none;" class="btn btn-warning" disabled type="button">
                    ย้อนกลับ
                </a>
                <a href="./cancel.php" style="text-decoration: none;" class="btn btn-danger">ยกเลิก</a>
                <button value="set_account" name="function_set" class="btn btn-success" type="submit">
                    ต่อไป
                </button>
            </div>
        </form>
    </div>

    <script>
        window.addEventListener("DOMContentLoaded", function() {
            const accountType = "<?= $account_detail['account_type'] ?? '' ?>";
            const accountDetail = "<?= $account_detail['account_detail'] ?? '' ?>";
            const detailTxt = "<?= $account_detail['account_deatil_txt'] ?? '' ?>";
            const detailDate = "<?= $account_detail['account_deatil_date'] ?? '' ?>";

            const typeSelect = document.getElementById("account_type");
            const detailSelect = document.getElementById("account_detail");
            const detailInput = document.getElementById("account_deatil_txt");
            const detailDateInput = document.getElementById("account_deatil_date");

            if (accountType) {
                typeSelect.value = accountType;
                typeSelect.dispatchEvent(new Event("change"));

                setTimeout(() => {
                    detailSelect.value = accountDetail;
                    detailSelect.dispatchEvent(new Event("change"));

                    if (detailTxt) {
                        detailInput.value = detailTxt;
                    }
                    if (detailDate) {
                        detailDateInput.value = detailDate;
                    }
                }, 100); // รอให้ options โหลดก่อนค่อย set ค่า
            }
        });
    </script>


    <script>
        document.getElementById("show-password-btn").addEventListener("click", () => {
            const password = document.getElementById("password");
            const repassword = document.getElementById("repassword");

            const type = password.getAttribute("type") === "password" ? "text" : "password";

            password.setAttribute("type", type);
            repassword.setAttribute("type", type);
        });

        document.getElementById("account_type").addEventListener("change", function() {
            const detailSelect = document.getElementById("account_detail");
            const detailInput = document.getElementById("account_deatil_txt");
            const detailDate = document.getElementById("account_deatil_date");

            // เปิดใช้งาน select และเคลียร์ค่าทุกช่อง
            detailSelect.disabled = false;
            detailSelect.innerHTML = '<option selected disabled>รายละเอียดผู้ใช้งาน</option>';
            detailInput.value = "";
            detailDate.value = "";
            detailInput.disabled = true;
            detailDate.disabled = true;

            let options = [];

            if (this.value === "ผู้ใช้งานชั่วคราว") {
                options = ["นักศึกษาฝึกงาน", "ผู้ใช้อื่นๆ"];
                detailInput.disabled = false;
                detailDate.disabled = false;
            } else if (this.value === "ผู้ใช้งานประจำ") {
                options = [
                    "เจ้าหน้าที่โรงพยาบาลนางรอง",
                    "คณะกรรมการ IT",
                    "เจ้าหน้าที่ สอ./สสอ./รพ.สต"
                ];
            }

            options.forEach(optionText => {
                const opt = document.createElement("option");
                opt.value = optionText;
                opt.text = optionText;
                detailSelect.appendChild(opt);
            });
        });

        document.getElementById("account_detail").addEventListener("change", function() {
            const detailInput = document.getElementById("account_deatil_txt");
            const detailDate = document.getElementById("account_deatil_date");
            const accountType = document.getElementById("account_type").value;

            // Reset input
            detailInput.disabled = true;
            detailDate.disabled = true;

            if (accountType === "ผู้ใช้งานชั่วคราว") {
                detailInput.disabled = false;
                detailDate.disabled = false;
            } else if (accountType === "ผู้ใช้งานประจำ") {
                if (this.value === "คณะกรรมการ IT" || this.value === "เจ้าหน้าที่ สอ./สสอ./รพ.สต") {
                    detailInput.disabled = false;
                }
            }
        });
    </script>

</body>

</html>