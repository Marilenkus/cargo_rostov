<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
    }
    if (isset($_POST['message'])) {
        $message_text = $_POST['message'];
    }
    // if (isset($_POST['email'])) {$email = $_POST['email'];}
    if (isset($_POST['formData'])) {
        $formData = $_POST['formData'];
    }

    $to = "style-rostov@mail.ru"; /*Укажите адрес, на который должно приходить письмо*/
    $sendfrom   = "callback@cargo-rostov.ru"; /*Укажите адрес, с которого будет приходить письмо, можно не настоящий, нужно для формирования заголовка письма*/
    $headers  = "From: " . strip_tags($sendfrom) . "\r\n";
    $headers .= "Reply-To: " . strip_tags($sendfrom) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
    $subject = "$formData";
    // Формирование тела письма
    $msg = "<html><body style='font-family:Arial,sans-serif;'>";
    $msg .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>Заявка с сайта</h2>\r\n";
    $msg .= "<p><strong>Имя:</strong> ".$name."</p>\r\n";
    $msg .= "<p><strong>Телефон:</strong> ".$phone."</p>\r\n";
    $msg .= "<p><strong>Сообщение:</strong> ".$message_text."</p>\r\n";
    $msg .= "</body></html>";
    $send = mail($to, $subject, $msg, $headers);
    if ($send == 'true') {
        echo '<center>Спасибо за отправку вашего сообщения! Мы свяжемся с Вами в бижайшее время</center>';
    } else {
        echo '<center><b>Ошибка. Сообщение не отправлено! Проверьте правильность заполнения формы</b></center>';
    }
} else {
    http_response_code(403);
    echo "Попробуйте еще раз";
}
?>