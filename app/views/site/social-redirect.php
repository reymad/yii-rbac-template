<?php
/**
 * Created by PhpStorm.
 * Date: 01/10/2015
 * Time: 17:53
 */

/* @var $this \yii\web\View */
/* @var $userAttributes array */
/* @var $client string */

use yii\helpers\Json;

if (!$client) die();
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            if (window.opener && !window.opener.closed) {
                var body = window.opener.$("body");
                window.opener.social_login = <?= json_encode(['client' => $client, 'userData' => $userAttributes]) ?>;
                body.trigger('login:<?=$client?>:ok');
            }
            window.close();
        });
    </script>
</head>
<body>

</body>
</html>
