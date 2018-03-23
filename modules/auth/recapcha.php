<?php
define('PUBLIC_KEY',  '6Lc9ByAUAAAAAKOlFnpa91fVuvltXVZYkBUVBOVD');
define('PRIVATE_KEY', '6Lc9ByAUAAAAAM6s0I4ayjcJmeL9T8ymR1nz2KAL');

require_once('recaptchalib.php');
$resp = recaptcha_check_answer(PRIVATE_KEY,
                                $_SERVER['REMOTE_ADDR'],
                                $_POST['recaptcha_challenge_field'],
                                $_POST['recaptcha_response_field']
                            );
echo json_encode(array(
    'valid' => $resp->is_valid,
));

