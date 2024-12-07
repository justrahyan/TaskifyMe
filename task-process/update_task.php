<?php
session_start();
include '../koneksi.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = intval($data['id']);
    $description = isset($data['description']) ? mysqli_real_escape_string($koneksi, $data['description']) : null;
    $status = isset($data['status']) ? intval($data['status']) : null;
    $priority = isset($data['priority']) ? mysqli_real_escape_string($koneksi, $data['priority']) : null;
    $deadline = isset($data['deadline']) ? mysqli_real_escape_string($koneksi, $data['deadline']) : null;
    $categories = isset($data['categories']) ? mysqli_real_escape_string($koneksi, $data['categories']) : null;

    $query = "UPDATE task SET ";
    $fields = [];

    if ($description !== null) {
        $fields[] = "description = '$description'";
    }
    if ($status !== null) {
        $fields[] = "status = $status";
    }
    if ($priority !== null) {
        $fields[] = "priority = '$priority'";
    }
    if ($deadline !== null) {
        $fields[] = "deadline = '$deadline'";
    }
    if ($categories !== null) {
        $fields[] = "categories = '$categories'";
    }

    if (count($fields) > 0) {
        $query .= implode(", ", $fields) . " WHERE id = $id";

        if (mysqli_query($koneksi, $query)) {
            // Set session alert for successful update
            $_SESSION['status-task'] = "Tugas berhasil diperbarui";
            echo json_encode(['success' => true]);
        } else {
            $_SESSION['error-task'] = "Gagal memperbarui tugas";
            echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($koneksi)]);
        }
    } else {
        $_SESSION['status-task'] = "Tidak ada data yang diperbarui";
        echo json_encode(['success' => false, 'message' => 'No valid fields to update']);
    }
} else {
    $_SESSION['status-task'] = "ID tugas tidak valid";
    echo json_encode(['success' => false, 'message' => 'Task ID is required']);
}
?>