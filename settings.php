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
              <h5 class="mb-0">Pengaturan</h5>
            </div>
            <?php
              if(isset($_SESSION['success-update']) && $_SESSION['success-update'] !=''){
                echo 
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Berhasil! </strong>' .  htmlspecialchars($_SESSION['success-update']) .
                  '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
              }
              unset($_SESSION['success-update']);
            ?>
            <?php
              if (isset($_SESSION['error-update']) && $_SESSION['error-update'] != '') {
                  echo 
                  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Gagal!</strong> ' . htmlspecialchars($_SESSION['error-update']) . '
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                  unset($_SESSION['error-update']);
              }
            ?>
            <div class="user-info d-flex flex-column flex-lg-row gap-2">
              <?php
              // Ambil data user berdasarkan ID user
              $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id_user'");
              $row = mysqli_fetch_assoc($sql);
              if ($row) {
                  // Tentukan gender untuk ditampilkan
                  if ($row['gender'] == "Male") {
                      $gender = "Pria";
                  } elseif ($row['gender'] == "Female") {
                      $gender = "Wanita";
                  } else {
                      $gender = "Belum diatur";
                  }
              }
              ?>
              <div class="profile p-3 border rounded d-flex flex-row flex-lg-column gap-2">
                  <div class="image-container rounded">
                      <img src="assets/img/profil/<?php echo $row['picture'] ? $row['picture'] : 'user.jpeg'; ?>" alt="<?php echo $row['username']; ?> Profile" class="img-profile rounded">
                  </div>
                  <form id="upload-picture-form" enctype="multipart/form-data">
                      <button type="button" class="btn btn-secondary mb-2 p-3 rounded w-100" onclick="document.getElementById('file-input').click();">Pilih Foto</button>
                      <input type="file" id="file-input" name="profile_picture" accept=".jpg,.jpeg,.png" style="display:none;" onchange="previewImage(event)">
                      <p>Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG</p>
                      <button type="submit" class="btn btn-picture p-2 w-100">Simpan</button>
                  </form>
              </div>
              <div class="information p-3 border rounded">
                <h5 class="self-title fw-bold">Ubah Biodata Diri</h5>
                <table class="table table-borderless mb-3" style="table-layout: fixed; width: 100%;">
                    <tbody>
                        <tr>
                            <td class="px-0" style="width: 30%;">Nama</td>
                            <td class="px-0" style="width: 70%;"><?php echo $row['fullname'];?></td>
                            <td class="px-0" style="width: 10%;"></td>
                        </tr>
                        <tr>
                            <td class="px-0" style="width: 30%;">Nama Pengguna</td>
                            <td class="px-0" style="width: 70%;"><?php echo ucfirst($row['username']);?></td>
                            <td class="px-0" style="width: 10%;"><a href="#" class="btn-change" data-bs-toggle="modal" data-bs-target="#editModal">Ubah</a></td>
                        </tr>
                        <tr>
                            <td class="px-0" style="width: 30%;">Tanggal Lahir</td>
                            <td class="px-0" style="width: 70%;"><?php echo $row['birthdate'] ? $row['birthdate'] : "Belum diatur"; ?></td>
                            <td class="px-0" style="width: 10%;"><a href="#" class="btn-change" data-bs-toggle="modal" data-bs-target="#editBirthdateModal">Ubah</a></td>
                        </tr>
                        <tr>
                            <td class="px-0" style="width: 30%;">Jenis Kelamin</td>
                            <td class="px-0" style="width: 70%;"><?php echo $gender ?></td>
                            <td class="px-0" style="width: 10%;"><a href="#" class="btn-change" data-bs-toggle="modal" data-bs-target="#editGenderModal">Ubah</a></td>
                        </tr>
                    </tbody>
                </table>
                <h5 class="contact-title fw-bold">Ubah Kontak</h5>
                <table class="table table-borderless mb-3" style="table-layout: fixed; width: 100%;">
                    <tbody>
                        <tr>
                            <td class="px-0" style="width: 30%;">Email</td>
                            <td class="px-0" style="width: 70%;"><?php echo $row['email']; ?></td>
                            <td class="px-0" style="width: 10%;"><a href="#" class="btn-change" data-bs-toggle="modal" data-bs-target="#editEmailModal">Ubah</a></td>
                        </tr>
                        <tr>
                            <td class="px-0" style="width: 30%;">Nomor HP</td>
                            <td class="px-0" style="width: 70%;"><?php echo $row['phone'] ? $row['phone'] : "Belum diatur"; ?></td>
                            <td class="px-0" style="width: 10%;"><a href="#" class="btn-change" data-bs-toggle="modal" data-bs-target="#editPhoneModal">Ubah</a></td>
                        </tr>
                    </tbody>
                </table>
                <h5 class="secure-title fw-bold">Ubah Keamanan</h5>
                <table class="table table-borderless" style="table-layout: fixed; width: 100%;">
                    <tbody>
                        <tr>
                            <td class="px-0" style="width: 30%;">Kata Sandi</td>
                            <td class="px-0" style="width: 70%;"><?php echo str_repeat('*', strlen($row['password'])); ?></td>
                            <td class="px-0" style="width: 10%;"><a href="#" class="btn-change" data-bs-toggle="modal" data-bs-target="#editPasswordModal">Ubah</a></td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Modal untuk Mengubah Username-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header gap-2">
                    <h5 class="modal-title" id="editModalLabel">Ubah Nama Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-username-form">
                        <div class="mb-3">
                            <label for="username-input" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control" id="username-input" name="username" value="<?php echo $row['username']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-save p-2 w-100" id="save-btn" style="display:none;">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Mengubah Tanggal Lahir -->
    <div class="modal fade" id="editBirthdateModal" tabindex="-1" aria-labelledby="editBirthdateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBirthdateModalLabel">Ubah Tanggal Lahir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-birthdate-form">
                        <div class="mb-3">
                            <label for="birthdate-input" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="birthdate-input" name="birthdate" value="<?php echo $row['birthdate']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-save p-2 w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Mengubah Jenis Kelamin -->
    <div class="modal fade" id="editGenderModal" tabindex="-1" aria-labelledby="editGenderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGenderModalLabel">Ubah Jenis Kelamin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-gender-form">
                        <div class="mb-3 d-flex justify-content-center">
                            <label for="gender-pria" class="d-flex align-items-center me-4">
                                <input type="radio" id="gender-pria" name="gender" value="Male" class="form-check-input" required>
                                <img src="assets/img/icon/male.png" alt="Pria" class="me-2" style="width: 50px; height: 50px;"> Pria
                            </label>
                            <label for="gender-wanita" class="d-flex align-items-center">
                                <input type="radio" id="gender-wanita" name="gender" value="Female" class="form-check-input" required>
                                <img src="assets/img/icon/female.png" alt="Wanita" class="me-2" style="width: 50px; height: 50px;"> Wanita
                            </label>
                        </div>
                        <button type="submit" class="btn btn-save p-2 w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Mengubah Email -->
    <div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmailModalLabel">Ubah Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-email-form">
                        <div class="mb-3">
                            <label for="email-input" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email-input" name="email" value="<?php echo $row['email']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-save p-2 w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Mengubah Nomor HP -->
    <div class="modal fade" id="editPhoneModal" tabindex="-1" aria-labelledby="editPhoneModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPhoneModalLabel">Ubah Nomor HP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-phone-form">
                        <div class="mb-3">
                            <label for="phone-input" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="phone-input" name="phone" value="<?php echo $row['phone']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-save p-2 w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Mengubah Kata Sandi -->
    <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPasswordModalLabel">Ubah Kata Sandi</h5>
                    <button type="button" class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class="modal-body">
                    <?php
                      // Error message
                      if (isset($_SESSION['error-password']) && $_SESSION['error-password'] != '') {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal!</strong> ' . htmlspecialchars($_SESSION['error-password']) . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                        unset($_SESSION['error-password']);
                      }
                    ?>
                    <form id="edit-password-form" method="POST" action="update-password.php">
                        <div class="mb-3">
                            <label for="old-password" class="form-label">Masukkan Password Lama</label>
                            <input type="password" class="form-control" id="old-password" name="old_password" required />
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="new-password" class="form-label">Masukkan Password Baru</label>
                            <input type="password" class="form-control" id="new-password" name="new_password" required />
                            <span class="toggle-password" id="toggle-password">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm_password" required />
                        </div>
                        <button type="submit" class="btn btn-save p-2 w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Fungsi Modal Edit Profil -->
    <script>
      $(document).ready(function () {
        $('.btn-change').click(function (e) {
            e.preventDefault();
            // Ambil username yang ingin diubah
            var username = $(this).closest('tr').find('td:eq(1)').text().trim();
            // Isi input field dengan username yang diambil
            $('#username-input').val(username);
            // Reset tombol simpan untuk menunjukkan perubahan
            $('#save-btn').hide(); // Tombol simpan disembunyikan saat modal pertama kali dibuka
        });
        // Tangani perubahan pada input username
        $('#username-input').on('input', function () {
            var usernameValue = $(this).val().trim();
            // Tampilkan tombol simpan jika ada perubahan pada input
            if (usernameValue !== "") {
                $('#save-btn').show();
            } else {
                $('#save-btn').hide();
            }
        });
        // Tangani pengiriman form untuk menyimpan perubahan
        $('#edit-username-form').submit(function (e) {
            e.preventDefault();
            var newUsername = $('#username-input').val().trim();
            // Kirim data username baru menggunakan AJAX
            $.ajax({
                method: "POST",
                url: "profile-process/update-profile.php", // URL untuk update username
                contentType: "application/json",
                data: JSON.stringify({ username: newUsername }),
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        $('#editModal').modal('hide'); // Menutup modal setelah pembaruan
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan saat mengubah nama pengguna: ' + data.message);
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan pada server.');
                }
            });
        });
        // Event listener untuk mengubah tanggal lahir
        $('#edit-birthdate-form').submit(function (e) {
            e.preventDefault();
            var newBirthdate = $('#birthdate-input').val();
            $.ajax({
                method: "POST",
                url: "profile-process/update-profile.php", // URL untuk update
                contentType: "application/json",
                data: JSON.stringify({ birthdate: newBirthdate }),
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        location.reload(); // Refresh halaman setelah pembaruan
                    } else {
                        alert('Terjadi kesalahan saat mengubah tanggal lahir: ' + data.message);
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan pada server.');
                }
            });
        });
        // Event listener untuk mengubah jenis kelamin
        $('#edit-gender-form').submit(function (e) {
            e.preventDefault();

            // Ambil nilai gender yang dipilih
            var gender = $('input[name="gender"]:checked').val();

            // Kirim data ke server
            $.ajax({
                method: "POST",
                url: "profile-process/update-profile.php",
                contentType: "application/json",
                data: JSON.stringify({ gender: gender }),
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        location.reload();  // Reload halaman jika berhasil
                    } else {
                        alert('Terjadi kesalahan saat mengubah jenis kelamin: ' + data.message);
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan pada server.');
                }
            });
        });
        // Event listener untuk mengubah email
        $('#edit-email-form').submit(function (e) {
            e.preventDefault();
            var newEmail = $('#email-input').val();
            $.ajax({
                method: "POST",
                url: "profile-process/update-profile.php",
                contentType: "application/json",
                data: JSON.stringify({ email: newEmail }),
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan saat mengubah email: ' + data.message);
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan pada server.');
                }
            });
        });
        // Event listener untuk mengubah nomor HP
        $('#edit-phone-form').submit(function (e) {
            e.preventDefault();
            var newPhone = $('#phone-input').val();
            $.ajax({
                method: "POST",
                url: "profile-process/update-profile.php",
                contentType: "application/json",
                data: JSON.stringify({ phone: newPhone }),
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan saat mengubah nomor HP: ' + data.message);
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan pada server.');
                }
            });
        });
        // Event listener untuk mengubah kata sandi
        $('#edit-password-form').submit(function (e) {
            e.preventDefault();
            // Get the values for the old password, new password, and confirmation password
            var oldPassword = $('#old-password').val();
            var newPassword = $('#new-password').val();
            var confirmPassword = $('#confirm-password').val();
            // Send data to the server
            $.ajax({
                method: "POST",
                url: "profile-process/update-profile.php",
                contentType: "application/json",
                data: JSON.stringify({
                    old_password: oldPassword,
                    password: newPassword,
                    confirm_password: confirmPassword
                }),
                success: function (response) {
                    const data = JSON.parse(response);
                    console.log(data);
                    if (data.success) {
                        // Reload the page or show a success message
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan saat mengubah kata sandi: ' + data.message);
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan pada server.');
                }
            });
        });
      });

      // Update Gambar
      function previewImage(event) {
          var reader = new FileReader();
          reader.onload = function() {
              var output = document.querySelector('.img-profile');
              output.src = reader.result;
          };
          reader.readAsDataURL(event.target.files[0]);
      }

      $('#upload-picture-form').submit(function (e) {
          e.preventDefault();

          var formData = new FormData(this);

          $.ajax({
              method: "POST",
              url: "profile-process/update-profile-picture.php",
              data: formData,
              processData: false,
              contentType: false,
              success: function (response) {
                  const data = JSON.parse(response);
                  if (data.success) {
                      location.reload();
                  } else {
                      alert('Terjadi kesalahan saat mengupdate foto profil: ' + data.message);
                  }
              },
              error: function (xhr, status, error) {
                  console.log(xhr.responseText);
                  alert('Terjadi kesalahan pada server.');
              }
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
