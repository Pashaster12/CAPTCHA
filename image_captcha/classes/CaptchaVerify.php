<?php

class CaptchaVerify
{

    private $captcha_value = '';
    private $captcha_field = '';
    private $answer_time = '';

    private function session_read()
    {
        session_start();
        
        $this->captcha_value = $_SESSION['captcha_value'];
        $this->captcha_field = $_SESSION['captcha_field'];
        $this->answer_time = $_SESSION['answer_time'];

        unset($_SESSION['captcha_value']);
        unset($_SESSION['captcha_field']);
        unset($_SESSION['answer_time']);
    }

    private function error_msg($message)
    {
        $_SESSION[$_SERVER['REMOTE_ADDR']] ++;
        exit($message);
    }

    public function verify_code()
    {
        $this->session_read();

        if (isset($_SESSION[$_SERVER['REMOTE_ADDR']]) && $_SESSION[$_SERVER['REMOTE_ADDR']] >= 10)
            $this->error_msg('Вы ввели слишком много неверных капчей! Обратитесь за помощью к администратору admin@admin.net');

        if (isset($_POST['submit_form']) && !empty($this->captcha_value) && !empty($this->captcha_field) && !empty($this->answer_time))
        {
            $this->current_time = strtotime(date('d-m-Y H:i:s'));

            if ($this->current_time - $this->answer_time < 6)
                $this->error_msg('Вы или робот или вводите капчу слишком быстро!');
            if ($_POST[$this->captcha_field] == '')
                $this->error_msg('Робот, уходи!');

            if (md5(md5($_POST[$this->captcha_field])) == $this->captcha_value)
                echo 'Капча пройдена успешно!';
            else
                $this->error_msg('Неверная капча!');
        }
        else $this->error_msg('Хакер, уходи!');
    }
}