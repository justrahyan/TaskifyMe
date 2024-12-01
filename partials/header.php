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
        <div class="notification">
          <img src="assets/img/icon/bell-02.png" alt="Bell" />
        </div>
        <div class="profile">
          <div class="btn-group">
            <button
              type="button"
              class="btn dropdown-toggle d-flex align-items-center gap-2"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <div class="profile-img">
                <img
                  src="assets/img/profil/user.jpeg"
                  alt="Profile"
                  class="rounded-circle"
                />
              </div>
              <span>Halo, Rahyan!</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li
                class="profile-pop d-flex flex-row align-items-center gap-2 border-bottom"
              >
                <div class="icon-dropdown">
                  <img
                    src="assets/img/profil/user.jpeg"
                    alt="Profile"
                    class="rounded-circle"
                  />
                </div>
                <span>Rahyan</span>
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
                  href="login.php"
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