<?php
  session_start();
  if (isset($_SESSION['userweb'])) {
      include './koneksi.php';

      // Ambil id_user dari session
      $id_user = $_SESSION['id_user'];
  } else {
      echo "<script>alert('Anda harus login terlebih dahulu!')</script>";
      header("location:login.php");
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
    <link rel="stylesheet" href="assets/css/riwayat-tugas.css" />
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
                <h5 class="mb-0">Riwayat Tugas</h5>
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
                  <form action="" method="GET">
                    <input type="search" name="search" placeholder="Cari nama tugas" 
                      class="form-control ps-5 py-2 border rounded w-100 w-lg-50">
                  </form>
                </div>
              </div>
            </div>
            <div class="add-filter d-flex flex-row align-items-center justify-content-end">
              <div class="filter-select d-flex align-items-center gap-2">
                <!-- Tombol Filter -->
                <button type="button" class="btn border border-secondary d-flex gap-2 align-items-center" data-bs-toggle="modal" data-bs-target="#filterModal">
                  <img src="assets/img/icon/filter-funnel-01.png" alt="">
                  <span>Filter Data</span>
                </button>
              </div>
            </div>
            <hr>
            <table>
              <tr class="head">
                <th scope="col">No</th>
                <th scope="col" style="max-width: 200px;">Nama Tugas</th>
                <th scope="col" style="max-width: 30px;"></th>
                <th scope="col" style="max-width: 200px;">Deskripsi</th>
                <th scope="col">Status</th>
                <th scope="col">Kategori</th>
                <th scope="col">Deadline</th>
                <th scope="col">Aksi</th>
              </tr>
              <?php
                $no = 1;
                $search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

                $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
                $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
                $priority = isset($_GET['priority']) ? $_GET['priority'] : '';
                $category = isset($_GET['category']) ? $_GET['category'] : '';

                // Mulai query dasar
                $query = "SELECT t.*, c.name 
                FROM task t
                LEFT JOIN categories c ON t.categories = c.id
                WHERE t.user_id = '$id_user' 
                AND t.status = 3";

                // Menambahkan filter berdasarkan rentang tanggal
                if (!empty($startDate) && !empty($endDate)) {
                    $query .= " AND deadline BETWEEN '$startDate' AND '$endDate'";
                }

                // Menambahkan filter berdasarkan prioritas
                if (!empty($priority)) {
                    $query .= " AND priority = '$priority'";
                }

                // Menambahkan filter berdasarkan kategori
                if (!empty($category)) {
                    $query .= " AND categories = '$category'";
                }

                // Menambahkan pencarian berdasarkan nama tugas
                if (!empty($search)) {
                    $query .= " AND task_name LIKE '%$search%'";
                }

                // Eksekusi query
                $sql = mysqli_query($koneksi, $query);
                while ($row = mysqli_fetch_assoc($sql)) {
                    if ($row['status'] == 1) {
                        $status = "Belum Dikerja";
                    } elseif ($row['status'] == 2) {
                        $status = "Sedang Dikerja";
                    } elseif ($row['status'] == 3) {
                        $status = "Selesai";
                    } else {
                        $status = null;
                    }
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
                  <?php echo $status ?>
                </td>
                <td
                  scope="col"
                >
                  <?php echo $row['name'] ?>
                </td>
                <td
                  scope="col"
                >
                  <?php echo $row['deadline'] ?>
                </td>
                <td scope="col" class="d-flex gap-2">
                  <a href="task-process/print_task.php?task_id=<?php echo $row['id']; ?>"
                    class="btn btn-print"
                  >
                    <img src="assets/img/icon/printer.png" alt="Print Task" />
                  </a>
                </td>
              </tr>
              <?php } ?>
            </table>
          </div>
        </div>
      </section>
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
                  <?php
                  // Query kategori
                  $kategori_query = mysqli_query($koneksi, "SELECT id, name FROM categories WHERE user_id = '$id_user'");
                  while($kategori_row = mysqli_fetch_assoc($kategori_query)){
                  ?>
                  <option value="<?php echo $kategori_row['id']; ?>"><?php echo $kategori_row['name']; ?></option>
                  <?php } ?>
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

    <script>
      // Fungsi untuk mereset filter
      document.getElementById('resetFilter').addEventListener('click', function() {
          // Bersihkan nilai dari input filter
          document.getElementById('startDate').value = '';
          document.getElementById('endDate').value = '';
          document.getElementById('priority').value = '';
          document.getElementById('category').value = '';

          // Segarkan halaman untuk menghapus filter
          window.location.href = window.location.pathname;
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
