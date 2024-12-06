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

  // Ambil ID dari URL jika ada
  $taskDetail = null;
  if (isset($_GET['id'])) {
      $id = intval($_GET['id']); // Sanitasi input
      $result = mysqli_query($koneksi, "SELECT * FROM task WHERE id = '$id' AND user_id = '$id_user'");
      $taskDetail = mysqli_fetch_assoc($result);
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TaskifyMe | Mudahkan Pengelolaan Tugas Anda</title>
    <!-- Bootstrap CDN-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
      rel="stylesheet"
    />

    <!-- Favicon -->
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="assets/img/favicon/apple-touch-icon.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="assets/img/favicon/favicon-32x32.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="assets/img/favicon/favicon-16x16.png"
    />
    <link rel="manifest" href="assets/img/favicon/site.webmanifest" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/tugas-saya.css" />
    <link rel="stylesheet" href="assets/css/header.css" />
    <link rel="stylesheet" href="assets/css/sidebar.css" />
  </head>
  <body>
    <div class="wrapper d-flex">
      <!-- Sidebar -->
      <?php
        include('partials/sidebar.php');
      ?>
      <!-- Content -->
      <section>
        <div class="container">
          <!-- Header -->
          <?php
            include('partials/header.php');
          ?>
          <div class="content">
            <div class="heading-page d-flex flex-row align-items-center justify-content-between">
              <div class="text d-flex flex-row align-items-center gap-2">
                <div class="line"></div>
                <h5 class="mb-0">Tugas Saya</h5>
              </div>
              <div class="w-25 w-lg-auto">
                <div class="position-relative">
                  <div class="position-absolute top-50 start-0 translate-middle-y ps-3 d-flex align-items-center">
                    <svg style="width: 1.2rem; height: 1.2rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                      </path>
                    </svg>
                  </div>
                  <form action="search.php" method="GET">
                    <input type="search" name="search" placeholder="Cari" 
                      class="form-control ps-5 py-2 border rounded w-100 w-lg-50">
                  </form>
                </div>
              </div>
            </div>
            <div class="add-filter d-flex flex-row align-items-center justify-content-between">
              <button type="button" class="btn-add rounded d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#addModal">
                <img src="assets/img/icon/Group 12.png" alt="">
                <span>Tambah</span>
              </button>
              <div class="filter-select d-flex align-items-center gap-2">
                <img src="assets/img/icon/filter-funnel-01.png" alt="">
                <select name="filter" id="filtering" class="px-2 py-1 rounded">
                  <option>Default</option>
                  <option value="nama">Nama Tugas</option>
                  <option value="deadline">Deadline</option>
                  <option value="status">Status</option>
                  <option value="kategori">Kategori</option>
                </select>
              </div>
            </div>
            <hr>
            <table>
              <tr class="head">
                <th scope="col">No</th>
                <th scope="col" style="max-width: 200px;">Nama Tugas</th>
                <th scope="col" style="max-width: 30px;"></th>
                <th scope="col" style="max-width: 200px;">Deskripsi</th>
                <th scope="col">Deadline</th>
                <th scope="col">Kategori</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
              <?php
                $no = 1;
                $sql = mysqli_query($koneksi, "SELECT * FROM task WHERE user_id = '$id_user'");
                  while ($row = mysqli_fetch_assoc($sql)) {
                ?>
              <tr class="data rounded">
                <td scope="col"><?php echo $no++ ?></td>
                <td
                  scope="col"
                  class="text-truncate"
                  style="max-width: 200px"
                >
                  <?php echo $row['task_name'] ?>
                </td>
                <td scope="col" style="max-width: 30px;">
                  <div
                    class="priority d-flex justify-content-center align-items-center"
                    style="
                      width: 24px;
                      height: 24px;
                      background-color:
                      <?php 
                          switch($row['priority']) {
                              case '1':
                                  echo '#e2f1da';
                                  break;
                              case '2':
                                  echo '#FFF3E6';
                                  break;
                              case '3':
                                  echo '#FCF0F2';
                                  break;
                          }
                      ?>;
                      border-radius: 4px;
                    "
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      viewBox="0 0 24 24"
                    >
                      <path
                        fill="none"
                        stroke="
                        <?php 
                            switch($row['priority']) {
                                case '1':
                                    echo '#4aa81b';
                                    break;
                                case '2':
                                    echo '#FF7F00';
                                    break;
                                case '3':
                                    echo '#E55069';
                                    break;
                            }
                        ?>"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 21v-5.313m0 0c5.818-4.55 10.182 4.55 16 0V4.313c-5.818 4.55-10.182-4.55-16 0z"
                      />
                    </svg>
                  </div>
                </td>
                <td
                  scope="col"
                  class="text-truncate"
                  style="max-width: 200px"
                >
                  <?php echo $row['description'] ?>
                </td>
                <td
                  scope="col"
                >
                  <?php echo $row['status'] ?>
                </td>
                <td
                  scope="col"
                >
                  <?php echo $row['categories'] ?>
                </td>
                <td
                  scope="col"
                >
                  <?php echo $row['deadline'] ?>
                </td>
                <td scope="col" class="d-flex gap-2">
                  <a 
                    class="btn btn-detail" 
                    aria-label="View Details" 
                    data-bs-toggle="modal" 
                    data-bs-target="#detailModal" 
                    data-task-name="<?php echo $row['task_name']; ?>" 
                    data-description="<?php echo $row['description']; ?>"
                  >
                    <img src="assets/img/icon/eye.png" alt="View Details" />
                  </a>
                  <a 
                    href="#" 
                    class="btn btn-delete" 
                    data-bs-toggle="modal" 
                    data-bs-target="#deleteModal" 
                    data-task-id="<?php echo $row['id']; ?>"
                  >
                    <img src="assets/img/icon/trash-03.png" alt="Delete Task" />
                  </a>
                </td>
              </tr>
              <?php } ?>
            </table>
          </div>
        </div>
      </section>
    </div>


    <!-- Modal Tambah Tugas-->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="#494A4C" d="M19 19V5H5v14zm0-16a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm-8 4h2v4h4v2h-4v4h-2v-4H7v-2h4z"/>
            </svg>
            <h6 class="modal-title" id="addModalLabel">Tambah Tugas</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="tugas-saya.php" method="post" class="d-flex flex-column gap-3">
              <label for="nama_tugas">Nama Tugas</label>
              <input type="text" id="nama_tugas" name="task_name" class="rounded p-2">
          </div>
          <div class="modal-footer">
            <button type="submit" name="simpan_tugas" class="btn btn-save p-2 w-100">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
      if (isset($_POST['simpan_tugas'])) {
        $task_name = mysqli_real_escape_string($koneksi, $_POST['task_name']); // Hindari SQL Injection
        $sql = "INSERT INTO task (user_id, task_name) VALUES ('$id_user', '$task_name')"; // Pastikan tabel bernama 'tasks' dengan kolom 'user_id' dan 'task_name'
        if ($koneksi->query($sql) === true) {
            header("location:tugas-saya.php"); // Kembali ke halaman tugas
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
        $koneksi->close();
      }
    ob_end_flush();
    ?>

    <!-- Notifikasi Berhasil Update Data -->
    <div id="notification-update" class="notification-update" style="display: none;"></div>

    <!-- Modal Lihat Detail Tugas -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path fill="#494A4C" d="M2 5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3.987A2 2 0 0 1 2 19zm2 4h16V5H4zm4 2H4v8h4zm2 8h10v-8H10z" />
                  </svg>
                  <h6 class="modal-title" id="modal-task-name">
                  </h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body d-flex flex-column gap-4">
                  <div class="description d-flex flex-row align-items-center gap-2">
                      <img src="assets/img/icon/align-left.png" alt="">
                      <h6 class="mb-0">Deskripsi Lengkap</h6>
                  </div>
                  <?php
                  $sql = mysqli_query($koneksi, "SELECT * FROM task WHERE user_id = '$id_user'");
                  while ($row = mysqli_fetch_assoc($sql)) {
                  ?>
                  <div class="d-flex flex-row gap-2">
                      <div class="description-form">
                          <textarea class="form-control description-input" 
                                    name="description" 
                                    placeholder="Masukkan detail deskripsi" 
                                    data-task-id="<?= $row['id']; ?>"><?= htmlspecialchars($row['description']); ?></textarea>
                          <button type="button" class="btn btn-save p-2 save-description-btn" 
                                  name="simpan_tugas" 
                                  style="display: none;" 
                                  data-task-id="<?= $row['id']; ?>">Simpan</button>
                      </div>
                      <div class="menu-container d-flex flex-column gap-2">
                          <select class="form-select" aria-label="Status">
                              <option selected>Status</option>
                              <option value="1" <?= $row['status'] == '1' ? 'selected' : ''; ?>>Belum Dikerja</option>
                              <option value="2" <?= $row['status'] == '2' ? 'selected' : ''; ?>>Sedang Dikerja</option>
                              <option value="3" <?= $row['status'] == '3' ? 'selected' : ''; ?>>Selesai</option>
                          </select>
                          <select class="form-select" aria-label="Kategori">
                              <option selected>Kategori</option>
                              <option value="1" <?= $row['categories'] == 1 ? 'selected' : ''; ?>>Pekerjaan</option>
                              <option value="2" <?= $row['categories'] == 2 ? 'selected' : ''; ?>>Pribadi</option>
                          </select>
                          <input type="date" class="form-control" aria-label="Tanggal" value="<?= $row['deadline']; ?>">
                          <select class="form-select" aria-label="Prioritas">
                              <option selected>Prioritas</option>
                              <option value="1" <?= $row['priority'] == 1 ? 'selected' : ''; ?>>Rendah</option>
                              <option value="2" <?= $row['priority'] == 2 ? 'selected' : ''; ?>>Sedang</option>
                              <option value="3" <?= $row['priority'] == 3 ? 'selected' : ''; ?>>Tinggi</option>
                          </select>
                      </div>
                  </div>
                  <?php } ?>
              </div>
          </div>
      </div>
    </div>

    
    <!-- Modal Konfirmasi Hapus Tugas -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Hapus Tugas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus tugas ini? <br />Tindakan ini tidak dapat dibatalkan.</p>
          </div>
          <div class="modal-footer">
            <div class="d-flex justify-content-between w-100">
              <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-save p-2" name="simpan_tugas">Simpan</button>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <a href="#" id="confirmDeleteButton" class="btn btn-danger">Hapus</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Efek Loading Berhasil Update Data -->
    <div id="loading-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; text-align: center;">
      <div style="position: relative; top: 50%; transform: translateY(-50%);">
          <div class="spinner-border text-light" role="status">
              <span class="visually-hidden">Loading...</span>
          </div>
          <p class="text-light">Memperbarui data...</p>
      </div>
    </div>

    <script>
      // Script untuk Tampilkan Detail Modal
      document.addEventListener('DOMContentLoaded', () => {
        const detailButtons = document.querySelectorAll('.btn-detail');
        const modalTaskName = document.getElementById('modal-task-name');
        const modalDescription = document.getElementById('modal-description');

        detailButtons.forEach(button => {
          button.addEventListener('click', function () {
            const taskName = this.getAttribute('data-task-name');
            const description = this.getAttribute('data-description');

            // Isi modal dengan data dari tombol
            modalTaskName.textContent = taskName;
            modalDescription.textContent = description;
          });
        });
      });

      // Script untuk menampilkan notifikasi
      function showNotification(message) {
        const notification = document.getElementById('notification-update');
        notification.textContent = message;
        notification.style.display = 'block';

        // Sembunyikan notifikasi setelah beberapa detik
        setTimeout(() => {
          notification.style.display = 'none';
        }, 4000); // 4 detik
      }

      // Script Close Modal setelah update
      function closeModal(detailModal) {
        const modal = document.getElementById("detailModal");
        if (modal) {
          modal.style.display = 'none';
          document.body.classList.remove('modal-open');
          document.body.style.overflow = '';
        }
      }

      // Script Update Data Deskripsi Tugas
        document.addEventListener('DOMContentLoaded', () => {
            // Ambil semua textarea dan tombol simpan
            const textareas = document.querySelectorAll('.description-input');
            const saveButtons = document.querySelectorAll('.save-description-btn');

            textareas.forEach(textarea => {
                const saveButton = document.querySelector(`.save-description-btn[data-task-id="${textarea.dataset.taskId}"]`);

                // Tampilkan tombol simpan jika textarea diisi
                textarea.addEventListener('input', () => {
                    if (textarea.value.trim() !== '') {
                        saveButton.style.display = 'inline-block';
                    } else {
                        saveButton.style.display = 'none';
                    }
                });

                // Kirim data ke server untuk memperbarui deskripsi
                saveButton.addEventListener('click', () => {
                    const taskId = textarea.dataset.taskId;
                    const description = textarea.value.trim();
                    if (description === '') return;
                    document.getElementById('loading-overlay').style.display = 'block';
                    
                    // Gunakan fetch untuk mengirim data ke server
                    fetch('task-process/update_task.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ id: taskId, description: description })
                    })
                    .then(response => response.json())
                    .then(data => {
                      document.getElementById('loading-overlay').style.display = 'none';
                      if (data.success) {
                        showNotification('Data berhasil diupdate');
                        saveButton.style.display = 'none';
                        closeModal('taskModal'); // Tutup Modal
                        setTimeout(() => location.reload(), 4000); // Reload Halaman setelah 4 detik (bersamaan dengan notifikasi)
                      } else {
                        showNotification('Gagal memperbarui data');
                      }
                    })
                    .catch(error => console.error('Error:', error));
                    document.getElementById('loading-overlay').style.display = 'none';
                });
            });
        });

      // Script untuk hapus tugas
      const deleteModal = document.getElementById("deleteModal");
      const confirmDeleteButton = document.getElementById("confirmDeleteButton");

      deleteModal.addEventListener("show.bs.modal", (event) => {
        // Ambil tombol yang memicu modal
        const button = event.relatedTarget;

        // Ambil id tugas dari atribut data-task-id
        const taskId = button.getAttribute("data-task-id");

        // Set href di tombol konfirmasi hapus
        confirmDeleteButton.href = `task-process/delete-task.php?id=${taskId}`;
      });
    </script>

    <script src="script.js"></script>
    <!-- Main JS -->
    <script src="assets/js/script.js"></script>

    <!-- Bootstrap CDN-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
