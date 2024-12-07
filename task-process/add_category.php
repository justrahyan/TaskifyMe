<?php
session_start();
include '../koneksi.php';

// Mengecek apakah user sudah terdaftar dalam session
if (isset($_SESSION['id_user'])) {
    $user_id = $_SESSION['id_user'];
} else {
    echo json_encode(['success' => false, 'message' => 'User tidak terdaftar']);
    exit();
}

// Mengambil data JSON yang dikirim
$data = json_decode(file_get_contents('php://input'), true);
var_dump($data);

// Validasi input
if (isset($data['name']) && !empty($data['name'])) {
    $name = mysqli_real_escape_string($koneksi, trim($data['name']));  // Sanitize input

    // Menyusun query untuk menambahkan kategori
    $query = "INSERT INTO categories (user_id, name) VALUES ('$user_id', '$name')";
    
    if (mysqli_query($koneksi, $query)) {
        // Mengembalikan response sukses dengan ID kategori yang baru
        echo json_encode(['success' => true, 'id' => mysqli_insert_id($koneksi)]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($koneksi)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}
?>