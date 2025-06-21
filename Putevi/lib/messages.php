<?php session_start(); ?>

<!-- Стили для уведомлений -->
<style>
.toast-message {
    position: fixed;
    top: 150px;
    /* Размещаем по центру горизонтально */
    left: 50%;
    /* Смещаем назад на половину собственной ширины */
    transform: translateX(-50%);
    background-color: #d4edda;
    color: #155724;
    padding: 15px 25px;
    border-radius: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.5s ease, transform 0.5s ease;
    animation: fadeIn 0.3s ease-out forwards;
    /* Добавляем автоматические margins для лучшего центрирования */
    margin: 0 auto;
    /* Ограничиваем максимальную ширину, если нужно */
    max-width: 80%;
    /* Перенос текста на несколько строк, если нужно */
    word-wrap: break-word;
    text-align: center;
}

.toast-message.error {
    background-color: #f8d7da;
    color: #721c24;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translate(-50%, -10px);
    }

    to {
        opacity: 1;
        transform: translate(-50%, 0);
    }
}

@keyframes fadeOut {
    to {
        opacity: 0;
        transform: translate(-50%, -10px);
    }
}
</style>

<!-- Блок ошибок -->
<?php if (!empty($_SESSION['errors'])): ?>
<div id="toastMessage" class="toast-message error">
    <strong>Ошибка:</strong><br>
    <?php foreach ($_SESSION['errors'] as $error): ?>
    <div><?= htmlspecialchars($error) ?></div>
    <?php endforeach; ?>
</div>
<?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<!-- Блок успеха -->
<?php if (!empty($_SESSION['success'])): ?>
<div id="toastMessage" class="toast-message">
    <?= htmlspecialchars($_SESSION['success']) ?>
</div>
<?php unset($_SESSION['success']); ?>
<?php endif; ?>

<!-- Скрипт для автоматического скрытия -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const message = document.getElementById("toastMessage");
    if (!message) return;

    setTimeout(() => {
        message.style.opacity = "0";
        message.style.transform = "translateY(-10px)";
        setTimeout(() => message.remove(), 500); // Удаляем из DOM после анимации
    }, 5000); // Через 5 секунд
});
</script>