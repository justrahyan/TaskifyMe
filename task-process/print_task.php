<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "taskifyme");
$task_id = isset($_GET['task_id']) ? $_GET['task_id'] : null;

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
$query = mysqli_query($koneksi, "
    SELECT t.*, c.name 
    FROM task t
    LEFT JOIN categories c ON t.categories = c.id
    WHERE t.user_id = '$id_user' 
    AND t.id = '$task_id'
");
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
    if($row['priority'] == 1){
      $priority = "Rendah";
    }elseif($row['priority'] == 2){
        $priority = "Sedang";
    } elseif($row['priority'] == 3){
        $priority = "Tinggi";
    } else {
      $priority = null;
    }
    $pdf->Cell(20, 6, $no++, 1, 0, 'C');
    $pdf->Cell(70, 6, $row['task_name'], 1, 0, 'C');
    $pdf->Cell(120, 6, $row['description'], 1, 0, 'C');
    $pdf->Cell(50, 6, $status, 1, 0, 'C');
    $pdf->Cell(50, 6, $row['name'], 1, 0, 'C');
    $pdf->Cell(40, 6, $row['deadline'], 1, 0, 'C');
    $pdf->Cell(50, 6, $priority, 1, 1, 'C');
}

$pdf->Cell(40, 7, '', 0, 1);
$pdf->Cell(65, 7, 'TaskifyMe', 0, 1, 'L');
$pdf->Output();
