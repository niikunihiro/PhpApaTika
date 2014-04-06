<?php namespace Tests\PhpApaTika;

require_once __DIR__ . '/../../PhpApaTika/PhpApaTika/Builder.php';

use PhpApaTika\PhpApaTika\Builder;

/**
 * Class BuilderTest
 *
 * @author      Nii Kunihiro <nii.kunihiro@gmail.com>
 * @copyright   Copyright (c) 2014 Nii Kunihiro
 * @package     Tests\PhpApaTika
 */
class BuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PhpApaTika\PhpApaTika\Builder  */
    private $Builder;

    private $config;
    /**
     *
     */
    public function setUp()
    {
        $this->Builder = (new Builder)->setFilePath(__FILE__);
        $this->config = include __DIR__ . '/../../PhpApaTika/Config/Builder.php';
    }

    /**
     * @test
     */
    function normalGetCommand()
    {
        $expected = sprintf(
            "%s -jar %s %s %s " . __FILE__,
            $this->config['java'],
            $this->config['bin_path'],
            $this->config['encoding'],
            $this->config['output_type']
        );
        $actual = $this->Builder->getCommand();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    function setBinPathChainGetCommand()
    {
        $bin_path = '/vendor/bin/tika-app-1.5.jar';
        $expected = sprintf(
            "%s -jar %s %s %s " . __FILE__,
            $this->config['java'],
            $bin_path,
            $this->config['encoding'],
            $this->config['output_type']
        );
        $actual = $this->Builder->setBinPath($bin_path)->getCommand();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    function setEncodingChainGetCommand()
    {
        $encoding = 'sjis-win';
        $expected = sprintf(
            "%s -jar %s %s %s " . __FILE__,
            $this->config['java'],
            $this->config['bin_path'],
            "-e'$encoding'",
            $this->config['output_type']
        );
        $actual = $this->Builder->setEncoding($encoding)->getCommand();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    function setOutputTypeChainGetCommand()
    {
        $output_type = '--xml';
        $expected = sprintf(
            "%s -jar %s %s %s " . __FILE__,
            $this->config['java'],
            $this->config['bin_path'],
            $this->config['encoding'],
            $output_type
        );
        $actual = $this->Builder->setOutputType($output_type)->getCommand();
        $this->assertEquals($expected, $actual);
    }
}
