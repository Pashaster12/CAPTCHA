<?php

function check_code($code) 
{
    session_start();
    $captcha = $_SESSION['captcha'];
    session_destroy();
    
    return md5(md5($code)) == $captcha ? true : false;
}

if (isset($_POST['submit_form']))
{
    if ($_POST['code_captcha'] == '') exit('Робот, уходи!');   
    
    if (check_code($_POST['code_captcha'])) echo 'Капча пройдена успешно!';
    else exit("Неверная капча!");
}
else {
    exit("Хакер, уходи!");
}