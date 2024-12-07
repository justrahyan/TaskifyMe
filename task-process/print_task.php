<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "taskifyme");

// Koneksi library FPDF
require('library/fpdf.php');
// Setting halaman PDF
$pdf = new FPDF('l', 'mm', 'A3');
// Menambah halaman baru
$pdf->AddPage();
// Setting jenis font
$pdf->SetFont('helvetica', 'B', 20);
// Membuat string
$pdf->Cell(420, 7, 'TaskifyMe', 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(420, 7, 'Mudahkan Pengelolaan Tugas Anda', 0, 1, 'C');
// Setting spasi kebawah supaya tidak rapat
$pdf->Cell(40, 7, '', 0, 1);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(20, 6, 'No', 1, 0, 'C');
$pdf->Cell(70, 6, 'Nama Tugas', 1, 0, 'C');
$pdf->Cell(120, 6, 'Deskripsi', 1, 0, 'C');
$pdf->Cell(50, 6, 'Status', 1, 0, 'C');
$pdf->Cell(50, 6, 'Kategori', 1, 0, 'C');
$pdf->Cell(40, 6, 'Deadline', 1, 0, 'C');
$pdf->Cell(50, 6, 'Prioritas', 1, 1, 'C');

$pdf->SetFont('helvetica', '', 10);
$no = 1;
$id_user = $_SESSION['id_user'];
$query = mysqli_query($koneksi, "SELECT * FROM task WHERE user_id = '$id_user'");
while ($row = mysqli_fetch_array($query)) {
    if($row['status'] == 1){
        $status = "Belum Dikerja";
      }elseif($row['status'] == 2){
          $status = "Sedang Dikerja";
      } elseif($row['status'] == 3){
          $status = "Selesai";
      } else {
        $status = null;
      }
    $pdf->Cell(20, 6, $no++, 1, 0, 'C');
    $pdf->Cell(70, 6, $row['task_name'], 1, 0, 'C');
    $pdf->Cell(120, 6, $row['description'], 1, 0, 'C');
    $pdf->Cell(50, 6, $status, 1, 0, 'C');
    $pdf->Cell(50, 6, $row['categories'], 1, 0, 'C');
    $pdf->Cell(40, 6, $row['deadline'], 1, 0, 'C');
    $pdf->Cell(50, 6, $row['priority'], 1, 1, 'C');
}

$pdf->Cell(40, 7, '', 0, 1);
$pdf->Cell(65, 7, 'TaskifyMe', 0, 1, 'L');
$pdf->Output();
