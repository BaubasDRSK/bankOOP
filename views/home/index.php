<main class="main-content">
        <div class="login-wrapp">
            <div class="login-logo">
                <img src="./img/logo.webp" alt="logo">
            </div>
            <div class="main-form">
            <a class="btn-blue" href="/accounts">Accounts</a>
            <?php if(isset($_SESSION['user_email'])) :?>
                <a class="btn-red" href="/logout">Logout</a>
            <?php else :?>
                <a class="btn-red" href="/login">Login</a>
            <?php endif?>     
            </div>
        </div>
    </main>

