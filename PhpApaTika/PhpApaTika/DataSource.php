<?php namespace PhpApaTika\PhpApaTika;

/**
 * Class DataSource
 *
 * @author      Nii Kunihiro <nii.kunihiro@gmail.com>
 * @copyright   Copyright (c) 2014 Nii Kunihiro
 * @package     PhpApaTika\PhpApaTika
 */
class DataSource
{
    /** @var \SplFileInfo  */
    public $splFileInfo;

    /**
     * @param \SplFileInfo $splFileInfo
     */
    public function __construct(\SplFileInfo $splFileInfo)
    {
        $this->splFileInfo = $splFileInfo;
    }
} 