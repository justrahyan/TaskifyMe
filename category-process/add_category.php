<?php
session_start();
ob_start(); 
include '../koneksi.php';
$id_user = $_SESSION['id_user'];

if (isset($_POST['category_name'])) {
    $category_name = mysqli_real_escape_string($koneksi, $_POST['category_name']);

    // Cek jika kategori sudah ada
    $check = mysqli_query($koneksi, "SELECT * FROM categories WHERE name = '$category_name'");
    if (mysqli_num_rows($check) == 0) {
        // Insert kategori baru
        $query = "INSERT INTO categories (name, user_id) VALUES ('$category_name','$id_user')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            $category_id = mysqli_insert_id($koneksi);
            $_SESSION['status-task'] = 'Kategori berhasil ditambahkan!';
            header("location: ../tugas-saya.php"); // Redirect ke halaman tugas-saya.php setelah menambah kategori baru
            echo json_encode(['success' => true, 'category_id' => $category_id, 'category_name' => $category_name]);
        } else {
            $_SESSION['error-task'] = 'Terjadi kesalahan saat menambahkan kategori.';
            header("location: ../tugas-saya.php"); // Redirect ke halaman tugas-saya.php ketika terjadi kesalahan saat menambah kategori baru
            echo json_encode(['success' => false, 'message' => 'Error inserting category']);
        }
    } else {
        $_SESSION['error-task'] = 'Kategori sudah ada.';
        header("location: ../tugas-saya.php"); // Redirect ke halaman tugas-saya.php ketika kategori sudah ada
        echo json_encode(['success' => false, 'message' => 'Category already exists']);
    }
} else {
    $_SESSION['error-task'] = 'Nama kategori diperlukan.';
    header("location: ../tugas-saya.php"); // Redirect ke halaman tugas-saya.php ketika nama kategori belum dimasukkan
    echo json_encode(['success' => false, 'message' => 'Category name is required']);
}
exit();
?>
