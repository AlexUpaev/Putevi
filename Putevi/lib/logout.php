<?php
session_start();
session_unset();      // Очищаем все переменные сессии
session_destroy();    // Уничтожаем сессию

header("Location: /");
exit;