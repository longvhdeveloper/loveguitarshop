<?php
function encryptPassword($password, $salt='loveguitarshop.com')
{
    return md5($password . '@' . $salt);
}

function getIpAddress($convertToInteger = false)
{

    $ip = '';

    if ($_SERVER) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];

        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } else {
            $ip = getenv('remote_addr');
        }
    }

    //Convert IP string to Integer
    //Example, IP: 127.0.0.1 --> 2130706433
    if ($convertToInteger) {
        $ip = ip2long($ip);
    }

    return $ip;
}