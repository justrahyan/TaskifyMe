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
    // Query untuk mengambil data tugas
    $sql = "SELECT * FROM task WHERE user_id = $id_user AND deadline <= DATE_ADD(CURDATE(), INTERVAL 5 DAY) AND (status IS NULL OR status != 3)";
    
    // Eksekusi query
    $result = mysqli_query($koneksi, $sql);
    
    if (!$result) {
        throw new Exception("Gagal menjalankan query: " . mysqli_error($koneksi));
    }

    // Ambil semua hasil sebagai array
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
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
