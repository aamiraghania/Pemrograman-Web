document.querySelector("form").addEventListener("submit", function(e) {
  e.preventDefault();

  const nama = document.querySelector('input[name="fullname"]').value;
  const email = document.querySelector('input[name="email"]').value;
  const password = document.querySelector('input[name="password"]').value;
  const konfirmasi = document.querySelector('input[name="confirm_password"]').value;

  if (password !== konfirmasi) {
    alert("Konfirmasi password tidak cocok!");
    return;
  }

  if (password.length < 8) {
    alert("Password minimal 8 karakter!");
    return;
  }

  fetch("backend/register.php", {
  method: "POST",
  headers: { "Content-Type": "application/x-www-form-urlencoded" },
  body: `fullname=${encodeURIComponent(nama)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}&confirm_password=${encodeURIComponent(konfirmasi)}`
  })
  .then(res => res.text())
  .then(response => {
    alert(response); 
    console.log(response);
  })
  .catch(err => alert("Terjadi kesalahan: " + err));

});
