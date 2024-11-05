<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('css/logindanregis.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/vendors/feather/feather.css">
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/images/favicon.png" />

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="/images/logo.png" class="mr-2"
                    alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                        aria-labelledby="profileDropdown">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>

    <div class="container-fluid" style="padding-top: 120px;">
        <div class="row no-gutters">
            <!-- Left side: Login/Register Form -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="w-75">
                    <!-- Login Form -->
                    <div class="login-container form-container" id="loginForm">

                        <h2>Halo,<br> Selamat Datang Kembali</h2>
                        <p>Silahkan melakukan login terlebih dahulu</p>

                        <form method="POST" action="" class="sign-in-form">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email">
                            </div>
                            <div class="form-group position-relative">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password">
                                <i class="fas fa-eye eye-toggle" id="login-toggleBtn" style="position: absolute; right: 10px; top: 58%; cursor: pointer;"></i>
                            </div>
                            <div class="form-check d-flex justify-content-between align-items-center">
                                <div>
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <a href="#" class="forgot-password">Forgot password?</a>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Masuk</button>
                        </form>

                        <div class="signup-container">
                            <p class="mt-3">Belum punya akun? <span class="toggle-link" id="toggleRegister">Buat akun</span></p>
                        </div>
                    </div>

                    <!-- Register Form -->
                </div>
            </div>

            <!-- Right side: Image -->
            <div class="col-lg-6 d-none d-lg-block login-image ml-10">
                <img src="/images/logo.png" alt="Login/Register Image" class="img-fluid" style="width: 50%; height: auto; object-fit: cover; margin-left: 100px;">
            </div>

        </div>

        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">©2024, Queen Bakery</span>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const toggleRegister = document.getElementById('toggleRegister');
            const toggleLogin = document.getElementById('toggleLogin');
            const passwordField = document.getElementById('register-password');
            const toggleBtn = document.getElementById('toggleBtn');
            const validation = document.getElementById('validation');

            // Toggle between login and register forms
            toggleRegister.onclick = function() {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
            }

            toggleLogin.onclick = function() {
                registerForm.classList.add('hidden');
                loginForm.classList.remove('hidden');
            }

            // Password toggle function for register form
            const registerPasswordField = document.getElementById('register-password');
            const registerToggleBtn = document.getElementById('register-toggleBtn');

            registerToggleBtn.onclick = function() {
                if (registerPasswordField.type === 'password') {
                    registerPasswordField.setAttribute('type', 'text');
                    registerToggleBtn.classList.remove('fa-eye');
                    registerToggleBtn.classList.add('fa-eye-slash');
                } else {
                    registerPasswordField.setAttribute('type', 'password');
                    registerToggleBtn.classList.remove('fa-eye-slash');
                    registerToggleBtn.classList.add('fa-eye');
                }
            }

            // Password toggle function
            toggleBtn.onclick = function() {
                if (passwordField.type === 'password') {
                    passwordField.setAttribute('type', 'text');
                    toggleBtn.classList.add('hide');
                } else {
                    passwordField.setAttribute('type', 'password');
                    toggleBtn.classList.remove('hide');
                }
            }

            // Password validation logic
            passwordField.addEventListener('focus', function() {
                validation.style.display = 'block';
            });

            passwordField.addEventListener('input', function() {
                checkPassword(this.value);
            });

            function checkPassword(data) {
                const lower = new RegExp('(?=.*[a-z])');
                const upper = new RegExp('(?=.*[A-Z])');
                const number = new RegExp('(?=.*[0-9])');
                const special = new RegExp('(?=.*[!@#\$%\^&\*])');
                const length = new RegExp('(?=.{8,})');

                const lowerCase = document.getElementById('lower');
                const upperCase = document.getElementById('upper');
                const digit = document.getElementById('number');
                const specialChar = document.getElementById('special');
                const minLength = document.getElementById('length');

                lower.test(data) ? lowerCase.style.display = 'none' : lowerCase.style.display = 'block';
                upper.test(data) ? upperCase.style.display = 'none' : upperCase.style.display = 'block';
                number.test(data) ? digit.style.display = 'none' : digit.style.display = 'block';
                special.test(data) ? specialChar.style.display = 'none' : specialChar.style.display = 'block';
                length.test(data) ? minLength.style.display = 'none' : minLength.style.display = 'block';
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const loginPasswordField = document.getElementById('login-password');
            const loginToggleBtn = document.getElementById('login-toggleBtn');
            loginToggleBtn.onclick = function() {
                // Toggle the eye icon between eye and eye-slash
                if (loginPasswordField.type === 'password') {
                    loginPasswordField.setAttribute('type', 'text');
                    loginToggleBtn.classList.remove('fa-eye');
                    loginToggleBtn.classList.add('fa-eye-slash');
                } else {
                    loginPasswordField.setAttribute('type', 'password');
                    loginToggleBtn.classList.remove('fa-eye-slash');
                    loginToggleBtn.classList.add('fa-eye');
                }
            }
        });
    </script>

</body>

</html>