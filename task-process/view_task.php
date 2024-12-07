<?php
include '../koneksi.php';
session_start();

if(isset($_POST['click_view_btn'])){
    $id_pengguna = $_POST['user_id'];
    $id_tugas = $_POST['id_task'];

    // echo $nama_tugas;
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
                    <textarea class="form-control description-input mb-2" name="description" placeholder="Masukkan detail deskripsi" data-task-id="' . $row['id'] . '">' . htmlspecialchars($row['description']) . '</textarea>
                    <button type="button" class="btn btn-save p-2 save-description-btn w-100" style="display: none;" data-task-id="' . $row['id'] . '">Simpan</button>
                </div>
                <div class="menu-container d-flex flex-column gap-2">
                    <div class="status-form">
                        <select class="form-select status-select mb-2" aria-label="Status" data-task-id="' . $row['id'] . '">
                            <option selected>Status</option>
                            <option value="1" ' . ($row['status'] == '1' ? 'selected' : '') . '>Belum Dikerja</option>
                            <option value="2" ' . ($row['status'] == '2' ? 'selected' : '') . '>Sedang Dikerja</option>
                            <option value="3" ' . ($row['status'] == '3' ? 'selected' : '') . '>Selesai</option>
                        </select>
                        <button type="button" class="btn btn-save p-2 save-status-btn w-100" style="display: none;" data-task-id="' . $row['id'] . '">Simpan</button>
                    </div>
                    <div class="categories-form">
                        <form action="./add_category.php" method="post">
                            <input type="text" class="form-control new-category-input mb-2" placeholder="Masukkan kategori baru" />
                            <button type="button" class="btn btn-save p-2 add-category-btn w-100">Tambah Kategori</button>
                        </form>
                        <select class="form-select categories-select mb-2" aria-label="Kategori" data-task-id="' . $row['id'] . '">
                            <option selected>Pilih Kategori</option>
                            <!-- Kategori akan diisi melalui AJAX -->
                        </select>
                        <button type="button" class="btn btn-save p-2 save-categories-btn w-100" style="display: none;" data-task-id="' . $row['id'] . '">Simpan</button>
                    </div>
                    <div class="deadline-form">
                        <input type="date" class="form-control deadline-select mb-2" aria-label="Tanggal" data-task-id="' . $row['id'] . '">
                        <button type="button" class="btn btn-save p-2 save-deadline-btn w-100" style="display: none;" data-task-id="' . $row['id'] . '">Simpan</button>
                    </div>
                    <div class="priority-form">
                        <select class="form-select priority-select mb-2" aria-label="Prioritas" data-task-id="' . $row['id'] . '">
                            <option selected>Prioritas</option>
                            <option value="1" ' . ($row['priority'] == 1 ? 'selected' : '') . '>Rendah</option>
                            <option value="2" ' . ($row['priority'] == 2 ? 'selected' : '') . '>Sedang</option>
                            <option value="3" ' . ($row['priority'] == 3 ? 'selected' : '') . '>Tinggi</option>
                        </select>
                        <button type="button" class="btn btn-save p-2 save-priority-btn w-100" style="display: none;" data-task-id="' . $row['id'] . '">Simpan</button>
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
