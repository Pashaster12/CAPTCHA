<?php

include('classes' . DIRECTORY_SEPARATOR . 'CaptchaValue.php');

$captcha = new CaptchaValue();
$captcha_code = $captcha->generate_code();
$captcha->captcha_image($captcha_code);