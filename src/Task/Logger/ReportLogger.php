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

use Task\Report\Report;

/**
 * Render report into logger
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class ReportLogger
{
    public function __construct($name)
    {
        $this->log = new TaskLogger($name);
    }

    public function dump(Report $report)
    {
        $this->log->info('Begin report dump');

        $reportResults = $report->getResults();

        foreach ($reportResults as $result) {
            $this->log->info(
                'Save time for curl website (in milliseconds).',
                array(
                    $result->getUrl(),
                    $result->getExecutionTime(),
                )
            );
        }

        $fastest = $report->getFastest();

        $this->log->info(
            'The fastest URL.',
            array(
                $fastest->getUrl(),
                $result->getExecutionTime(),
            )
        );


        $this->log->info('End report dump');
    }
}
