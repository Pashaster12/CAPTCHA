<?php

error_reporting(E_ERROR);

include('CaptchaInterface.php');

class CaptchaField implements CaptchaInterface
{
    public function session_write($code)
    {
        session_start();
        $_SESSION['captcha_field'] = $code;
    }

    public function generate_code()
    {
        $captcha_field = md5(md5(uniqid('', true) . date('His')));
        $this->session_write($captcha_field);

        return $captcha_field;
    }

}
