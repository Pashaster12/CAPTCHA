<html lang="ru">
    <head>
        <title>Графическая CAPTCHA demo</title>
        <meta charset="utf-8">
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>

    <body>
        <form action="/verify_captcha.php" method="post" enctype="multipart/form-data">
            <p>
                <b>Введите комментарий:</b>
            </p>

            <p>
                <textarea name="comment" rows="12" cols="21"></textarea>
            </p>

            <p>
                <img src='/captcha.php' id='capcha-image'>

                <a href="javascript:void(0);" onclick="document.getElementById('capcha-image').src = 'captcha.php?rid=' + Math.random();">
                    Обновить капчу
                </a>
            </p>

            <p>
                <span>Введите капчу:</span>
                <input type="text" name="code_captcha">
            </p>

            <p>
                <input type="submit" name="submit_form" value="Продолжить">
            </p>
        </form>
    </body>
</html>