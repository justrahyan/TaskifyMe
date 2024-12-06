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
                  <form action="search.php" method="GET">
                    <input type="search" name="search" placeholder="Cari" 
                      class="form-control ps-5 py-2 border rounded w-100 w-lg-50">
                  </form>
                </div>
              </div>
            </div>
            <div class="add-filter">
              
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
              <tr class="data rounded">
                <td scope="col">1</td>
                <td
                  scope="col"
                  class="text-truncate"
                  style="max-width: 200px"
                >
                  Matematika Diskrit
                </td>
                <td scope="col" style="max-width: 30px;">
                  <div
                    class="priority d-flex justify-content-center align-items-center"
                    style="
                      width: 24px;
                      height: 24px;
                      background-color: #e2f1da;
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
                        stroke="#4aa81b"
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
                  Deskripsinya adalah Lorem ipsum dolor sit amet,
                  consectetur adipisicing elit. Soluta, est.
                </td>
                <td
                  scope="col"
                >
                  13-12-2024
                </td>
                <td
                  scope="col"
                >
                  Kuliah
                </td>
                <td
                  scope="col"
                >
                  Sedang Dikerja
                </td>
                <td scope="col">
                  <button
                    class="btn btn-print"
                    aria-label="View Details"
                  >
                    <img
                      src="assets/img/icon/printer.png"
                      alt="Print"
                    />
                  </button>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </section>
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
