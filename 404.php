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

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

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
            <div class="container py-5 d-flex flex-column justify-content-between">
              <div class="text-center">
                <!-- Error Code -->
                <h1 class="display-1 fw-bold mb-4">404</h1>
                <!-- Error Message -->
                <h2 class="h4 fw-semibold mb-2">Oops! Halaman Tidak Ditemukan</h2>
                <p class="text-muted mb-4">
                  Maaf, halaman yang Anda cari tidak tersedia atau mungkin telah dihapus.
                </p>
                <!-- Back to Home Button -->
                <a
                  href="javascript:history.back()"
                  class="btn btn-secondary text-white btn-sm px-4 py-2"
                >
                  Kembali
                </a>
              </div>
            </div>
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
          <form action="task-process/add_task.php" method="post">
            <div class="modal-body">
              <div class="d-flex flex-column gap-3">
                <label for="nama_tugas">Nama Tugas</label>
                <input type="text" id="nama_tugas" name="task_name" class="rounded p-2">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="simpan_tugas" class="btn btn-save p-2 w-100">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

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
                  <div class="view_task_data">
                  </div>
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
              <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
              <a href="#" id="confirmDeleteButton" class="btn btn-delete p-2">Hapus</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <img src="assets/img/icon/filter-funnel-01.png" alt="" style="width: 24px; margin-right: 8px;">
            <h5 class="modal-title" id="filterModalLabel">Filter Data Tugas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="filterForm" method="GET" action="">
              <!-- Rentang Tanggal -->
              <div class="mb-3">
                <label for="startDate" class="form-label">Rentang Tanggal</label>
                <div class="d-flex gap-2">
                  <input type="date" class="form-control" id="startDate" name="startDate">
                  <span>-</span>
                  <input type="date" class="form-control" id="endDate" name="endDate">
                </div>
              </div>

              <!-- Prioritas -->
              <div class="mb-3">
                <label for="priority" class="form-label">Prioritas</label>
                <select class="form-select" id="priority" name="priority">
                  <option value="">Pilih Prioritas</option>
                  <option value="1">Rendah</option>
                  <option value="2">Sedang</option>
                  <option value="3">Tinggi</option>
                </select>
              </div>

              <!-- Kategori -->
              <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <select class="form-select" id="category" name="category">
                  <option value="">Pilih Kategori</option>
                  <option value="kategori_1">Kategori 1</option>
                  <option value="kategori_2">Kategori 2</option>
                  <option value="kategori_3">Kategori 3</option>
                </select>
              </div>

              <!-- Tombol filter -->
              <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-save">Terapkan Filter</button>
                <button type="button" class="btn btn-secondary" id="resetFilter">Reset Filter</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

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
