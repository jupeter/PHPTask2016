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

use Task\Report\Report;
use Task\Report\ReportItem;

/**
 * Crawl class
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class Crawl
{
    private $report;

    public function __construct()
    {
        $this->report = new Report();
    }

    /**
     * @param string $url
     *
     * @return bool True if crawl successfully
     */
    public function crawlUrl(string $url)
    {
        $runtime = new MeasureRuntime();
        if ($runtime->execute($url) === true) {
            $item = new ReportItem(
                $url,
                $runtime->getCurlTotalTime(),
                $runtime->getExecuteTime()
            );

            $this->report->add($item);

            return true;
        }

        return false;
    }

    /**
     * @return Report
     */
    public function getReport()
    {
        return $this->report;
    }
}
