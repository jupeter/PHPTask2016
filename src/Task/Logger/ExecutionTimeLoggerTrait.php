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

/**
 * RuntimeLoggerTriat class
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
trait ExecutionTimeLoggerTrait
{
    private $startTime;
    private $stopTime;

    /**
     * Start time logging
     *
     * @return $this
     */
    protected function startTimeLogger()
    {
        list($usec, $sec) = explode(" ", microtime());

        $this->startTime = (float)$usec + (float)$sec;

        return $this;
    }

    /**
     * Stop time logging
     *
     * @return $this
     */
    protected function stopTimeLogger()
    {
        list($usec, $sec) = explode(" ", microtime());

        $this->stopTime = (float)$usec + (float)$sec;

        return $this;
    }

    /**
     * Get logged time
     *
     * @return int The milliseconds of logged time
     *
     * @throws \Exception Throw when logger does not start or does not stop
     */
    public function getExecutionTime(): int
    {
        if (!$this->startTime) {
            throw new \Exception('Missing start time.');
        }

        if (!$this->stopTime) {
            throw new \Exception('Missing stop time.');
        }

        $result = ($this->stopTime - $this->startTime) * 1000;

        return $result;
    }
}
