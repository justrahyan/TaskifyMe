<?php
// Aktifkan error reporting di awal file
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include file koneksi
include './koneksi.php';
session_start();

// Set header JSON
header('Content-Type: application/json');

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    echo json_encode([
        'error' => 'User belum login',
        'session_info' => print_r($_SESSION, true)
    ]);
    exit;
}

$id_user = $_SESSION['id_user'];

try {
    // Query untuk mengambil tugas yang sudah melewati deadline
    $overdueSql = "SELECT * FROM task WHERE user_id = $id_user AND deadline < CURDATE() AND (status IS NULL OR status != 3)";

    // Query untuk mengambil tugas yang belum melewati deadline
    $upcomingSql = "SELECT * FROM task WHERE user_id = $id_user AND deadline >= CURDATE() AND (status IS NULL OR status != 3)";
    
    // Eksekusi query untuk tugas yang sudah terlambat
    $overdueResult = mysqli_query($koneksi, $overdueSql);
    if (!$overdueResult) {
        throw new Exception("Gagal menjalankan query: " . mysqli_error($koneksi));
    }

    // Eksekusi query untuk tugas yang belum terlambat
    $upcomingResult = mysqli_query($koneksi, $upcomingSql);
    if (!$upcomingResult) {
        throw new Exception("Gagal menjalankan query: " . mysqli_error($koneksi));
    }

    // Ambil hasil query sebagai array
    $overdueTasks = mysqli_fetch_all($overdueResult, MYSQLI_ASSOC);
    $upcomingTasks = mysqli_fetch_all($upcomingResult, MYSQLI_ASSOC);

    // Gabungkan tugas yang terlambat dan yang belum terlambat
    $tasks = [
        'overdue' => $overdueTasks,
        'upcoming' => $upcomingTasks
    ];

    // Kirim JSON
    echo json_encode($tasks);
} catch (Exception $e) {
    // Tangani error
    echo json_encode([
        'error' => 'Gagal mengambil tugas',
        'error_details' => $e->getMessage()
    ]);
}
?>
