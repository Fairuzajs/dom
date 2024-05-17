<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из POST запроса
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $tel = htmlspecialchars($_POST['tel'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');
    
    // Email-адрес, с которого фактически производится отправка
    $fromEmail = "no-reply@yourdomain.com";  // Замените на адрес, который использует ваш домен

    // Заголовки
    $headers = "From: Your Site Name <$fromEmail>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // Кому отправлять
    $to = "ffaffaa@yandex.ru"; // Укажите ваш реальный email
    $subject = "Новая заявка с сайта";
    $body = "Имя: $name\nEmail: $email\nТелефон: $tel\nСообщение: $message";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["success" => true]); // Успешно отправлено
    } else {
        echo json_encode(["success" => false]); // Ошибка отправки
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method Not Allowed"]);
}
