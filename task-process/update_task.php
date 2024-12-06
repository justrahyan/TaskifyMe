<?php
include '../koneksi.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'], $data['description'])) {
    $id = intval($data['id']);
    $description = mysqli_real_escape_string($koneksi, $data['description']);

    $query = "UPDATE task SET description = '$description' WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    echo json_encode(['success' => $result]);
} else {
    echo json_encode(['success' => false]);
}
?>