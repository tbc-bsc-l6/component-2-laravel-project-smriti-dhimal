<header class="header">
    <div class="header-container">
        <div class="site-name">educationalSite</div>
        <nav class="nav-links">
            <a href="/homepage" <?php if($pagetitle=='home'){ echo "class='sel'"; } ?>>Home</a>
            <a href="/about" <?php if($pagetitle=='about'){ echo "class='sel'"; } ?>>About</a>
            <a href="/contact" <?php if($pagetitle=='contact'){ echo "class='sel'"; } ?>>Contact</a>
            <a href="/dashboard" <?php if($pagetitle=='dashboard'){ echo "class='sel'"; } ?>>Dashboard</a>
            <a href="/login" class="login-button">Login</a>
            <a href="/register" class="register-button">Register</a>
        </nav>
    </div>
</header>
