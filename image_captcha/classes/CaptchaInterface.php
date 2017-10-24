<?php

interface CaptchaInterface
{
    public function session_write($code);
    public function generate_code();
}
