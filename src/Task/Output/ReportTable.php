<?php

/*
 * This file is part of sample Task command package.
 * 
 * (c) Piotr Plenik <piotr.plenik@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Task\Output;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;
use Task\Report\Report;

/**
 * Render report into Console Output
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class ReportTable
{
    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(OutputInterface $outputInterface)
    {
        $this->output = $outputInterface;
    }

    public function render(Report $report)
    {
        $table = new Table($this->output);
        $table
            ->setHeaders($this->getHeaders())
            ->setRows($this->getRows($report));

        $table->render();
    }

    /**
     * Get Headers report
     *
     * @return array
     */
    protected function getHeaders(): array
    {
        return array(
            '#',
            'URL',
            'Execution time',
            'Notice',
        );
    }

    /**
     * Get Rows
     *
     * @param  Report $report
     * @return array
     */
    protected function getRows(Report $report): array
    {
        $reportResults = $report->getResults();
        $first = $report->getFirst();

        $i = 1;
        $results = array();
        foreach ($reportResults as $result) {
            $row = array(
                '#'.$i,
                $result->getUrl(),
                $result->getExecutionTime() . ' ms',
            );

            if ($i > 1) {
                $diffTime = $result->subtractExecutionTime($first);

                if ($diffTime === 0) {
                    $value = '-';
                } elseif ($diffTime > 0) {
                    $value = $diffTime . ' ms faster than site #1';
                } else {
                    $value = abs($diffTime) . ' ms slower than site #1';
                }

                $row[] = $value;
            }

            $results[] = $row;
            $i++;
        }

        return $results;
    }
}
