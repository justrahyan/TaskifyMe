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
