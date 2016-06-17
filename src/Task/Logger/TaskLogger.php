<?php

/*
 * This file is part of sample Task command package.
 * 
 * (c) Piotr Plenik <piotr.plenik@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Task\Logger;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Logger class
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class TaskLogger
{
    public function __construct($name)
    {
        $this->log = new Logger($name);
        $this->log->pushHandler(
            new StreamHandler($this->getLogFilename(), Logger::INFO)
        );
    }

    public function info($message, array $context = array())
    {
        $this->log->info($message, $context);
    }

    protected function getLogFilename(): string
    {
        return getcwd().'/log/log.txt';
    }
}
