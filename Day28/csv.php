<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$dataPenduduk = [
    ['Nama' => 'Basingsei', 'Usia' => 30, 'Alamat' => 'Jakarta', 'Pekerjaan' => 'Pengembang'],
    ['Nama' => 'Korra', 'Usia' => 21, 'Alamat' => 'Surabaya', 'Pekerjaan' => 'Desainer'],
    ['Nama' => 'Katara', 'Usia' => 20, 'Alamat' => 'Bandung', 'Pekerjaan' => 'Manajer'],
    ['Nama' => 'Zuko', 'Usia' => 23, 'Alamat' => 'Malang', 'Pekerjaan' => 'Staff'],
    ['Nama' => 'Aang', 'Usia' => 21, 'Alamat' => 'Semarang', 'Pekerjaan' => 'Staff'],
];

foreach ($dataPenduduk as $row => $data) {
    $column = 'A';
    foreach ($data as $key => $value) {
        $sheet->setCellValue($column . ($row + 1), $value);
        $column++;
    }
}

$writer = new Csv($spreadsheet);
$writer->save('data_penduduk.csv');

return $dataPenduduk;