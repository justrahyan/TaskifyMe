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
    <link rel="stylesheet" href="assets/css/form-account.css">
  </head>
  <body>
    <section class="container">
        <div class="d-flex flex-row content p-4">
            <div class="w-50 form-input d-flex flex-column justify-content-center align-items-start">
                <form action="">
                  <h1 class="fw-bold mb-4">Buat Akun anda</h1>
                  <p class="mb-4">Selamat datang! Silahkan buat akun anda terlebih dahulu.</p>
                  <div class="mb-3">
                      <label for="FormControlEmail" class="form-label">Nama Lengkap</label>
                      <input type="text" class="form-control" name="fullname" id="FormControlEmail" placeholder="Masukkan nama lengkap anda">
                  </div>
                  <div class="mb-3">
                      <label for="FormControlEmail" class="form-label">Nama Pengguna</label>
                      <input type="text" class="form-control" name="username" id="FormControlEmail" placeholder="Masukkan nama pengguna anda">
                  </div>
                  <div class="mb-3">
                      <label for="FormControlEmail" class="form-label">Email</label>
                      <input type="email" class="form-control" name="email" id="FormControlEmail" placeholder="Masukkan email anda">
                  </div>
                  <div class="mb-4">
                      <label for="FormControlPassword" class="form-label">Kata Sandi</label>
                      <div class="password-wrapper">
                          <input 
                              type="password" 
                              class="form-control" name="password" 
                              id="FormControlPassword" 
                              placeholder="Masukkan kata sandi anda"
                          >
                          <span class="toggle-password" onclick="togglePasswordVisibility()">
                              <i class="fas fa-eye"></i>
                          </span>
                      </div>
                  </div>
                  <button type="submit" class="btn-submit text-white fw-semibold rounded mb-5">Daftar</button>
                </form>
                <span class="btn-register">Sudah punya akun? <a href="login.php">Masuk disini</a></span>
            </div>
            <div class="w-50 form-image d-flex justify-content-center">
                <img src="assets/img/login-img.png" alt="">
            </div>
        </div>
    </section>
    
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