<header>
    <h2 class="logo">Логотип</h2>
    <nav>
        <a href="index.php" class="nav__button">Главная</a>
        <?php if(isset($_COOKIE["user_login"])){} else {?> 
        <a href="reg.php" class="nav__button">Регистрация</a>
        <?php }?>
        <a href="login.php" class="nav__button"><?php if(isset($_COOKIE["user_login"])) { print_r($_COOKIE["user_login"]);} else {print("Вход");} ?></a>
        
    </nav>
</header>