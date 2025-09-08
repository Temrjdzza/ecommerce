<?php
// Определяем какую страницу показывать
$page = isset($_GET['page']) ? $_GET['page'] : 'acquaintance';

// Список доступных страниц
$allowed_pages = ['home', 'about', 'contact', 'services', 'acquaintance', 'login', 'register'];
if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

// Для страниц аутентификации не показываем шапку и сайдбар
$auth_pages = ['login', 'register'];
$show_layout = !in_array($page, $auth_pages);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pando</title>
    <!-- Подключение зависимостей -->
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Встраеваем верхнее меню -->
    <?php include 'pages/context/header.php'; ?>
    
    <div class="container">
        <!-- Встраеваем боковое меню -->
        <?php include 'pages/context/sidebar.php'; ?>
        
        <main class="main-content">
            <!-- Встраеваем основной контент -->
            <?php include "pages/content/{$page}.php"; ?>
        </main>
    </div>
    
    <!-- Встраеваем футер -->
    <?php include 'pages/context/footer.php'; ?>
    
    <script src="./javascripts/main.js"></script>
</body>
</html>