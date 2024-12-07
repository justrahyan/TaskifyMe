$(document).ready(function () {
  // Menampilkan tombol simpan saat ada perubahan
  $(
    ".description-input, .status-select, .categories-select, .deadline-date, .priority-select"
  ).on("change keyup", function () {
    $(this).siblings(".btn-save").show();
  });

  // Simpan deskripsi
  $(".save-description-btn").on("click", function () {
    let taskId = $(this).data("task-id");
    let description = $(
      '.description-input[data-task-id="' + taskId + '"]'
    ).val();
    updateTask(taskId, { description: description });
  });

  // Simpan status
  $(".save-status-btn").on("click", function () {
    let taskId = $(this).data("task-id");
    let status = $('.status-select[data-task-id="' + taskId + '"]').val();
    updateTask(taskId, { status: status });
  });

  // Simpan kategori
  $(".save-categories-btn").on("click", function () {
    let taskId = $(this).data("task-id");
    let categories = $(
      '.categories-select[data-task-id="' + taskId + '"]'
    ).val();
    updateTask(taskId, { categories: categories });
  });

  // Simpan deadline
  $(".save-deadline-btn").on("click", function () {
    let taskId = $(this).data("task-id");
    let deadline = $('.deadline-date[data-task-id="' + taskId + '"]').val();
    updateTask(taskId, { deadline: deadline });
  });

  // Simpan prioritas
  $(".save-priority-btn").on("click", function () {
    let taskId = $(this).data("task-id");
    let priority = $('.priority-select[data-task-id="' + taskId + '"]').val();
    updateTask(taskId, { priority: priority });
  });

  // Fungsi untuk memperbarui tugas
  function updateTask(id, data) {
    $.ajax({
      url: "./update_task.php",
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify({ id: id, ...data }),
      success: function (response) {
        alert(response.message || "Update berhasil!");
        location.reload(); // Reload halaman untuk melihat perubahan
      },
      error: function () {
        alert("Terjadi kesalahan saat memperbarui tugas.");
      },
    });
  }
});
