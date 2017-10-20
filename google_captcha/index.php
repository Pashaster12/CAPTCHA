<html lang="ru">
    <head>
        <title>Google reCAPTCHA noCAPTCHA demo</title>
        <meta charset="utf-8">
		<script src='https://www.google.com/recaptcha/api.js'></script>
    </head>

    <body>
        <form method="post" action="verify_captcha.php">
            <p>
                <b>Введите комментарий:</b>
            </p>

            <p>
                <textarea name="comment" rows="12" cols="21"></textarea>
            </p>

			<div class="g-recaptcha" data-sitekey="ваш_секретный_код_google"></div>
			
            <p>
                <input type="submit" value="Отправить">
            </p>
        </form>
    </body>
</html>