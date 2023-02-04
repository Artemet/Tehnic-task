<?php
use PHPMailer\PHPMailer\PHPMailer;
$name = $_POST["name"];
$email = $_POST["email"];
$select = $_POST["select"];
$user_message = $_POST["user_message"];
$email_host = "asharapov976@gmail.com";
$arr = ["francesco-donni.com", "mrtp.org", "logistic976.000webhostapp.com", "gmail.com"];
$format = ["pdf", "bmp", " jpg", "jpeg", "png"];
$error = [];
$server_name = $_SERVER["HTTP_HOST"];
foreach($arr as $item){
    if($server_name !== $item){
        $error[0] = "Домен не найден";
    }
    else{
        unset($error[0]);
        break;
    }
}
foreach($arr as $item){
    $test = stristr($email, $item);
    if(!$test){
        $error[1] = "Домен почты не найден";
    }
    else{
        unset($error[1]);
        break;
    }
}
$to = 'mailto:'.$email_host;
$subject = 'the subject';
$message = "
email = $email 
name = $name
тема = $select
";
$headers = array(
    'From' => 'Согласование',
    'Reply-To' => 'webmaster@example.com',
    'X-Mailer' => 'PHP/' . phpversion()
);
if(count($error)){
    include "fonts.php";
    print_r("<link rel=\"stylesheet\" href=\"css/modals.css\">");
    print_r("<div class=\"modal_message\"><div class=\"modal\">
    <p>У вас обнаружина ошибка. <br> Домен почты не найден!</p>");
    print_r("<div><a href=\"https://logistic976.000webhostapp.com/dev/\">
    <button>go back</button></div></div></a></div>");
    foreach($error as $item){
        echo "<br>";
        print_r($item);
    }
}
else{
    include "fonts.php";
    print_r("<link rel=\"stylesheet\" href=\"css/modals.css\">");
    print_r("<div class=\"modal_message\"><div class=\"modal\">
    <p>Успешно успешно <br> отправленно</p>");
    print_r("<div><a href=\"https://logistic976.000webhostapp.com/dev/\">
    <button>go back</button></div></div></a></div>");
    $message = "
<html>
<head>
  <title>Согласование</title>
</head>
<body>
<h2><u>Согласование</u></h2>
  <p>имя = $name</p>
  <p>email = $email</p>
  <p>тема = $select</p>
  <p>сообщение: $user_message</p>
</body>
</html>
";
sendMailAttachment($email_host, "ayahoo976@gmail.com", "Согласование", $message, $_FILES["userfile"]);
}
    function sendMailAttachment($mailTo, $From, $subject_text, $message, $FILES){
            $to = $mailTo;
    
            $EOL = "\r\n"; // ограничитель строк, некоторые почтовые сервера требуют \n - подобрать опытным путём
            $boundary     = "--".md5(uniqid(time()));  // любая строка, которой не будет ниже в потоке данных. 
    
            $subject= '=?utf-8?B?' . base64_encode($subject_text) . '?=';
    
            $headers    = "MIME-Version: 1.0;$EOL";   
            $headers   .= "Content-Type: multipart/mixed; text/html; charset=iso-8859-1'; boundary=\"$boundary\"$EOL";  
            $headers   .= "From: $From\nReply-To: $From\n";  
    
            $multipart  = "--$boundary$EOL";   
            $multipart .= "Content-Type: text/html; charset=utf-8$EOL";   
            $multipart .= "Content-Transfer-Encoding: base64$EOL";   
            $multipart .= $EOL; // раздел между заголовками и телом html-части 
            $multipart .= chunk_split(base64_encode($message));   
    
            #начало вставки файлов
            $arr = array("userfile");
            for($i = 0; $i < 100; $i++){
                $arr[]="userfile" . $i;
            }
            foreach($arr as $key => $value){
                $filename = $_FILES[$value]["tmp_name"];
                $file = fopen($filename, "rb");
                $data = fread($file,  filesize( $filename ) );
                print_r(json_encode($file));
                fclose($file);
                $NameFile = $_FILES[$value]["name"]; // в этой переменной надо сформировать имя файла (без всякого пути);
                $File = $data;
                $multipart .=  "$EOL--$boundary$EOL";
                $multipart .= "Content-Type: application/octet-stream; name=\"$NameFile\"$EOL";   
                $multipart .= "Content-Transfer-Encoding: base64$EOL";
                $multipart .= "Content-Disposition: attachment; filename=\"$NameFile\"$EOL";  
                $multipart .= chunk_split(base64_encode($File));
    
            }
    
            #>>конец вставки файлов
    
            $multipart .= "$EOL--$boundary--$EOL";
    
            if(!mail($to, $subject, $multipart, $headers)){
                echo 'Письмо не отправлено';
            } //Отправляем письмо
            else{
                // echo 'Письмо отправлено';
            }
    
        }
?>
