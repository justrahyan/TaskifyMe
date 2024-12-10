<?php
session_start();
include './koneksi.php';

// Inisialisasi variabel error
$errors = [];

// Cek apakah form login disubmit
if (isset($_POST['login'])) {
    // Ambil dan bersihkan input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi username
    if (empty($username)) {
        $errors['username'] = 'Nama pengguna tidak boleh kosong';
    }

    // Validasi password
    if (empty($password)) {
        $errors['password'] = 'Kata sandi tidak boleh kosong';
    }

    // Jika tidak ada error, lakukan proses login
    if (empty($errors)) {
      // Query langsung tanpa prepared statement
      $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
      $result = mysqli_query($koneksi, $query);
  
      if ($result && mysqli_num_rows($result) > 0) {
          // Login berhasil
          $user = mysqli_fetch_assoc($result);
          $_SESSION['userweb'] = $username;
          $_SESSION['id_user'] = $user['id'];

          // Set session untuk pesan selamat datang
          $_SESSION['welcome_message'] = "Selamat datang, " . htmlspecialchars($username) . "! Anda berhasil login.";
          echo $_SESSION['welcome_message'];
          header("location:./index.php");
          exit();
      } else {
          // Login gagal
          $errors['login'] = 'Username atau password salah';
      }
    }  
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
    <link rel="stylesheet" href="assets/css/form-account.css">
    <style>
      .error-message {
        color: red;
        font-size: 0.875rem;
        margin-top: 0.25rem;
      }
    </style>
  </head>
  <body>
    <section class="container">
        <div class="d-flex flex-row content p-4">
            <div class="w-50 form-input d-flex flex-column justify-content-center align-items-start">
                <form action="" method="post">
                    <h1 class="fw-bold mb-4">Login ke Akun anda</h1>
                    <p class="mb-4">Selamat datang! Silahkan login terlebih dahulu.</p>
                    
                    <?php if (isset($errors['login'])): ?>
                        <div class="alert alert-danger mb-3"><?php echo $errors['login']; ?></div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="FormControlUsername" class="form-label">Nama Pengguna <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" 
                            name="username" 
                            id="FormControlUsername" 
                            placeholder="Masukkan nama pengguna anda" 
                            value="<?php echo htmlspecialchars($username ?? ''); ?>"
                        >
                        <?php if (isset($errors['username'])): ?>
                            <div class="error-message"><?php echo $errors['username']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-4">
                        <label for="FormControlPassword" class="form-label">Kata Sandi <span class="text-danger">*</span></label>
                        <div class="password-wrapper">
                            <input 
                                type="password" 
                                class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" 
                                name="password" 
                                id="FormControlPassword" 
                                placeholder="Masukkan kata sandi anda"
                            >
                            <span class="toggle-password" onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <?php if (isset($errors['password'])): ?>
                            <div class="error-message"><?php echo $errors['password']; ?></div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" name="login" class="btn-submit text-white fw-semibold rounded mb-5">Login</button>
                </form>
                <span class="btn-register">Belum punya akun? <a href="register.php">Daftar disini</a></span>
            </div>
            <div class="w-50 form-image d-flex justify-content-center">
                <img src="assets/img/login-img.png" alt="">
            </div>
        </div>
    </section>

    <!-- Main JS -->
    <script src="assets/js/script.js"></script>

    <script>
    // Password Toggle Login and Register
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById("FormControlPassword");
      const toggleIcon = document.querySelector(".toggle-password i");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
      }
    }
    </script>

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