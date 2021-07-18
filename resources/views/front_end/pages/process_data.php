<?php
    if (empty($_POST['g-recaptcha-response'])) {
        $captcha_error = 'Captcha is required';
    }else {
        $secret_key = "6LdlEmAaAAAAAImuziCo1bAhs_NBUUd8ohMegN4p";
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='
                        .$secret_key.'&response='.$_POST['g-recaptcha-response']);


        $response_data = json_decode($response);

        if (!$response_data->success) {
            $captcha_error = 'Captcha verification failed'    
        }
    }

?>
