<?php namespace PhpApaTika\PhpApaTika;

/**
 * Class Builder
 *
 * @author      Nii Kunihiro <nii.kunihiro@gmail.com>
 * @copyright   Copyright (c) 2014 Nii Kunihiro
 * @package     PhpApaTika\PhpApaTika
 */
class Builder
{
    /** @var string  */
    protected $file_path;
    /** @var string  */
    private $java;
    /** @var string  */
    private $bin_path;
    /** @var string  */
    private $encoding;
    /** @var string  */
    private $output_type;

    public function __construct()
    {
        $config = include __DIR__ . '/../Config/Builder.php';
        foreach ($config as $key => $val) {
            $this->$key = $val;
        }
    }

    /**
     * @param string $bin_path
     * @return $this
     */
    public function setBinPath($bin_path)
    {
        $this->bin_path = $bin_path;
        return $this;
    }

    /**
     * @param string $encoding
     * @return $this
     */
    public function setEncoding($encoding)
    {
        $this->encoding = "-e'$encoding'";
        return $this;
    }

    /**
     * @param string $output_type
     * @return $this
     */
    public function setOutputType($output_type)
    {
        $this->output_type = $output_type;
        return $this;
    }

    /**
     * @param string $file_path
     * @return $this
     */
    public function setFilePath($file_path)
    {
        $this->file_path = $file_path;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommand()
    {
        return sprintf('%s -jar %s %s %s %s',
            $this->java,
            $this->bin_path,
            $this->encoding,
            $this->output_type,
            $this->file_path
        );
    }
}
