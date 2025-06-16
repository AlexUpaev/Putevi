<header class="container-header">
    <span class="logo"><a href="/index.php"><img src="/img/Logo.svg" alt=""></a></span>
    <nav>
        <ul>
            <li><a href="index.php">Главная страница</a></li>

            <li class="dropdown">
                <a href="#" id="about-link">О компании</a>
                <div class="dropdown-content">
                    <a href="about.php">История</a>
                    <a href="aboutSPO.php">Допуск СРО</a>
                    <a href="aboutcertificates.php">Сертификаты</a>
                </div>
            </li>

            <?php if (isset($_SESSION['user'])): ?>
            <!-- Эти пункты видны только авторизованным -->
            <li class="dropdown">
                <a href="#" id="projects-link">Объекты</a>
                <div class="dropdown-content">
                    <a href="/readyobjects.php">Построенные объекты</a>
                    <a href="/constructionobjects.php">Строящиеся объекты</a>
                </div>
            </li>

            <li class="dropdown">
                <a href="#" id="services-link">Услуги</a>
                <div class="dropdown-content">
                    <a href="/services.php">Заявка на услугу</a>
                    <a href="/employment.php">Трудоустройство</a>
                </div>
            </li>

            <li><a href="/contacts.php">Контакты</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'администратор'): ?>
            <li class="dropdown">
                <a href="#admin">Для администратора</a>
                <div class="dropdown-content">
                    <a href="/database.php">БД</a>
                    <a href="/createproject.php">Создать проект</a>
                </div>
            </li>
            <?php endif; ?>

            <?php session_start(); ?>
            <li class="dropdown">
                <a href="#admin">Аккаунт</a>
                <div class="dropdown-content">
                    <?php if (isset($_SESSION['user'])): ?>
                    <!-- Пользователь авторизован -->
                    <a href="/account.php">Личный кабинет</a>
                    <a href="/lib/logout.php">Выход</a>
                    <?php else: ?>
                    <!-- Пользователь не авторизован -->
                    <a href="/login.php">Авторизация</a>
                    <a href="/registration.php">Регистрация</a>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
    </nav>
</header>