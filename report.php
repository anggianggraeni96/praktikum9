<?php
//Menambahkan library PhpSpreadsheet
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//inisiasi variable dan mengisi tabel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet ->getActiveSheet();
$sheet ->setCellValue('A1', 'Hello Word !');

//menyimpan data pada file xlsx
$writer = new Xlsx($spreadsheet);
$writer ->save('hello word.xlsx');
?>