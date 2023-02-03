<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php
    include "fonts.php";
    ?>
    <link rel="stylesheet" href="css/style.css">
    <title>Техническое задание</title>
</head>
<body>
<form action="mailer.php" method="post" enctype="multipart/form-data">
    <h2>Согласование</h2>
    <div class="inputs">
        <label for="name">
            <div class="input_information">
                <p class="input_name"><span>*</span> Ваше имя</p>
                <div></div>
            </div>
            <input type="text" class="print_place" name="name" id="name" placeholder="имя">
        </label>
        <label for="email">
            <div class="input_information">
                <p class="input_name"><span>*</span> Ваш email</p>
                <div></div>
            </div>
            <input type="text" class="print_place" name="email" id="email" placeholder="email">
        </label>
        <label for="">
            <div class="input_information">
                <p class="input_name">Тема</p>
                <div></div>
            </div>
        </label>
        <select name="select" title="Выберете вашу тему">
            <?php
            for ($i = 1; $i < 6; $i++){
                echo "<option class='menu_line'><p>Тема $i</p></option>";
            }
            ?>
        </select>
        <label for="message">
            <div class="input_information">
                <p class="input_name"><span>*</span> Сообщение</p>
                <div></div>
            </div>
            <textarea name="user_message" class="print_place" id="message" cols="30" placeholder="ваше сообщение" rows="10"></textarea>
        </label>
    </div>
    <div class="attachments">
        <h3>Вложение</h3>
        <div>
            <p class="file_warning file_warning_size">У файла слишком большой вес!</p>
            <p class="file_warning file_warning_format">Ошибка в формате файла!</p>
            <input class="file" name="userfile" multiple accept='.pdf,.bmp,.jpg,.jpeg,.png' type="file" />
        </div>
    </div>
    <button class="send_button">Отправить</button>
</form>
<script src="script.js"></script>
</body>
</html>