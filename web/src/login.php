<!DOCTYPE html>
<html>
<head>
    <title>Wisata Sendang Growong</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <div class="container">
        <div class="header" >
            <span class="header-title">Wisata Sendang Growong</span>
            <div class="menu" style="position: fixed; z-index: 1000;"></div>
        </div>
        <div class="content">
            <div class="left-section">
                <h1>Log In</h1>
                <p>Masuk ke akunmu dan pergi berwisata</p>
            </div>
            <div class="right-section">
                <div class="form-container">
                    <form action="logic/proses_login.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="input-container">
                            <label id="label-email"></label><br>
                            <input id="form-email" type="email" name="form-email" placeholder="Masukan email anda" />
                            <span class="email-icon">&#9993;</span>
                        </div>
                        <div class="input-container">
                            <label id="label-password"></label><br>
                            <input id="form-password" type="password" name="form-password" placeholder="Masukan password anda" />
                        </div>
                        <button class="sign-up-button" type="submit" name="login" id="login">Log In</button>
                    </form>
                    <p class="login-link">Belum memiliki akun? <a href="register.php">Buat Akun</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            // Change icon accordingly
            togglePassword.innerHTML = type === 'password' ? '&#128274;' : '&#128065;';
        });
    </script>
</body>
</html>
