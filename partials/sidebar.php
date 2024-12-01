<aside id="sidebar">
    <div class="container">
      <!-- Sidebar Logo -->
      <a
        href="index.php"
        class="logo d-flex flex-row align-items-center justify-content-left gap-2"
      >
        <img src="assets/img/icon/check-done-02.png" alt="" />
        <h4 class="mb-0 fw-semibold">TaskifyMe</h4>
      </a>
      
      <!-- Sidebar Menu -->
      <ul class="d-flex flex-column gap-4">
        <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
        <li>
          <a
            href="index.php"
            class="d-flex flex-row align-items-center gap-3 <?= $current_page == 'index.php' ? 'active' : '' ?>"
          >
            <div class="icon-side">
              <img src="assets/img/icon/home-line.png" alt="" />
            </div>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a
            href="tugas-saya.php"
            class="d-flex flex-row align-items-center gap-3 <?= $current_page == 'tugas-saya.php' ? 'active' : '' ?>"
          >
            <div class="icon-side">
              <img src="assets/img/icon/file-06.png" alt="" />
            </div>
            <span>Tugas Saya</span>
          </a>
        </li>
        <li>
          <a
            href="kalender.php"
            class="d-flex flex-row align-items-center gap-3 <?= $current_page == 'kalender.php' ? 'active' : '' ?>"
          >
            <div class="icon-side">
              <img src="assets/img/icon/calendar-date.png" alt="" />
            </div>
            <span>Kalender</span>
          </a>
        </li>
        <li>
          <a
            href="riwayat-tugas.php"
            class="d-flex flex-row align-items-center gap-3 <?= $current_page == 'riwayat-tugas.php' ? 'active' : '' ?>"
          >
            <div class="icon-side">
              <img src="assets/img/icon/clock-rewind.png" alt="" />
            </div>
            <span>Riwayat Tugas</span>
          </a>
        </li>
      </ul>
    </div>
</aside>