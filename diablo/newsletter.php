<?php
if(isset($_POST['email'])){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        file_put_contents('emails.txt', $email.PHP_EOL, FILE_APPEND);
        header("Location: index.html?success=1");
        exit();
    } else {
        header("Location: index.html?success=0");
        exit();
    }
}
?>
