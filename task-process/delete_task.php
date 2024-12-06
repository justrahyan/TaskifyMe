<?php
require __DIR__ . '../koneksi.php'; // Perbaiki jalur file koneksi

if (isset($_GET['id'])) {
    // Sanitasi nilai ID untuk mencegah SQL Injection
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    $sql = "DELETE FROM task WHERE id = '$id';"; // Pastikan nama tabel benar: "task"

    if ($koneksi->query($sql) === true) {
        header("Location: ./tugas-saya.php"); // Redirect jika berhasil
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
} else {
    echo "ID tugas tidak ditemukan.";
}

$koneksi->close();
?>
