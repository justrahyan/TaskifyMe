<?php
include '../koneksi.php';

$query = "SELECT * FROM categories";
$result = mysqli_query($koneksi, $query);

$categories = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = [
            'id' => $row['id'],
            'name' => $row['name']  // Pastikan nama kolom sesuai dengan database
        ];
    }
}

echo json_encode([
    'success' => true,
    'categories' => $categories
]);
?>