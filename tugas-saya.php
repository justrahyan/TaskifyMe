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
                  <form action="" method="GET">
                    <input type="search" name="search" placeholder="Cari nama tugas" 
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
              if(isset($_SESSION['status-task']) && $_SESSION['status-task'] !=''){
                echo 
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Berhasil! </strong>' .  htmlspecialchars($_SESSION['status-task']) .
                  '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
              }
              unset($_SESSION['status-task']);
              ?>
              <?php
              if (isset($_SESSION['status-delete-task']) && $_SESSION['status-delete-task'] != '') {
                  echo 
                  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Berhasil!</strong> ' . htmlspecialchars($_SESSION['status-delete-task']) . '
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                  unset($_SESSION['status-delete-task']);
              }
              ?>
              <?php
              if (isset($_SESSION['error-task']) && $_SESSION['error-task'] != '') {
                  echo 
                  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Gagal!</strong> ' . htmlspecialchars($_SESSION['error-task']) . '
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                  unset($_SESSION['error-task']);
              }
              ?>
              <?php
                $no = 1;
                // Filtering
                $search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
                $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
                $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
                $priority = isset($_GET['priority']) ? $_GET['priority'] : '';
                $category = isset($_GET['category']) ? $_GET['category'] : '';

                // Pagination
                $tasksPerPage = 10;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $tasksPerPage;
                $no = $offset + 1;

                // Menghitung total tugas
                $totalQuery = "SELECT COUNT(*) AS total FROM task WHERE user_id = '$id_user' AND (status IS NULL OR status != 3)";
                $totalResult = mysqli_query($koneksi, $totalQuery);
                $totalRow = mysqli_fetch_assoc($totalResult);
                $totalTasks = $totalRow['total'];
                $totalPages = ceil($totalTasks / $tasksPerPage);

                // Mulai query dasar
                $query = "SELECT * FROM task WHERE user_id = '$id_user' AND (status IS NULL OR status != 3) LIMIT $offset, $tasksPerPage";

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

                $sql = mysqli_query($koneksi, $query);
                  if(mysqli_num_rows($sql) > 0){
                    while ($row = mysqli_fetch_assoc($sql)) {
                    if($row['status'] == 1){
                      $status = "Belum Dikerja";
                    }elseif($row['status'] == 2){
                        $status = "Sedang Dikerja";
                    } elseif($row['status'] == 3){
                        $status = "Selesai";
                    } else {
                      $status = null;
                    }
              ?>
              <tr class="data rounded">
                <td class="d-none user_id"><?php echo $row['user_id'];?></td>
                <td class="d-none id_task"><?php echo $row['id'];?></td>
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
                  <?php echo $row['categories'] ?>
                </td>
                <td
                  scope="col"
                >
                  <?php echo $row['deadline'] ?>
                </td>
                <td scope="col" class="d-flex gap-2">
                  <a 
                    class="btn btn-detail view-detail" 
                    aria-label="View Details"
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
              <?php 
                }
              } else { 
            ?>
            <tr class="data rounded">
              <td colspan="8" class="text-center">Tidak ada tugas</td>
            </tr>
            <?php } ?>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="#494A4C" d="M16 21.308L6.692 12L16 2.692l1.064 1.064L8.819 12l8.244 8.244z"/></svg>
                            </span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php } ?>
                    <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="#494A4C" d="M15.187 12L7.47 4.285q-.221-.221-.218-.532q.003-.31.224-.532Q7.698 3 8.009 3q.31 0 .532.221l7.636 7.643q.242.242.354.54t.111.596t-.111.596t-.354.54L8.535 20.78q-.222.221-.53.218q-.307-.003-.528-.224t-.221-.532t.221-.531z"/></svg>
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
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

    <script>
      // Konfirmasi Hapus Tugas
      const deleteModal = document.getElementById("deleteModal");
      const confirmDeleteButton = document.getElementById("confirmDeleteButton");

      deleteModal.addEventListener("show.bs.modal", (event) => {
        // Ambil tombol yang memicu modal
        const button = event.relatedTarget;

        // Ambil id tugas dari atribut data-task-id
        const taskId = button.getAttribute("data-task-id");

        // Set href di tombol konfirmasi hapus
        confirmDeleteButton.href = `task-process/delete_task.php?id=${taskId}`;
      });

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

      // Fungsi untuk menampilkan detail tugas pada modal
      $(document).ready(function() {
          $('.view-detail').click(function(e) {
              e.preventDefault();

              // Ambil user_id dan id_task dari elemen terdekat
              var user_id = $(this).closest('tr').find('.user_id').text();
              var id_task = $(this).closest('tr').find('.id_task').text();

              $.ajax({
                  method: "POST",
                  url: "task-process/view_task.php",
                  data: {
                      'click_view_btn': true,
                      'user_id': user_id,
                      'id_task': id_task,
                  },
                  success: function(response) {
                      var taskData = JSON.parse(response);
                      
                      // Periksa apakah data tugas berhasil diambil
                      if (taskData.task_name) {
                          $('#modal-task-name').text(taskData.task_name);
                          $('.view_task_data').html(taskData.details);
                          $('#detailModal').modal('show'); // Tampilkan modal
                      } else {
                          alert("Tugas tidak ditemukan.");
                      }
                  },
                  error: function() {
                      alert("Terjadi kesalahan saat mengambil data tugas.");
                  }
              });
          });
      });

      // Fungsi untuk mengupdate data tugas
      $(document).ready(function () {
          // Event delegation untuk tombol save-description-btn
          $(document).on('input', '.description-input', function () {
              const $textarea = $(this);
              const $saveButton = $(`.save-description-btn[data-task-id="${$textarea.data('task-id')}"]`);
              
              // Sembunyikan tombol lain
              $('.btn-save').not($saveButton).hide();
              $saveButton.toggle($textarea.val().trim() !== '');
          });

          // Fungsi umum untuk update task
          function updateTask(updateData, $saveButton, attribute) {
              $.ajax({
                  url: 'task-process/update_task.php',
                  method: 'POST',
                  contentType: 'application/json',
                  data: JSON.stringify(updateData),
                  success: function (response) {
                      const data = JSON.parse(response);
                      if (data.success) {
                          // Tutup modal
                          $('#taskModal').modal('hide');
                          
                          // Refresh halaman
                          location.reload();
                      } else {
                          alert('Gagal memperbarui data');
                      }
                  },
                  error: function () {
                      alert('Terjadi kesalahan, coba lagi');
                  }
              });
          }

          // Handler untuk update deskripsi
          $(document).on('click', '.save-description-btn', function () {
              const $saveButton = $(this);
              const taskId = $saveButton.data('task-id');
              const description = $(`.description-input[data-task-id="${taskId}"]`).val().trim();

              if (description === '') return;

              updateTask({ 
                  id: taskId, 
                  description: description 
              }, $saveButton, 'description');
          });

          // Fungsi helper untuk event delegation
          function createDynamicUpdateHandler(selector, attribute) {
              $(document).on('change', selector, function () {
                  const $select = $(this);
                  const taskId = $select.data('task-id');
                  const $saveButton = $(`.save-${attribute}-btn[data-task-id="${taskId}"]`);
                  const originalValue = $select.data('original-value') || '';

                  // Sembunyikan tombol simpan lainnya
                  $('.btn-save').not($saveButton).hide();
                  $saveButton.toggle($select.val() !== originalValue);
              });

              $(document).on('click', `.save-${attribute}-btn`, function () {
                  const $saveButton = $(this);
                  const taskId = $saveButton.data('task-id');
                  const updatedValue = $(`.${attribute}-select[data-task-id="${taskId}"]`).val();

                  const updateData = { id: taskId };
                  updateData[attribute] = updatedValue;

                  updateTask(updateData, $saveButton, attribute);
              });
          }

          // Apply dynamic handlers for different attributes
          createDynamicUpdateHandler('.status-select', 'status');
          createDynamicUpdateHandler('.categories-select', 'categories');
          createDynamicUpdateHandler('.deadline-select', 'deadline');
          createDynamicUpdateHandler('.priority-select', 'priority');
      });


      // Tambah Kategori baru
      $(document).ready(function() {
          // Menambahkan kategori baru
          $(document).on('click', '.save-description-btn', function() {
              const newCategory = $(`.new-category-input[data-task-id="${taskId}"]`).val().trim();
              if (newCategory !== "") {
                  var dataToSend = { name: newCategory};
                  console.log("Data yang dikirim:", dataToSend);
                  // Mengirim data kategori ke server menggunakan AJAX
                  $.ajax({
                      url: './category-process/add_category.php',
                      method: 'POST',
                      contentType: 'application/json',
                      data: JSON.stringify({
                        dataToSend,
                      }),
                      success: function(response) {
                          var data = JSON.parse(response);
                          console.log(data); // Tambahkan log untuk melihat hasil respon dari server
                          if (data.success) {
                              var newOption = $('<option></option>').text(newCategory).val(data.id);
                              $('.categories-select').append(newOption);
                              $('.new-category-input').val('');
                          } else {
                              alert(data.message);
                          }
                      },
                      error: function() {
                          alert("Terjadi kesalahan, coba lagi.");
                      }
                  });
              } else {
                  alert('Kategori tidak boleh kosong.');
              }
          });
          // Memuat kategori saat halaman dimuat
          loadCategories();
          function loadCategories() {
              $.ajax({
                  url: './category-process/get_categories.php', // Pastikan URL ini sesuai
                  method: 'GET',
                  success: function(response) {
                      var data = JSON.parse(response);
                      if (data.success && data.categories.length > 0) {
                          $.each(data.categories, function(index, category) {
                              var newOption = $('<option></option>').text(category.name).val(category.id);
                              $('.categories-select').append(newOption);
                          });
                      } else {
                          $('.categories-select').append('<option disabled>Belum ada kategori yang dibuat</option>');
                      }
                  },
                  error: function() {
                      alert("Gagal memuat kategori.");
                  }
              });
          }
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
