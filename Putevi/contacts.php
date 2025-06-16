<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
    <link rel="icon" href="/img/Logo.svg">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/contacts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- Фоновое изображение -->
        <div class="hero-bg">
            <img src="/img/contacts.jpg" alt="">
        </div>

        <!-- Шапка -->
        <?php require_once "blocks/header.php"; ?>

        <!-- Контент -->
        <div class="hero">
            <div class="hero--info">
                <h1>О нас</h1>
                <p>Сложные конструкции, аутентичная архитектура,
                    эксклюзивные интерьеры, технологические инновации.
                    Гостиницы, бизнес-жилые и коммерческие объекты,
                    университетские городки, аквапарки, стадионы</p>
            </div>
        </div>

        <!-- Сообщения об ошибках и успехе -->
        <?php require_once "lib/messages.php"; ?>

        <!-- Контактная информация -->
        <div class="contact-container">
            <div class="contact-info">
                <h2><i class="fas fa-map-marker-alt"></i> Адрес</h2>
                <p>ул. Обручева, 23к 3117630, Москва РФ</p>

                <h2><i class="fas fa-phone"></i> Телефоны</h2>
                <p>+7 (495) 937 5206</p>

                <h2><i class="fas fa-envelope"></i> Email</h2>
                <p>info@putevi.com</p>

                <h2><i class="fas fa-clock"></i> Часы работы</h2>
                <p>Пн-Пт: 9:00 - 18:00</p>
                <p>Сб-Вс: выходные</p>
            </div>

            <div class="contact-map">
                <iframe
                    src="https://yandex.ru/map-widget/v1/?ll=37.529412%2C55.657672&z=16&pt=37.529412%2C55.657672%2Ccomma"
                    width="100%" height="500" frameborder="0"></iframe>
            </div>
        </div>

        <!-- Секция отзывов -->
        <div class="reviews-section">
            <h2>Отзывы наших клиентов</h2>

            <div class="reviews-container">
                <!-- Отзывы -->
                <div class="review-card">
                    <div class="review-header">
                        <h3>Отличная работа!</h3>
                        <div class="rating">
                            <?php for($i = 0; $i < 5; $i++): ?>
                            <i class="fas fa-star"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <p class="review-content">Строительная компания выполнила все работы в срок и с отличным качеством.
                        Рекомендую!</p>
                    <p class="review-author">- Иван Петров</p>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <h3>Профессиональный подход</h3>
                        <div class="rating">
                            <?php for($i = 0; $i < 4; $i++): ?>
                            <i class="fas fa-star"></i>
                            <?php endfor; ?>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                    <p class="review-content">Качество работ на высоком уровне, но стоимость немного превысила
                        первоначальную смету.</p>
                    <p class="review-author">- Анна Козлова</p>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <h3>Профессионалы своего дела</h3>
                        <div class="rating">
                            <?php for($i = 0; $i < 5; $i++): ?>
                            <i class="fas fa-star"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <p class="review-content">Очень доволен сотрудничеством. Все пожелания были учтены, а результат
                        превзошел ожидания.</p>
                    <p class="review-author">- Ольга Смирнова</p>
                </div>
            </div>

            <!-- Форма добавления отзыва -->
            <div class="add-review-form">
                <h3>Оставить отзыв</h3>

                <?php if(!empty($_SESSION['errors'])): ?>
                <div class="alert alert-danger">
                    <?php foreach($_SESSION['errors'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                    <?php unset($_SESSION['errors']); ?>
                </div>
                <?php endif; ?>

                <?php if(!empty($_SESSION['review_errors'])): ?>
                <div class="alert alert-warning">
                    <?php foreach($_SESSION['review_errors'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                    <?php unset($_SESSION['review_errors']); ?>
                </div>
                <?php endif; ?>

                <form method="post" action="lib/reviews.php" id="review-form">
                    <input type="hidden" name="csrf_token"
                        value="<?= $_SESSION['csrf_token'] = bin2hex(random_bytes(32)) ?>">

                    <div class="form-group">
                        <label for="review-title">Заголовок отзыва</label>
                        <input type="text" id="review-title" name="title" required
                            value="<?= htmlspecialchars($_SESSION['review_form']['title'] ?? '') ?>" maxlength="100"
                            placeholder="Краткое описание">
                    </div>

                    <div class="form-group">
                        <label for="review-content">Текст отзыва</label>
                        <textarea id="review-content" name="content" required maxlength="255"
                            placeholder="Подробно опишите ваш опыт"><?= 
                htmlspecialchars($_SESSION['review_form']['content'] ?? '') 
            ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Ваша оценка</label>
                        <div class="rating-select">
                            <?php 
                $saved_rating = $_SESSION['review_form']['rating'] ?? 5;
                unset($_SESSION['review_form']['rating']);
                
                for($i = 5; $i >= 1; $i--): 
                ?>
                            <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>"
                                <?= $i == $saved_rating ? 'checked' : '' ?>>
                            <label for="star<?= $i ?>" title="<?= $i ?> звезд">
                                <i class="fas fa-star"></i>
                            </label>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn"> Отправить отзыв</button>
                </form>
            </div>
        </div>

        <!-- Контейнер для фото с историей  -->
        <div class="history-fullwidth-container">
            <!-- Фоновое изображение на всю ширину -->
            <div class="history-image-wrapper">
                <img src="/img/highway.jpg" alt="История компании" class="history-fullwidth-image">
            </div>

            <!-- Контент поверх изображения -->
            <div class="history-content-wrapper">
                <div class="history-content">
                    <h2>63 года бизнеса</h2>
                    <p>Наша история - это история объединения людей и мест, о страстных делах, которые сформировали нашу
                        компанию.</p>
                    <p class="highlight-text">Загляните в мир дорог</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Футер -->
    <?php require_once "blocks/footer.php"; ?>

    <script src="/js/header.js"></script>
</body>

</html>