<header class="main-header">
        <div class="header-wrapp">
            <div class="header-logo">
                <a href="/accounts" class="logo-link"><img src="/img/logo.webp" alt="logo"></a>
            </div>
            <nav class="main-nav">
                <?php if(isset($srchLink)){echo $srchLink;}?>
                <a href="/accounts">List view</a>
                <a href="/account/create">Add new account</a>
                <a href="/logout">Logout</a>
            </nav>
        </div>
    </header>