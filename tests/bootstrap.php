<?php
require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Vva\Auth;

$key = "example_key";
$payload = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

$secret_key = '1234567890';
echo Auth::getSignWithData(array('11111' => 2222, 'color' => 'red', 'above' => true), $secret_key);
echo "\r\n";
echo Auth::jwtEncode($payload, $key);
//echo $auth->getSignWithData(array('11111' => 2222, 'color' => 'red', 'above' => true));
//echo "\r\n";
//
//echo $auth->getSignWithData(array('11111' => 2222, 'color' => 'red', 'above' => true));


