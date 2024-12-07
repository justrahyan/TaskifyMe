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

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />
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
            <div class="heading-page d-flex flex-row align-items-center gap-2">
              <div class="line"></div>
              <h5 class="mb-0">Dashboard</h5>
            </div>
            <div class="dashboard-task row">
              <div class="new-task col">
                <div class="">
                  <h6>Baru Ditambahkan</h6>
                  <hr />
                  <table>
                    <tr class="head">
                      <th scope="col">No</th>
                      <th scope="col">Nama Tugas</th>
                      <th scope="col">Deskripsi</th>
                      <th scope="col">Aksi</th>
                    </tr>
                    <?php
                      $no = 1;
                      $sql = mysqli_query($koneksi, "SELECT * FROM task WHERE user_id = '$id_user' ORDER BY id desc LIMIT 5");
                      while ($row = mysqli_fetch_assoc($sql)) {
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
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        <?php echo $row['description'] ?>
                      </td>
                      <td scope="col">
                        <a 
                          class="btn btn-detail view-detail" 
                          aria-label="View Details"
                        >
                          <img src="assets/img/icon/eye.png" alt="View Details" />
                        </a>
                      </td>
                    </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
              <div class="due-task col">
                <div class="">
                  <h6>Mendekati Deadline</h6>
                  <hr />
                  <table>
                    <tr class="head">
                      <th scope="col">No</th>
                      <th scope="col">Nama Tugas</th>
                      <th scope="col">Deskripsi</th>
                      <th scope="col">Aksi</th>
                    </tr>
                    <?php
                      $no = 1;
                      $sql = mysqli_query($koneksi, "SELECT * FROM task WHERE user_id = '$id_user' AND deadline <= DATE_ADD(CURDATE(), INTERVAL 5 DAY) ORDER BY id desc LIMIT 5");
                      while ($row = mysqli_fetch_assoc($sql)) {
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
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        <?php echo $row['description'] ?>
                      </td>
                      <td scope="col">
                        <a 
                          class="btn btn-detail view-detail" 
                          aria-label="View Details"
                        >
                          <img src="assets/img/icon/eye.png" alt="View Details" />
                        </a>
                      </td>
                    </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
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

    <script>
      // Fungsi untuk menampilkan detail tugas pada modal
      $(document).ready(function() {
          $('.view-detail').click(function(e) {
              e.preventDefault();

              // Ambil user_id dan id_task dari elemen terdekat
              var user_id = $(this).closest('tr').find('.user_id').text();
              var id_task = $(this).closest('tr').find('.id_task').text();

              $.ajax({
                  method: "POST",
                  url: "task-process/index_task.php",
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
    </script>
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
