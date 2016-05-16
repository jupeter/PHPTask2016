<?php

/*
 * This file is part of sample Task command package.
 * 
 * (c) Piotr Plenik <piotr.plenik@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Task\Crawler;

use Task\Curl\Curl;
use Task\Logger\ExecutionTimeLoggerTrait;

/**
 * Request class
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class MeasureRuntime
{
    /** @var Curl */
    protected $curl;
    protected $executionTime;
    protected $curlTotalTime;

    /**
     * @param string $url
     *
     * @throws \Exception
     *
     * @return bool True if executed successfully
     */
    public function execute($url): bool
    {
        $curl = new Curl();
        $curl->get($url);
        $this->executionTime = $curl->getExecutionTime();
        $this->curlTotalTime = $curl->getTotalTime();
        $curl->close();

        return ($curl->getHttpStatusCode() === 200);
    }

    /**
     * @return int Get time in seconds returned by curl action
     */
    public function getCurlTotalTime(): int
    {
        return $this->curlTotalTime;
    }

    /**
     * @return int The time in milliseconds
     *
     * @throws \Exception
     */
    public function getExecuteTime(): int
    {
        return $this->executionTime;
    }
}
