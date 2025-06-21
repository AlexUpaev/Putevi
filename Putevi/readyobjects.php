<?php 
session_start();
require_once "lib/get_projects_data.php";

// Обработка добавления новой фотографии
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image_file'])) {
    // Проверка прав перед обработкой
    if (!isset($_SESSION['user']) || 
        !in_array($_SESSION['user']['role'], ['администратор', 'сотрудник']) || 
        empty($_SESSION['user']['interaction_with_projects'])) {
        $_SESSION['errors'] = ["У вас нет прав для выполнения этого действия"];
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    
    $project_id = (int)$_POST['project_id'];
    $result = add_project_image($project_id, $_FILES['image_file']);
    
    if (isset($result['error'])) {
        $_SESSION['errors'] = [$result['error']];
    } else {
        $_SESSION['success'] = "Фотография успешно добавлена";
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Получаем проекты
try {
    $projects = get_all_projects();
} catch (Exception $e) {
    $_SESSION['errors'] = ["Ошибка при загрузке проектов: " . $e->getMessage()];
    $projects = [];
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Построенные объекты</title>
    <link rel="icon" href="/img/Logo.svg">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/constructionobjects.css">
</head>

<body>
    <div class="wrapper">
        <!-- Фоновое изображение -->
        <div class="hero-bg">
            <img src="/img/readyobjects.jpg" alt="">
        </div>

        <!-- Шапка -->
        <?php require_once "blocks/header.php"; ?>

        <!-- Сообщения об ошибках и успехе -->
        <?php require_once "lib/messages.php"; ?>

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

        <?php if (!empty($projects)): ?>
        <?php 
            $current_date = date('Y-m-d');
            foreach ($projects as $project): 
                // Пропускаем проекты с датой окончания больше текущей даты
                if (!empty($project['end_date']) && $project['end_date'] >= $current_date) {
                    continue;
                }
            ?>
        <div class="project-container">
            <div class="project-header">
                <h1 class="project-title"><?= htmlspecialchars($project['title'] ?? '') ?></h1>
                <span class="project-status status-<?= 
                        ($project['status'] ?? '') === 'Завершен' ? 'completed' : 'active' 
                    ?>">
                    <?= htmlspecialchars($project['status'] ?? 'В работе') ?>
                </span>
            </div>

            <div class="project-details">
                <div class="detail-item">
                    <div class="detail-label">Дата начала</div>
                    <div>
                        <?= !empty($project['start_date']) ? date('d.m.Y', strtotime($project['start_date'])) : 'Не указана' ?>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Дата завершения</div>
                    <div>
                        <?= !empty($project['end_date']) ? date('d.m.Y', strtotime($project['end_date'])) : 'Не указана' ?>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Адрес</div>
                    <div><?= htmlspecialchars($project['address'] ?? 'Не указан') ?></div>
                </div>
            </div>

            <div class="project-description">
                <h3>Описание проекта</h3>
                <p><?= !empty($project['description']) ? htmlspecialchars($project['description']) : 'Описание отсутствует' ?>
                </p>
            </div>

            <div class="project-budget">
                Бюджет проекта: <?= isset($project['budget']) ? number_format($project['budget'], 0, '', ' ') : '0' ?> ₽
            </div>

            <h3>Фотографии проекта</h3>
            <div class="images-container">
                <?php if (!empty($project['images'])): ?>
                <?php foreach ($project['images'] as $image): ?>
                <?php 
                            try {
                                $image_data = get_image_data($image['id_image']);
                                if ($image_data) {
                                    $thumbnail_data = create_thumbnail($image_data['data'], $image_data['mime'], 150, 150);
                                    $full_image_data = base64_encode($image_data['data']);
                            ?>
                <div class="image-wrapper">
                    <img src="data:<?= $image_data['mime'] ?>;base64,<?= base64_encode($thumbnail_data) ?>"
                        alt="Фото проекта" class="project-image"
                        onclick="openModal('data:<?= $image_data['mime'] ?>;base64,<?= $full_image_data ?>')">
                </div>
                <?php 
                                }
                            } catch (Exception $e) {
                                error_log("Ошибка при загрузке изображения ID {$image['id_image']}: " . $e->getMessage());
                            }
                            ?>
                <?php endforeach; ?>
                <?php endif; ?>

                <?php 
                    // Проверка прав для отображения кнопки добавления фото
                    if (isset($_SESSION['user']) && 
                        in_array($_SESSION['user']['role'], ['администратор', 'сотрудник']) && 
                        !empty($_SESSION['user']['interaction_with_projects'])): 
                    ?>
                <div class="upload-container">
                    <form method="post" enctype="multipart/form-data" class="add-image-form">
                        <input type="hidden" name="project_id" value="<?= $project['id_project'] ?? '' ?>">
                        <input type="file" name="image_file" accept="image/jpeg,image/png,image/gif" class="file-input"
                            required>
                        <div class="upload-icon">
                            <span class="plus-icon">+</span>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="no-projects">
            <p>Нет доступных проектов для отображения</p>
        </div>
        <?php endif; ?>

        <!-- Контейнер для фото с историей -->
        <?php require_once "blocks/history_with_image.php"; ?>
    </div>

    <!-- Модальное окно для просмотра изображений -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <!-- Футер -->
    <?php require_once "blocks/footer.php"; ?>

    <script src="/js/header.js"></script>
    <script src="/js/images.js"></script>
</body>

</html>