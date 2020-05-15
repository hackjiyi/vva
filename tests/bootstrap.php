<?php
require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Vva\Auth;

try {
    $bb = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjY3MGM2ZDUxNGE0ZTE2OGM5NDI0NTkwOGY5Mzk2ZjJjZDk3ZWU4OGRhZTk3NDJmMmVmODIzNjNiMWU2YjA2ZTY2ZjRhNTg2Yjc2NGE2MDI1In0.eyJhdWQiOiIyIiwianRpIjoiNjcwYzZkNTE0YTRlMTY4Yzk0MjQ1OTA4ZjkzOTZmMmNkOTdlZTg4ZGFlOTc0MmYyZWY4MjM2M2IxZTZiMDZlNjZmNGE1ODZiNzY0YTYwMjUiLCJpYXQiOjE1ODk0MzcwODYsIm5iZiI6MTU4OTQzNzA4NiwiZXhwIjoxNTg5NTIzNDg2LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.IE67PNMEw-NKSJZeEzYFfKq7SlmqqkemTXtDMEHtHEk0p3lSy_Q8opzVmcIhPZowGSzBWH0qB3hjh7I9nIDpSxuo0h_EmZTsKkU2vpa3EmiKlPMN85My_WKM5bPRxy1Teo54_4FL-WxFpn4GyaTkyrMsE5aGyiepA1nlZHqNNP0I0Wn4sAQiVakZM7yrYcQFPJ-0N2AFpRLmEMoTJqCkUi0_dcyIupVxKJEC8lR8dqGepYBjrT2-X0P1r52QrsahjO_ZMkEcu5S5YXtbva8FLGIRXI5SXqd4GYGUi94oGMR2nYlkdAu_xVatpVn9hjPRq3PuQ3XlUzh-Y_A_ymK7Jfj1brXBfj9iPMg1pcSySy2oTvk-ogAF2B13jEfichDe20kz4Fk-YAUusWe8yLZ1C_BMt0JOJeiq6P2qQaxfoaggD7MromPMZDsZCj81JxKmeNINyo_mq5PItOsxaOQMXbFbfYwXJ0f70UJWUHWnPA4DPTCd6sBONdswX8BodUcLHoqHipXya-f0BCKmEw37kzgOgeQzHz4_NQQyBFEyvifi1V1FulLtJWDtwnHWD7QvYx0HkdPL_LGip5BZs-SneO4qJOI3hXtOQeSNj7U9sgXGO2u4EqK8tCi9L4D6selrmsQehWaGBqtErotz7KRY92v4rdQcpyT_yN1hlHK9Y6g';
    $bb = Auth::validateAuthorization($bb, ['RS256']);
    print_r($bb);
} catch (Exception $e) {
    echo $e->getMessage();
}
return;

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


