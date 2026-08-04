// =========================
// Registration Validation
// =========================

const registerForm = document.getElementById("registerForm");

if (registerForm) {

    registerForm.addEventListener("submit", function (e) {

        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const confirm = document.getElementById("confirmPassword").value;

        const emailRegex =
            /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (name.length < 3) {
            alert("Name must contain at least 3 characters.");
            e.preventDefault();
            return;
        }

        if (!emailRegex.test(email)) {
            alert("Invalid Email");
            e.preventDefault();
            return;
        }

        if (password.length < 6) {
            alert("Password must be at least 6 characters.");
            e.preventDefault();
            return;
        }

        if (password !== confirm) {
            alert("Passwords do not match.");
            e.preventDefault();
        }

    });

}

// =========================
// Login Validation
// =========================

const loginForm = document.getElementById("loginForm");

if (loginForm) {

    loginForm.addEventListener("submit", function (e) {

        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();

        if (email === "" || password === "") {
            alert("Please fill all fields.");
            e.preventDefault();
        }

    });

}