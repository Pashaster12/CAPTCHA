<?php

include('CaptchaInterface.php');

class CaptchaValue implements CaptchaInterface
{

    private $font_dir = '';

    public function __construct()
    {
        $this->font_dir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR;
    }

    public function session_write($code)
    {
        session_start();
        
        $_SESSION['captcha_value'] = md5(md5($code));
        $_SESSION['answer_time'] = strtotime(date('d-m-Y H:i:s'));
    }

    public function generate_code()
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $length = rand(4, 6);
        $numChars = strlen($chars);

        $str = '';
        for ($i = 0; $i < $length; $i++)
        {
            $str .= substr($chars, rand(1, $numChars) - 1, 1);
        }

        $array_mix = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
        srand((float) microtime() * 1000000);
        shuffle($array_mix);

        $result = implode("", $array_mix);
        $this->session_write($result);

        return $result;
    }

    public function captcha_image($code)
    {
        $image = imagecreatetruecolor(150, 70);
        imagesetthickness($image, 2);

        $background_color = imagecolorallocate($image, rand(220, 255), rand(220, 255), rand(220, 255));
        imagefill($image, 0, 0, $background_color);

        $linenum = rand(3, 5);
        for ($i = 0; $i < $linenum; $i++)
        {
            $color = imagecolorallocate($image, rand(0, 150), rand(0, 100), rand(0, 150));
            imageline($image, rand(0, 150), rand(1, 70), rand(20, 150), rand(1, 70), $color);
        }

        $font_arr = array_values(array_diff(scandir($this->font_dir), array('.', '..')));
        $font_size = rand(20, 30);
        $x = rand(0, 10);

        for ($i = 0; $i < strlen($code); $i++)
        {
            $x += 20;
            $letter = substr($code, $i, 1);
            $color = imagecolorallocate($image, rand(0, 200), 0, rand(0, 200));
            $current_font = rand(0, sizeof($font_arr) - 1);

            imagettftext($image, $font_size, rand(-10, 10), $x, rand(50, 55), $color, $this->font_dir . $font_arr[$current_font], $letter);
        }

        $pixels = rand(2000, 4000);
        for ($i = 0; $i < $pixels; $i++)
        {
            $color = imagecolorallocate($image, rand(0, 200), rand(0, 200), rand(0, 200));
            imagesetpixel($image, rand(0, 150), rand(0, 150), $color);
        }

        for ($i = 0; $i < $linenum; $i++)
        {
            $color = imagecolorallocate($image, rand(0, 255), rand(0, 200), rand(0, 255));
            imageline($image, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
        }

        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Content-type: image/png");

        imagepng($image);
        imagedestroy($image);
    }
}