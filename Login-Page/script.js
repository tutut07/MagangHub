const form = document.getElementById("loginForm");
const email = document.getElementById("email");
const password = document.getElementById("password");
const error = document.getElementById("error");

form.addEventListener("submit", function (e) {

    e.preventDefault();

    error.innerHTML = "";

    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();

    // Validasi Email
    const emailRegex =
        /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(emailValue)) {
        error.innerHTML = "Email tidak valid!";
        email.focus();
        return;
    }

    // Validasi Password
    if (passwordValue.length < 6) {
        error.innerHTML = "Password minimal 6 karakter!";
        password.focus();
        return;
    }

    // Data Login
    const loginData = {
        email: emailValue,
        loginAt: new Date().toISOString()
    };

    // Simpan ke LocalStorage
    localStorage.setItem(
        "loginData",
        JSON.stringify(loginData)
    );

    console.log("Login berhasil!");

    alert("Login berhasil!");

    form.reset();

});