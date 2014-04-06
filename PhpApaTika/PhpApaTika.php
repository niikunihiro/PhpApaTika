<?php namespace PhpApaTika;

require_once __DIR__ . '/PhpApaTika/PhpApaTika.php';
require_once __DIR__ . '/PhpApaTika/Builder.php';

use \SplFileInfo;

/**
 * Class PhpApaTika
 *
 * @author      Nii Kunihiro <nii.kunihiro@gmail.com>
 * @copyright   Copyright (c) 2014 Nii Kunihiro
 * @package     PhpApaTika
 */
class PhpApaTika extends PhpApaTika\PhpApaTika
{
    /** @var   */
    public $file_info;

    public function __construct()
    {
        parent::__construct(new PhpApaTika\Builder);
    }

    /**
     * @param $path
     * @return $this
     */
    public function from($path)
    {
        $this->file_info = new SplFileInfo($path);
        $this->builder->setFilePath($this->file_info->getRealPath());
        return $this;
    }

    /**
     * @param $bin_path
     * @return $this
     */
    public function binary($bin_path)
    {
        $this->builder->setBinPath($bin_path);
        return $this;
    }

    /**
     * @param $encoding
     * @return $this
     */
    public function encoding($encoding)
    {
        $this->builder->setEncoding($encoding);
        return $this;
    }
} 