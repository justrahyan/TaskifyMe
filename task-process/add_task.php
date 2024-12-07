<?php
include '../koneksi.php';
session_start();
if (!isset($_SESSION['id_user'])) {
    die("User belum login. Tidak dapat menyimpan tugas.");
}

      if (isset($_POST['simpan_tugas'])) {
        $id_user = $_SESSION['id_user'];
        $task_name = mysqli_real_escape_string($koneksi, $_POST['task_name']); // Hindari SQL Injection
        if (empty($task_name)) {
            $_SESSION['error-task'] = "Nama tugas tidak boleh kosong";
            header("location:tugas-saya.php");
            exit();
        }
        $sql = "INSERT INTO task (user_id, task_name) VALUES ('$id_user', '$task_name')"; // Pastikan tabel bernama 'tasks' dengan kolom 'user_id' dan 'task_name'
        if ($koneksi->query($sql) === true) {
            $_SESSION['status-task'] = "Tugas baru berhasil ditambahkan";
            header("location:../tugas-saya.php"); // Kembali ke halaman tugas
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
        $koneksi->close();
      }
    ob_end_flush();
    ?>