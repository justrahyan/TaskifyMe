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
    <link rel="stylesheet" href="assets/css/settings.css" />
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
              <h5 class="mb-0">Pengaturan</h5>
            </div>
            <div class="user-info d-flex flex-column flex-lg-row gap-2">
              <div class="profile p-3 border rounded d-flex flex-row flex-lg-column">
                <img src="assets/img/profil/user.jpeg" alt="User Profile" class="rounded">
                <button class="btn-picture my-2 p-3 rounded">Pilih Foto</button>
                <p>Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG</p>
              </div>
              <div class="information p-3 border rounded">
                <h5 class="self-title">Ubah Biodata Diri</h5>
                <table class="table table-borderless mb-2" style="table-layout: fixed; width: 100%;">
                    <tbody>
                        <tr>
                            <td class="px-0" style="width: 30%;">Nama</td>
                            <td class="px-0" style="width: 70%;">Muhammad Rahyan Noorfauzan</td>
                            <td class="px-0" style="width: 10%;"><a href="#" class="btn-change">Ubah</a></td>
                        </tr>
                        <tr>
                            <td class="px-0" style="width: 30%;">Nama Pengguna</td>
                            <td class="px-0" style="width: 70%;">Rahyan</td>
                            <td class="px-0" style="width: 10%;"><a href="#" class="btn-change">Ubah</a></td>
                        </tr>
                        <tr>
                            <td class="px-0" style="width: 30%;">Tanggal Lahir</td>
                            <td class="px-0" style="width: 70%;">17 Juni 2005</td>
                            <td class="px-0" style="width: 10%;"><a href="#" class="btn-change">Ubah</a></td>
                        </tr>
                        <tr>
                            <td class="px-0" style="width: 30%;">Jenis Kelamin</td>
                            <td class="px-0" style="width: 70%;">Pria</td>
                            <td class="px-0" style="width: 10%;"><a href="#" class="btn-change">Ubah</a></td>
                        </tr>
                    </tbody>
                </table>
                <h5 class="contact-title">Ubah Kontak</h5>
                <table class="table table-borderless mb-2" style="table-layout: fixed; width: 100%;">
                    <tbody>
                        <tr>
                            <td class="px-0" style="width: 30%;">Email</td>
                            <td class="px-0" style="width: 70%;">rahyannn@gmail.com</td>
                            <td class="px-0" style="width: 10%;"><a href="#" class="btn-change">Ubah</a></td>
                        </tr>
                        <tr>
                            <td class="px-0" style="width: 30%;">Nomor HP</td>
                            <td class="px-0" style="width: 70%;">081234567890</td>
                            <td class="px-0" style="width: 10%;"><a href="#" class="btn-change">Ubah</a></td>
                        </tr>
                    </tbody>
                </table>
                <h5 class="secure-title">Ubah Keamanan</h5>
                <table class="table table-borderless" style="table-layout: fixed; width: 100%;">
                    <tbody>
                        <tr>
                            <td class="px-0" style="width: 30%;">Kata Sandi</td>
                            <td class="px-0" style="width: 70%;">*************</td>
                            <td class="px-0" style="width: 10%;"><a href="#" class="btn-change">Ubah</a></td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
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
