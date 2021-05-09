<?php
//Menambahkan library PhpSpreadsheet dan koneksi ke database
include ('koneksi.php');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//inisiasi variable
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet ->getActiveSheet();

//mengatur isi tabel
$sheet ->setCellValue('A1', 'No');
$sheet ->setCellValue('B1', 'Nama');
$sheet ->setCellValue('C1', 'Kelas');
$sheet ->setCellValue('D1', 'Alamat');

//query ke database
$query = mysqli_query($koneksi, "SELECT * FROM tb_siswa");
$i = 2;
$no = 1;
//mengambil data dari database dimasukkan kedalam sheet
while($row = mysqli_fetch_array($query)){
    $sheet ->setCellValue('A'.$i, $no++);
    $sheet ->setCellValue('B'.$i, $row['nama']);
    $sheet ->setCellValue('C'.$i, $row['kelas']);
    $sheet ->setCellValue('D'.$i, $row['alamat']);
    $i++;
}
//membuat style border tabel
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];
$i = $i-1;
$sheet->getStyle('A1:D'.$i) ->applyFromArray($styleArray);

//menyimpan data pada file xlsx
$writer = new Xlsx($spreadsheet);
$writer ->save('Report Data Siswa.xlsx');
?>