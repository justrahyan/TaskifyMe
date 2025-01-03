const hamburger = document.getElementById("hamburger");
const sidebar = document.getElementById("sidebar");
// Toggle sidebar ketika hamburger diklik
hamburger.addEventListener("click", () => {
  sidebar.classList.toggle("active");
});
// Menutup sidebar jika klik di luar sidebar
document.addEventListener("click", (event) => {
  if (!sidebar.contains(event.target) && !hamburger.contains(event.target)) {
    sidebar.classList.remove("active");
  }
});

// ==========================

// Password Toggle di modal form password baru (settings.php)
document
  .getElementById("toggle-password")
  .addEventListener("click", function () {
    const passwordField = document.getElementById("new-password");
    const icon = this.querySelector("i");
    if (passwordField.type === "password") {
      passwordField.type = "text";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    } else {
      passwordField.type = "password";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }
  });
