<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/PhpApaTika.php';

$text = (new PhpApaTika\PhpApaTika)->from(__DIR__ . '/../Tests/sample/test.pdf')
    ->binary(__DIR__ . '/../vendor/bin/tika-app-1.5.jar')
    ->getText();

var_dump($text);
//file_put_contents(__DIR__ . '/../stdout.txt', $text);

try {
    $ApaTika = new PhpApaTika\PhpApaTika;
    $ApaTika->setTimeout(1);
    $text = $ApaTika->from(__DIR__ . '/../Tests/sample/test.pdf')->getJson();
} catch (RuntimeException $e) {
    var_dump($e->getMessage());
    exit;
}
