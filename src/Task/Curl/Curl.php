<?php

namespace Task\Curl;

/*
 * This file is part of sample Task command package.
 * 
 * (c) Piotr Plenik <piotr.plenik@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Task\Logger\ExecutionTimeLoggerTrait;

/**
 * Curl class
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class Curl
{
    use ExecutionTimeLoggerTrait;

    private $response;
    private $totalTime;
    private $httpStatusCode;

    public function __construct()
    {
        if (!extension_loaded('curl')) {
            throw new \ErrorException('cURL library is not loaded');
        }

        $this->curl = curl_init();
        $this->setOption(CURLINFO_HEADER_OUT, true);
        $this->setOption(CURLOPT_HEADER, true);
        $this->setOption(CURLOPT_RETURNTRANSFER, true);
    }

    public function get($url)
    {
        $this->setOption(CURLOPT_URL, $url);
        $this->setOption(CURLOPT_HTTPGET, true);

        $this->execute();
    }

    /**
     * Close connection
     */
    public function close()
    {
        curl_close($this->curl);
    }

    protected function execute()
    {
        $this->startTimeLogger();
        $this->response = curl_exec($this->curl);
        $this->totalTime = curl_getinfo($this->curl, CURLINFO_TOTAL_TIME);
        $this->httpStatusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        $this->stopTimeLogger();
    }

    /**
     * @return int Total time in seconds
     */
    public function getTotalTime(): int
    {
        return $this->totalTime;
    }

    protected function setOption($option, $value)
    {
        return curl_setopt($this->curl, $option, $value);
    }

    /**
     * Get status code
     * @return int
     */
    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }
}
