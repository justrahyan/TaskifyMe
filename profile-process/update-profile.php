<?php
include '../koneksi.php';
session_start();

$data = json_decode(file_get_contents('php://input'), true);
$id_user = $_SESSION['id_user'];

// Check if the user is updating their username, birthdate, email, phone, or password
if (isset($data['username'])) {
    $newUsername = mysqli_real_escape_string($koneksi, $data['username']);
    $sql = "UPDATE user SET username = '$newUsername' WHERE id = '$id_user'";
} elseif (isset($data['birthdate'])) {
    $newBirthdate = mysqli_real_escape_string($koneksi, $data['birthdate']);
    $sql = "UPDATE user SET birthdate = '$newBirthdate' WHERE id = '$id_user'";
} elseif (isset($data['gender'])) {
    $gender = mysqli_real_escape_string($koneksi, $data['gender']);
    $sql = "UPDATE user SET gender = '$gender' WHERE id = '$id_user'";
} elseif (isset($data['email'])) {
    $newEmail = mysqli_real_escape_string($koneksi, $data['email']);
    $sql = "UPDATE user SET email = '$newEmail' WHERE id = '$id_user'";
} elseif (isset($data['phone'])) {
    $newPhone = mysqli_real_escape_string($koneksi, $data['phone']);
    $sql = "UPDATE user SET phone = '$newPhone' WHERE id = '$id_user'";
} elseif (isset($data['password'])) {
    // Check if old password is provided
    if (isset($data['old_password'])) {
        // Get the old password and new password
        $oldPassword = mysqli_real_escape_string($koneksi, $data['old_password']);
        $newPassword = mysqli_real_escape_string($koneksi, $data['password']);
        $confirmPassword = mysqli_real_escape_string($koneksi, $data['confirm_password']);
        
        // Fetch the current password from the database
        $result = mysqli_query($koneksi, "SELECT password FROM user WHERE id = '$id_user'");
        $row = mysqli_fetch_assoc($result);
        $currentPassword = $row['password'];

        // Verify if old password matches the current password in the database
        if ($oldPassword !== $currentPassword) {
            // Mengatur pesan error di dalam sesi
            $_SESSION['error-password'] = "Password lama salah.";
            echo json_encode(['success' => false, 'message' => $_SESSION['error-password']]);
            exit();
        } elseif ($newPassword !== $confirmPassword) {
            $_SESSION['error-password'] = "Konfirmasi password tidak cocok.";
            echo json_encode(['success' => false, 'message' => $_SESSION['error-password']]);
            exit();
        } else {
            // No hashing needed, directly use the new password
            $sql = "UPDATE user SET password = '$newPassword' WHERE id = '$id_user'";
        }
    } else {
        $_SESSION['error-password'] = "Password lama tidak ditemukan.";
        echo json_encode(['success' => false, 'message' => 'Password lama tidak ditemukan.']);
        exit();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
    exit();
}

// Execute the SQL query to update the user data
if (mysqli_query($koneksi, $sql)) {
    $_SESSION['success-update'] = "Biodata berhasil diperbarui";
    echo json_encode(['success' => true, 'message' => 'Data berhasil diperbarui']);
} else {
    $_SESSION['error-update'] = "Gagal memperbarui biodata";
    echo json_encode(['success' => false, 'message' => 'Error: ' . mysqli_error($koneksi)]);
}
?>
