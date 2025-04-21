<?php
session_start();

require("./vendor/autoload.php");
use setasign\Fpdi\Fpdi;



if (isset($_SESSION["success_data"])) {
    $success_data = $_SESSION["success_data"];

    $id_card = $success_data["id_card"];
    $name_th = $success_data["name_th"];
    $name_en = $success_data["name_en"];
    $birthdate = $success_data["birthdate"];
    $position = $success_data["position"];
    $department = $success_data["department"];
    $license_no = $success_data["license_no"];
    $phone = $success_data["phone"];
    $email = $success_data["email"];
    $username = $success_data["username"];
    $password = $success_data["password_hash"];

    $pdf = new Fpdi();

    $pdf->AddPage();
    $pdf->setSourceFile(__DIR__ . "/template/template.pdf");
    $template = $pdf->importPage(1);
    $pdf->useTemplate($template);

    $pdf->AddFont("THSarabunNew", "", "THSarabunNew.php");
    $pdf->SetFont("THSarabunNew", "", 16);

    $pdf->SetXY(67, 45.5 + 1.5);
    $pdf->Cell(0, 0, iconv('UTF-8', 'TIS-620', $id_card));

    $pdf->SetXY(67, 51.6 + 2.3);
    $pdf->Cell(0, 0, iconv('UTF-8', 'TIS-620', $name_th));

    $pdf->SetXY(67, 57.1 + 2.5);
    $pdf->Cell(0, 0, iconv('UTF-8', 'TIS-620', $name_en));

    $birthdate_thai = thai_date_full($birthdate);
    $pdf->SetXY(67, 64.7 + 2);
    $pdf->Cell(0, 0, iconv('UTF-8', 'TIS-620', $birthdate_thai));

    $pdf->SetXY(67, 71 + 2.5);
    $pdf->Cell(0, 0, iconv('UTF-8', 'TIS-620', $position));

    $pdf->SetXY(67, 77.8 + 2);
    $pdf->Cell(0, 0, iconv('UTF-8', 'TIS-620', $department));

    $pdf->SetXY(67, 84.5 + 2);
    $pdf->Cell(0, 0, iconv('UTF-8', 'TIS-620', $license_no ?? "-"));

    $pdf->SetXY(67, 90.9 + 2);
    $pdf->Cell(0, 0, iconv('UTF-8', 'TIS-620', $email));

    $pdf->SetXY(67, 97.4 + 2);
    $pdf->Cell(0, 0, iconv('UTF-8', 'TIS-620', $phone));

    $pdf->SetXY(67, 104 + 2);
    $pdf->Cell(0, 0, iconv('UTF-8', 'TIS-620', $username));

    $pdf->SetXY(67, 110.5 + 2);
    $pdf->Cell(0, 0, iconv('UTF-8', 'TIS-620', $password));

    $pdf->SetXY(113, 199);
    $pdf->Cell(0, 0, iconv('UTF-8', 'TIS-620', $name_th));

    $timestamp = date("Ymd_His");
    $pdf->Output('D', "$timestamp.pdf");
    header("Location: /system_req/success.php");
    return;

} else {
    echo "ไม่พบข้อมูลคำขอในเซสชัน";
    return;
}

function thai_date_full($date)
{
    $months = [
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

    $d = date("j", strtotime($date));
    $m = date("n", strtotime($date));
    $y = date("Y", strtotime($date)) + 543;

    return "$d {$months[$m]} $y";
}


?>