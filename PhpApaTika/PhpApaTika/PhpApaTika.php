<?php namespace PhpApaTika\PhpApaTika;

use \Symfony\Component\Process\Process;

/**
 * Class PhpApaTika
 *
 * @author      Nii Kunihiro <nii.kunihiro@gmail.com>
 * @copyright   Copyright (c) 2014 Nii Kunihiro
 * @package     PhpApaTika\PhpApaTika
 */
class PhpApaTika
{
    /** @var \PhpApaTika\PhpApaTika\Builder  */
    protected $builder;
    /** @var int プロセスがタイムアウトする秒数 */
    protected $timeout = 300;

    /**
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @return string
     * @throws \RuntimeException
     */
    private function execute()
    {
        $process = new Process($this->builder->getCommand());
        $process->setTimeout($this->timeout);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
        return $process->getOutput();
    }

    /**
     * @return string
     */
    public function getText()
    {
        $this->builder->setOutputType('--text');
        return $this->execute();
    }

    /**
     * @return string
     */
    public function getTextMain()
    {
        $this->builder->setOutputType('--text-main');
        return $this->execute();
    }

    /**
     * @return string
     */
    public function getJson()
    {
        $this->builder->setOutputType('--json');
        return $this->execute();
    }

    /**
     * @return string
     */
    public function getMetadata()
    {
        $this->builder->setOutputType('--metadata');
        return $this->execute();
    }

    /**
     * @return string
     */
    public function getXml()
    {
        $this->builder->setOutputType('--xml');
        return $this->execute();
    }

    /**
     * @param int $timeout
     * @throws \InvalidArgumentException
     */
    public function setTimeout($timeout)
    {
        if (!is_int($timeout)) {
            throw new \InvalidArgumentException;
        }
        $this->timeout = $timeout;
    }
}
