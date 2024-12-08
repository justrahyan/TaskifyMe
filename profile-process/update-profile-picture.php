<?php
include('../koneksi.php'); // Pastikan file koneksi sudah benar
session_start();

// Pastikan ada file yang di-upload
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $file = $_FILES['profile_picture'];
    $fileName = basename($file['name']);
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validasi ekstensi file
    if (in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
        // Tentukan nama file baru dan lokasi penyimpanan
        $newFileName = uniqid() . '.' . $fileExtension;
        $uploadDir = '../assets/img/profil/';
        $uploadFile = $uploadDir . $newFileName;

        // Pindahkan file ke direktori tujuan
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            // Ambil id_user untuk update gambar di database
            $id_user = $_SESSION['id_user']; // Pastikan ID pengguna ada di sesi
            if (!$id_user) {
                $_SESSION['error-update'] = "Pengguna tidak ditemukan";
                echo json_encode(['success' => false, 'message' => 'Pengguna tidak ditemukan']);
                exit;
            }

            // Query update gambar di database
            $sql = "UPDATE user SET picture = '$newFileName' WHERE id = '$id_user'";
            if (mysqli_query($koneksi, $sql)) {
                $_SESSION['success-update'] = "Foto profil berhasil diperbarui";
                echo json_encode(['success' => true, 'message' => 'Foto profil berhasil diupdate']);
            } else {
                $_SESSION['error-update'] = "Gagal memperbarui foto profil";
                echo json_encode(['success' => false, 'message' => 'Gagal memperbarui gambar di database']);
            }
        } else {
            $_SESSION['error-update'] = "Gagal meng-upload gambar";
            echo json_encode(['success' => false, 'message' => 'Gagal meng-upload gambar']);
        }
    } else {
        $_SESSION['error-update'] = "Ekstensi file tidak valid";
        echo json_encode(['success' => false, 'message' => 'Ekstensi file tidak valid.']);
    }
} else {
    $_SESSION['error-update'] = "Tidak ada file yang di-upload";
    echo json_encode(['success' => false, 'message' => 'Tidak ada file yang di-upload.']);
}
?>
