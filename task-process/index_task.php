<?php
include '../koneksi.php';
session_start();

if(isset($_POST['click_view_btn'])){
    $id_pengguna = $_POST['user_id'];
    $id_tugas = $_POST['id_task'];

    $sql = mysqli_query($koneksi, "SELECT * FROM task WHERE user_id = '$id_pengguna' AND id = '$id_tugas'");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        // Menyiapkan data dalam format JSON
        echo json_encode([
            'task_name' => $row['task_name'],
            'description' => $row['description'],
            'status' => $row['status'],
            'categories' => $row['categories'],
            'deadline' => $row['deadline'],
            'priority' => $row['priority'],
            'details' => '
            <div class="description d-flex flex-row align-items-center mb-2">
                <img src="assets/img/icon/align-left.png" alt="">
                <h6 class="mb-0">Deskripsi Lengkap</h6>
            </div>
            <div class="d-flex flex-row gap-2 w-100">
                <div class="description-form w-100">
                    <textarea class="form-control description-input mb-2" name="description" placeholder="Anda belum memasukkan deskripsi" data-task-id="' . $row['id'] . '" disabled>' . htmlspecialchars($row['description']) . '</textarea>
                </div>
                <div class="menu-container d-flex flex-column gap-2">
                    <div class="status-form">
                        <input type="text" class="form-control status-input mb-2" aria-label="Status" value="' . ($row['status'] == '1' ? 'Belum Dikerja' : ($row['status'] == '2' ? 'Sedang Dikerja' : 'Selesai')) . '" disabled />
                    </div>
                    <div class="categories-form">
                        <input type="text" class="form-control categories-input mb-2" aria-label="Kategori" value="' . htmlspecialchars($row['categories']) . '" disabled />
                    </div>
                    <div class="deadline-form">
                        <input type="text" class="form-control deadline-input mb-2" aria-label="Tanggal" value="' . date('Y-m-d', strtotime($row['deadline'])) . '" disabled />
                    </div>
                    <div class="priority-form">
                        <input type="text" class="form-control priority-input mb-2" aria-label="Prioritas" value="' . ($row['priority'] == 1 ? 'Rendah' : ($row['priority'] == 2 ? 'Sedang' : 'Tinggi')) . '" disabled />
                    </div>
                </div>
            </div>
            '
        ]);
    } else { 
        echo '<h4>No record found</h4>';
    }
}
?>