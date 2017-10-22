<?php

include('classes' . DIRECTORY_SEPARATOR . 'CaptchaVerify.php');

$captcha_verify = new CaptchaVerify();
$captcha_verify->verify_code();