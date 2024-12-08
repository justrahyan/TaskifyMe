<?php
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }

  // Koneksi
  $koneksi = mysqli_connect('localhost', 'root', '', 'taskifyme');

  // Jika database error
  if (!$koneksi) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id_user'");
  $row = mysqli_fetch_assoc($sql);

  $queryNotifikasi = mysqli_query($koneksi, "SELECT count(*) AS total FROM task WHERE user_id = '$id_user' AND deadline <= DATE_ADD(CURDATE(), INTERVAL 5 DAY) AND (status IS NULL OR status != 3) ORDER BY id desc");
  $jmlNotifikasi = mysqli_fetch_assoc($queryNotifikasi);
?>

<header>
    <div
      class="container d-flex align-items-center justify-content-between"
    >
      <!-- Hamburger -->
      <div class="left">
        <button id="hamburger" class="d-lg-none">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32">
            <path fill="none" stroke="#494A4C" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h22M5 16h22M5 24h22"/>
          </svg>
        </button>
      </div>
      <div class="right d-flex align-items-center gap-1">
        <a class="notification position-relative view-notification">
            <img src="assets/img/icon/bell-02.png" alt="Bell" data-bs-toggle="modal" data-bs-target="#notificationModal" />
            <span id="notification-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <!-- Jumlah Notifikasi -->
                 <?php echo $jmlNotifikasi['total'] ?>
            </span>
        </a>
        <div class="profile">
          <div class="btn-group">
            <button
              type="button"
              class="btn dropdown-toggle d-flex align-items-center gap-2"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <div class="profile-img">
                <div class="images rounded-circle">
                    <img src="assets/img/profil/<?php echo $row['picture'] ? $row['picture'] : 'user.jpeg'; ?>" alt="<?php echo $row['username']; ?> Profile">
                </div>
              </div>
              <span>Halo, <?php echo ucfirst($row['username']); ?>!</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li
                class="profile-pop d-flex flex-row align-items-center gap-2 border-bottom"
              >
                <div class="image-dropdown">
                  <div class="images rounded-circle">
                      <img src="assets/img/profil/<?php echo $row['picture'] ? $row['picture'] : 'user.jpeg'; ?>" alt="<?php echo $row['username']; ?> Profile">
                  </div>
                </div>
                <span><?php echo ucfirst($row['username']); ?></span>
              </li>
              <li>
                <a
                  href="settings.php"
                  class="d-flex flex-row align-items-center profile-menu"
                  ><div class="icon-dropdown">
                    <img src="assets/img/icon/settings-02.png" alt="" />
                  </div>
                  Pengaturan</a
                >
              </li>
              <li>
                <a
                  href="help.php"
                  class="d-flex flex-row align-items-center profile-menu"
                  ><div class="icon-dropdown">
                    <img src="assets/img/icon/help-circle.png" alt="" />
                  </div>
                  Bantuan</a
                >
              </li>
              <li>
                <a
                  href="faqs.php"
                  class="d-flex flex-row align-items-center profile-menu"
                  ><div class="icon-dropdown">
                    <img
                      src="assets/img/icon/annotation-question.png"
                      alt=""
                    />
                  </div>
                  FAQs</a
                >
              </li>
              <li class="mt-5">
                <a
                  href="logout.php"
                  class="d-flex flex-row align-items-center profile-menu"
                  ><div class="icon-dropdown">
                    <img src="assets/img/icon/log-out-03.png" alt="" />
                  </div>
                  Keluar</a
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
</header>

<!-- Modal notifikasi  -->
<!-- <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Tugas Mendekati Deadline</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="notification-list" class="list-group">
                    Daftar tugas akan dimuat di sini
                    <div class="view_task_data">
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Daftar Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Daftar Tugas akan dimuat di sini -->
                <ul id="task-list" class="list-group">
                    
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    // Tunggu DOM sepenuhnya dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Cek apakah modal ada
    var notificationModal = document.getElementById('notificationModal');
    
    if (notificationModal) {
        // Gunakan event listener Bootstrap
        notificationModal.addEventListener('show.bs.modal', function (e) {
            $.ajax({
                url: 'notification.php',  // Sesuaikan path
                type: 'GET',
                dataType: 'json',
                success: function(tasks) {
                    let taskList = $('#task-list');
                    taskList.empty();

                    // Debug: Cetak tasks di konsol
                    console.log('Tasks received:', tasks);

                    if (tasks.error) {
                        taskList.append(`<li class="list-group-item text-danger">${tasks.error}</li>`);
                        return;
                    }

                    if (tasks.length === 0) {
                        taskList.append('<li class="list-group-item">Tidak ada tugas.</li>');
                    } else {
                        tasks.forEach(function(task) {
                            taskList.append(`
                                <li class="list-group-item">
                                    <strong>${task.task_name || 'Tugas Tanpa Judul'}</strong>
                                    <p>${task.description || 'Tidak ada deskripsi'}</p>
                                    <small>Tenggat: ${task.deadline || 'Tidak ada tanggal'}</small>
                                </li>
                            `);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error details:', {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        responseText: xhr.responseText
                    });
                    $('#task-list').html(`
                        <li class="list-group-item text-danger">
                            Gagal memuat tugas. Silakan coba lagi.
                        </li>
                    `);
                }
            });
        });
    } else {
        console.error('Modal not found');
    }
});
</script>