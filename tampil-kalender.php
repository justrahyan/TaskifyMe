<?php
    session_start();
    ob_start();
    if (isset($_SESSION['userweb'])) {
        include './koneksi.php';

        // Ambil id_user dari session
        $id_user = $_SESSION['id_user'];
    } else {
        header("location:login.php");
        exit();
    }

    $tampil = mysqli_query($koneksi, "SELECT * FROM task WHERE user_id = '$id_user' order by id");

    $dataArr = array();
    while($data = mysqli_fetch_array($tampil)){
        $dataArr[] = array(
            'id' => $data['id'],
            'title' => $data['task_name'],
            'start' => date('Y-m-d', strtotime($data['deadline'])),
        );
    }
    header('Content-Type: application/json');

    echo json_encode($dataArr);
?>