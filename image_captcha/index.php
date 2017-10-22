<?php

include('classes' . DIRECTORY_SEPARATOR . 'CaptchaField.php');

$captcha_field = new CaptchaField();
$captcha_code = $captcha_field->generate_code();

include_once('form.html');