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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" 
      integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" 
      crossorigin="anonymous" 
      referrerpolicy="no-referrer" 
    />

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
              <h5 class="mb-0">Bantuan</h5>
            </div>
            <div class="tentang-container">
              <div class="top-maps mb-2">
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15893.980585095343!2d119.41228265541992!3d-5.1845558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee3eb35632c19%3A0x48c44082550d1737!2sJurusan%20Teknik%20Informatika%20dan%20Komputer%20FT%20UNM!5e0!3m2!1sid!2sid!4v1704263232884!5m2!1sid!2sid"
                  width="100%" height="350" class="rounded" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
              </div>
              <div class="row mt-4 text-center text-md-start">
                <div class="col-md-6 col-12 mb-3">
                  <div class="fw-bold mb-2">
                    <i class="fa-solid fa-location-dot"></i>
                    Jalan Daeng Tata Raya Parang Tambung, Mannuruki, Kec. Tamalate, Kota Makassar, Sulawesi Selatan 90224
                  </div>
                  <p>Anda dapat mengunjungi alamat kami jika anda mempunyai kesulitan.</p>
                </div>
                <div class="col-md-6 col-12 mb-3">
                  <div class="fw-bold mb-2">
                    <i class="fa-solid fa-phone"></i>
                    (0411)865677
                  </div>
                  <p>Anda dapat menghubungi nomor kami jika anda mempunyai kesulitan.</p>
                </div>
                <div class="col-md-6 col-12 mb-3">
                  <div class="fw-bold mb-2">
                    <i class="fa-solid fa-envelope"></i>
                    taskifyme@mail.me
                  </div>
                  <p>Anda dapat menghubungi kami lewat email jika butuh informasi tentang website kami.</p>
                </div>
                <div class="col-md-6 col-12 mb-3">
                  <div class="fw-bold mb-2">
                    <i class="fa-brands fa-instagram"></i>
                    @taskify.me
                  </div>
                  <p>Anda dapat mengikuti kami di Instagram agar tidak kehilangan informasi terbaru tentang TaskifyMe.</p>
                </div>
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
