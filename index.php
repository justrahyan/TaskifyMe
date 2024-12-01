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
                    <tr class="data rounded">
                      <td scope="col">1</td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Design System UI/UX
                      </td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Deskripsinya adalah Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit. Soluta, est.
                      </td>
                      <td scope="col">
                        <button
                          class="btn btn-detail"
                          aria-label="View Details"
                        >
                          <img
                            src="assets/img/icon/eye.png"
                            alt="View Details"
                          />
                        </button>
                      </td>
                    </tr>
                    <tr class="data rounded">
                      <td scope="col">1</td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Design System UI/UX
                      </td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Deskripsinya adalah Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit. Soluta, est.
                      </td>
                      <td scope="col">
                        <button
                          class="btn btn-detail"
                          aria-label="View Details"
                        >
                          <img
                            src="assets/img/icon/eye.png"
                            alt="View Details"
                          />
                        </button>
                      </td>
                    </tr>
                    <tr class="data rounded">
                      <td scope="col">1</td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Design System UI/UX
                      </td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Deskripsinya adalah Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit. Soluta, est.
                      </td>
                      <td scope="col">
                        <button
                          class="btn btn-detail"
                          aria-label="View Details"
                        >
                          <img
                            src="assets/img/icon/eye.png"
                            alt="View Details"
                          />
                        </button>
                      </td>
                    </tr>
                    <tr class="data rounded">
                      <td scope="col">1</td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Design System UI/UX
                      </td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Deskripsinya adalah Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit. Soluta, est.
                      </td>
                      <td scope="col">
                        <button
                          class="btn btn-detail"
                          aria-label="View Details"
                        >
                          <img
                            src="assets/img/icon/eye.png"
                            alt="View Details"
                          />
                        </button>
                      </td>
                    </tr>
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
                    <tr class="data rounded">
                      <td scope="col">1</td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Design System UI/UX
                      </td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Deskripsinya adalah Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit. Soluta, est.
                      </td>
                      <td scope="col">
                        <button
                          class="btn btn-detail"
                          aria-label="View Details"
                        >
                          <img
                            src="assets/img/icon/eye.png"
                            alt="View Details"
                          />
                        </button>
                      </td>
                    </tr>
                    <tr class="data rounded">
                      <td scope="col">1</td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Design System UI/UX
                      </td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Deskripsinya adalah Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit. Soluta, est.
                      </td>
                      <td scope="col">
                        <button
                          class="btn btn-detail"
                          aria-label="View Details"
                        >
                          <img
                            src="assets/img/icon/eye.png"
                            alt="View Details"
                          />
                        </button>
                      </td>
                    </tr>
                    <tr class="data rounded">
                      <td scope="col">1</td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Design System UI/UX
                      </td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Deskripsinya adalah Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit. Soluta, est.
                      </td>
                      <td scope="col">
                        <button
                          class="btn btn-detail"
                          aria-label="View Details"
                        >
                          <img
                            src="assets/img/icon/eye.png"
                            alt="View Details"
                          />
                        </button>
                      </td>
                    </tr>
                    <tr class="data rounded">
                      <td scope="col">1</td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Design System UI/UX
                      </td>
                      <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                      >
                        Deskripsinya adalah Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit. Soluta, est.
                      </td>
                      <td scope="col">
                        <button
                          class="btn btn-detail"
                          aria-label="View Details"
                        >
                          <img
                            src="assets/img/icon/eye.png"
                            alt="View Details"
                          />
                        </button>
                      </td>
                    </tr>
                  </table>
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
