<?php
// export_data.php
include("sess_check.php");
include_once("function.php");
include('vendor/autoload.php'); // Load PHPspreadsheet library
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
// use PhpOffice\PhpSpreadsheet\Style\Fill;

// $tableHead = [
//     'font'=>[
//         'color'=>[
//             'rbg'=>'FFFFF'
//         ],
//     ],
//     'fill'=>[
//         'fillType' => Fill::FILL_SOLID,
//         'starColor' => [
//             'rbg' => '538ED5'
//         ],
//     ],
// ];

$selectedYear = mysqli_real_escape_string($conn, $_POST['selectYear']);

// Query untuk mengambil data berdasarkan tahun
$sqlExport = "SELECT pengajuan.*, master_opd.nama_opd, master_acara.nama_acara, master_acara.durasi, pengajuan.tahun_acara FROM pengajuan INNER JOIN master_opd ON pengajuan.id_opd = master_opd.id_opd INNER JOIN master_acara ON pengajuan.id_acara = master_acara.id_acara WHERE pengajuan.status_pengajuan = 'Approved' AND pengajuan.tahun_acara = '{$selectedYear}' ORDER BY master_acara.nama_acara ASC";
$resultExport = mysqli_query($conn, $sqlExport);

// Handling jika tidak ada data ditemukan
if (mysqli_num_rows($resultExport) > 0) {
    // Kode ekspor data tetap sama
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $spreadsheet->getDefaultStyle()
                ->getFont()
                ->setName('Times New Roman')
                ->setSize(12);
    
    $spreadsheet->getActiveSheet()
        ->setCellValue('B1',"DATA PENGAJUAN SERTIFIKAT");
    $spreadsheet->getActiveSheet()
        ->setCellValue('B3',"Penyelenggara : Dinas Komunikasi dan Informatika Kabupaten Kediri");

    $spreadsheet->getActiveSheet()->mergeCells("B1:H1");
    $spreadsheet->getActiveSheet()->mergeCells("B3:H3");
    $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setName('Times New Roman')->setSize(14)->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('B3')->getFont()->setName('Times New Roman')->setSize(12)->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('B:H')->getFont()->setName('Times New Roman')->setSize(12);
    
    $spreadsheet->getActiveSheet()->getStyle('B5:H5')->getFont()->setName('Times New Roman')->setBold(true);
    // $spreadsheet->getActiveSheet()->getStyle('B3:G3')->applyFromArray($tableHead);
    
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('A')
                ->setAutoSize(true);

    $spreadsheet->getActiveSheet()
                ->getColumnDimension('B')
                ->setAutoSize(true);

    $spreadsheet->getActiveSheet()
                ->getColumnDimension('C')
                ->setAutoSize(true);

    $spreadsheet->getActiveSheet()
                ->getColumnDimension('D')
                ->setAutoSize(true);

    $spreadsheet->getActiveSheet()
                ->getColumnDimension('E')
                ->setAutoSize(true);

    $spreadsheet->getActiveSheet()
                ->getColumnDimension('F')
                ->setAutoSize(true);

    $spreadsheet->getActiveSheet()
                ->getColumnDimension('G')
                ->setAutoSize(true);

    $spreadsheet->getActiveSheet()
                ->getColumnDimension('H')
                ->setAutoSize(true);

    // Tambahkan header kolom
    $sheet->setCellValue('B5', 'No');
    $sheet->setCellValue('C5', 'Nama Peserta');
    $sheet->setCellValue('D5', 'OPD');
    $sheet->setCellValue('E5', 'Nama Acara');
    $sheet->setCellValue('F5', 'Tahun Acara');
    $sheet->setCellValue('G5', 'Email');
    $sheet->setCellValue('H5', 'Durasi (Menit)');
    // ... (Tambahkan kolom-kolom lain sesuai kebutuhan)

    $row = 6;
    $i= 1;
    while ($dataExport = mysqli_fetch_assoc($resultExport)) {
        $sheet->setCellValue('B' . $row, $i);
        $sheet->setCellValue('C' . $row, $dataExport['nama']);
        $sheet->setCellValue('D' . $row, $dataExport['nama_opd']);
        $sheet->setCellValue('E' . $row, $dataExport['nama_acara']);
        $sheet->setCellValue('F' . $row, $dataExport['tahun_acara']);
        $sheet->setCellValue('G' . $row, $dataExport['email']);
        $sheet->setCellValue('H' . $row, $dataExport['durasi']);
        // ... (Tambahkan data lain sesuai kebutuhan)

        $row++;
        $i++;
    }

    // Save to Excel file
    $pathDir = '/exports/';
    $fullPathDir = dirname(__FILE__).$pathDir;
    $filename = 'Export_Data_' . $selectedYear . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $pathDir.$filename . '"');
    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save($fullPathDir.$filename);
    echo baseUrl($pathDir.$filename);
    exit;
} else {
    echo "Tidak ada data yang ditemukan untuk tahun yang dipilih.";
}
