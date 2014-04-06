<?php namespace Tests;

require_once __DIR__ . '/../PhpApaTika/PhpApaTika.php';

use PhpApaTika\PhpApaTika;

/**
 * Class PhpApaTikaTest
 *
 * @author      Nii Kunihiro <nii.kunihiro@gmail.com>
 * @copyright   Copyright (c) 2014 Nii Kunihiro
 * @package     Tests
 */
class PhpApaTikaTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PhpApaTika\PhpApaTika  */
    private $PhpApaTika;
    /** @var string  */
    private $target;

    public function setUp()
    {
        $this->PhpApaTika = new PhpApaTika;
        $this->target = __DIR__ . '/sample/test.txt';
    }

    /**
     * @test
     */
    function getText()
    {
        $expected = 'Apache Tika - a content analysis toolkit';
        $text = $this->PhpApaTika->from($this->target)->getText();
        $this->assertEquals($expected, trim($text));
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    function setTimeoutGetText()
    {
        $this->PhpApaTika->setTimeout(1);
        $this->PhpApaTika->from(__DIR__ . '/sample/test.pdf')->getText();
    }

    /**
     * @test
     */
    function getJson()
    {
        $json = $this->PhpApaTika->from($this->target)->getJson();
        $decoded_json = json_decode($json, true);
        $this->assertTrue(strpos($decoded_json['Content-Type'], 'text/plain') !== false);
    }

    /**
     * @test
     */
    function allThrough()
    {
        $expected = 'Apache Tika - a content analysis toolkit';
        $text = $this->PhpApaTika->from($this->target)
            ->binary(__DIR__ . '/../vendor/bin/tika-app-1.5.jar')
            ->encoding('UTF-8')
            ->getText();
        $this->assertEquals($expected, trim($text));
    }
}
 