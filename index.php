<?php
session_start();

$data = array();

if (isset($_SESSION["private_data"])) {
    $data = $_SESSION["private_data"];
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
        <div class="container">
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
                    <i class="bi bi-person-vcard fs-3 text-danger"></i>
                    <label class="text-danger">ข้อมูลส่วนตัว</label>
                </div>
                <div class="w-30 h-1 bg-sky-500 rounded-full"></div>
                <div class="flex flex-col items-center">
                    <i class="bi bi-person-bounding-box fs-3 text-gray-400"></i>
                    <label class="text-gray-400">ชื่อผู้ใช้และรหัสผ่าน</label>
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
                <div class="flex gap-3 mt-4 w-1/2">
                    <i class="bi bi-person-check fs-3 text-primary"></i>
                    <div class="card w-full">
                        <div class="card-header">
                            <div class="text-center">ข้อมูลส่วนตัว</div>
                        </div>
                        <div class="card-body">
                            <div class="grid grid-cols-8 gap-2">
                                <div class="col-span-4 flex flex-col">
                                    <label class="flex gap-1">เลขที่บัตรประจำตัวประชาชน <label class="text-red-500">*</label></label>
                                    <input type="text" name="id_card" id="id_card" value="<?php if ($data !== []) {
                                                                                                echo $data["id_card"];
                                                                                            }  ?>" class="form-control" required maxlength="13" autocomplete="off">
                                </div>
                                <div class="col-span-4 flex flex-col">
                                    <label class="flex gap-1">วัน / เดือน / ปี (คศ) เกิด <label class="text-red-500">*</label></label>
                                    <input type="date" name="birth" id="birth" value="<?php if ($data !== []) {
                                                                                            echo $data["birth"];
                                                                                        }
                                                                                        ?>" class="form-control" required autocomplete="off">
                                </div>
                                <!-- Th Name -->
                                <div class="col-span-2">
                                    <label class="flex gap-1">คำนำหน้า <label class="text-red-500">*</label></label>
                                    <select name="prefix-th" id="prefix-th" class="form-control" required autocomplete="off">
                                        <option disabled <?php if (empty($data["prefix-th"])) echo "selected"; ?>>เลือกคำนำหน้า</option>
                                        <option value="นาย" <?php if (!empty($data["prefix-th"]) && $data["prefix-th"] == "นาย") echo "selected"; ?>>นาย</option>
                                        <option value="นาง" <?php if (!empty($data["prefix-th"]) && $data["prefix-th"] == "นาง") echo "selected"; ?>>นาง</option>
                                        <option value="นางสาว" <?php if (!empty($data["prefix-th"]) && $data["prefix-th"] == "นางสาว") echo "selected"; ?>>นางสาว</option>
                                    </select>
                                </div>
                                <div class="col-span-3 flex flex-col">
                                    <label class="flex gap-1">ชื่อ (ภาษาไทย) <label class="text-red-500">*</label></label>
                                    <input type="text" name="first_name_th" value="<?php if ($data !== []) {
                                                                                        echo $data["first_name_th"];
                                                                                    }
                                                                                    ?>" id="first_name_th" class="form-control" required autocomplete="off">
                                </div>
                                <div class="col-span-3 flex flex-col">
                                    <label class="flex gap-1">นามสกุล (ภาษาไทย) <label class="text-red-500">*</label></label>
                                    <input type="text" name="last_name_th" value="<?php if ($data !== []) {
                                                                                        echo $data["last_name_th"];
                                                                                    }
                                                                                    ?>" id="last_name_th" class="form-control" required autocomplete="off">
                                </div>

                                <!-- En Name -->
                                <div class="col-span-2">
                                    <label class="flex gap-1">คำนำหน้า <label class="text-red-500">*</label></label>
                                    <select name="prefix-en" id="prefix-en" class="form-control" required autocomplete="off">
                                        <option disabled <?php if (empty($data["prefix-en"])) echo "selected"; ?>>
                                            เลือกคำนำหน้า
                                        </option>
                                        <option value="Mr." <?php if (!empty($data["prefix-en"]) && $data["prefix-en"] == "Mr.") echo "selected"; ?>>Mr.</option>
                                        <option value="Mrs." <?php if (!empty($data["prefix-en"]) && $data["prefix-en"] == "Mrs.") echo "selected"; ?>>Mrs.</option>
                                        <option value="Ms." <?php if (!empty($data["prefix-en"]) && $data["prefix-en"] == "Ms.") echo "selected"; ?>>Ms.</option>
                                    </select>
                                </div>
                                <div class="col-span-3 flex flex-col">
                                    <label class="flex gap-1">ชื่อ (ภาษาภาษาอังกฤษ) <label class="text-red-500">*</label></label>
                                    <input type="text" name="first_name_en" value="<?php if ($data !== []) {
                                                                                        echo $data["first_name_en"];
                                                                                    }
                                                                                    ?>" id="first_name_en" class="form-control" required autocomplete="off">
                                </div>
                                <div class="col-span-3 flex flex-col">
                                    <label class="flex gap-1">นามสกุล (ภาษาภาษาอังกฤษ) <label class="text-red-500">*</label></label>
                                    <input type="text" name="last_name_en" value="<?php if ($data !== []) {
                                                                                        echo $data["last_name_en"];
                                                                                    }
                                                                                    ?>" id="last_name_en" class="form-control" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3 mt-4 w-1/2">
                    <i class="bi bi-geo-alt-fill fs-3 text-danger"></i>
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">ข้อมูลอาชีพ</div>
                        </div>
                        <div class="card-body">
                            <div class="grid grid-cols-3 gap-2">
                                <div class="flex flex-col">
                                    <label class="flex gap-1">ตำแหน่ง <label class="text-red-500">*</label></label>
                                    <input type="text" name="position" value="<?php if ($data !== []) {
                                                                                    echo $data["position"];
                                                                                }
                                                                                ?>" id="position" class="form-control" required autocomplete="off">
                                </div>
                                <div class="flex flex-col">
                                    <label class="flex gap-1">แผนก / หน่วยงาน <label class="text-red-500">*</label></label>
                                    <input type="text" name="department" value="<?php if ($data !== []) {
                                                                                    echo $data["department"];
                                                                                }
                                                                                ?>" id="department" class="form-control" required autocomplete="off">
                                </div>
                                <div class="flex flex-col">
                                    <label class="flex gap-1">เลขที่ใบประกอบวิชาชีพ</label>
                                    <input type="text" name="license_number" value="<?php if ($data !== []) {
                                                                                        echo $data["license_number"];
                                                                                    }
                                                                                    ?>" id="license_number" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3 mt-4 w-1/2">
                    <i class="bi bi-person-lines-fill fs-3 text-purple-500"></i>
                    <div class="card w-full">
                        <div class="card-header">
                            <div class="text-center">ข้อมูลติดต่อ</div>
                        </div>
                        <div class="card-body">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="flex flex-col">
                                    <label class="flex gap-1">เบอร์โทร <label class="text-red-500">*</label></label>
                                    <input type="text" name="phone" value="<?php if ($data !== []) {
                                                                                echo $data["phone"];
                                                                            }
                                                                            ?>" id="phone" class="form-control" required autocomplete="off">
                                </div>
                                <div class="flex flex-col">
                                    <label class="flex gap-1">อีเมล <label class="text-red-500">*</label></label>
                                    <input type="email" name="email" value="<?php if ($data !== []) {
                                                                                echo $data["email"];
                                                                            }
                                                                            ?>" id="email" class="form-control" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-3 gap-2">
                    <button class="btn btn-warning" disabled type="button">
                        ย้อนกลับ
                    </button>
                    <a href="./cancel.php" style="text-decoration: none;" class="btn btn-danger">ยกเลิก</a>
                    <button value="set_private_data" name="function_set" class="btn btn-success" type="submit">
                        ต่อไป
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>