<?php namespace Tests\PhpApaTika;

require_once __DIR__ . '/../../PhpApaTika/PhpApaTika/DataSource.php';

use PhpApaTika\PhpApaTika\DataSource;

/**
 * Class DataSourceTest
 *
 * @author      Nii Kunihiro <nii.kunihiro@gmail.com>
 * @copyright   Copyright (c) 2014 Nii Kunihiro
 * @package     Tests\PhpApaTika
 */
class DataSourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    function isSplFileInfoInstance()
    {
        $object = new DataSource(new \SplFileInfo(__FILE__));
        $this->assertInstanceOf('SplFileInfo', $object->splFileInfo);
    }
}
 