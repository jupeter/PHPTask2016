<?php

/*
 * This file is part of sample Task command package.
 * 
 * (c) Piotr Plenik <piotr.plenik@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Task\Report;

/**
 * ReportItem class
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class ReportItem
{
    /**
     * @var string
     */
    private $url;
    /**
     * @var int
     */
    private $curlTotalTime;
    /**
     * @var int
     */
    private $executionTime = false;

    public function __construct(string $url, int $curlTotalTime, int $executionTime)
    {
        $this->url = $url;
        $this->curlTotalTime = $curlTotalTime;
        $this->executionTime = $executionTime;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getCurlTotalTime(): int
    {
        return $this->curlTotalTime;
    }

    /**
     * Subtrack execution time of two ReportItem
     *
     * @param ReportItem $reportItem
     *
     * @return int Greater than 0 when this Reportitem is faster than compared, lower than 0 when slower
     */
    public function subtractExecutionTime(ReportItem $reportItem): int
    {
        return ($reportItem->getExecutionTime() - $this->getExecutionTime());
    }

    public function getExecutionTime(): int
    {
        return $this->executionTime;
    }

    /**
     * Divide execution time of two ReportItems
     * @param ReportItem $reportItem
     * @return float
     */
    public function divideExecutionTime(ReportItem $reportItem): float
    {
        return round(
            ($reportItem->getExecutionTime() / $this->getExecutionTime()),
            2
        );
    }
}
