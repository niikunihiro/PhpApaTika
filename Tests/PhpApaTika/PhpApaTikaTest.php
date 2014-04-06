<?php namespace Tests\PhpApaTika;

require_once __DIR__ . '/../../PhpApaTika/PhpApaTika/PhpApaTika.php';

use Mockery as m;
use PhpApaTika\PhpApaTika\PhpApaTika;

/**
 * Class PhpApaTikaTest
 *
 * @author      Nii Kunihiro <nii.kunihiro@gmail.com>
 * @copyright   Copyright (c) 2014 Nii Kunihiro
 * @package     Tests\PhpApaTika
 */
class PhpApaTikaTest extends \PHPUnit_Framework_TestCase
{
    private $BuilderMock;

    public function setUp()
    {
        $this->BuilderMock = m::mock('PhpApaTika\PhpApaTika\Builder');
        $this->BuilderMock
            ->shouldReceive('setOutputType', 'setFilePath', 'getCommand')
            ->andReturn("cat Tests/sample/test.txt");
    }

    /**
     * @test
     */
    function catCommandGetText()
    {
        $PhpApaTika = new PhpApaTika($this->BuilderMock);
        $actual = $PhpApaTika->getText();
        $this->assertEquals('Apache Tika - a content analysis toolkit', $actual);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    function thrownInvalidArgumentException()
    {
        $PhpApaTika = new PhpApaTika($this->BuilderMock);
        $PhpApaTika->setTimeout('300');
    }

    public function tearDown()
    {
        m::close();
    }
}
