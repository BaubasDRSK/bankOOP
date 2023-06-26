<main class="main-content">
        <div class="login-wrapp">
            <div class="login-logo">
                <img src="./img/logo.webp" alt="logo">
            </div>
            <div class="main-form">
                <form action="/login" method="post" class="login-form">
                    <h1 class="main-h">Welcome back</h1>
                    <p class="info">Enter your credentials to access your account.</p>
                    <div class="input">
                        <img src="./img/email.svg" alt="email-icon">
                        <input type="text" name="fname" id="fname" placeholder="Enter your name"  value="<?= $old['fname'] ?? ''?>" required>
                    </div>
                    <div class="input">
                        <img src="./img/password.svg" alt="psw-icon">
                        <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    </div>
                    <button class="btn-blue" type="submit">Login</button>

                </form>
            </div>
        </div>
    </main>
