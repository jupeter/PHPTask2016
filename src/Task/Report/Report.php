<?php

namespace Task\Report;

/*
 * This file is part of sample Task command package.
 *
 * (c) Piotr Plenik <piotr.plenik@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Report class
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class Report
{
    /** @var ReportItem[] */
    protected $results = false;

    public function add(ReportItem $item)
    {
        $this->results[] = $item;

        return $this;
    }

    public function getResults()
    {
        return $this->results;
    }

    public function getFastest(): ReportItem
    {
        // at begin set as fastest first item
        $fastest = $this->getFirst();

        foreach ($this->results as $row) {
            if ($row->getExecutionTime() < $fastest->getExecutionTime()) {
                $fastest = $row;
            }
        }

        return $fastest;
    }

    /**
     * @return bool|ReportItem
     */
    public function getFirst()
    {
        return (count($this->results) > 0)
            ? $this->results[0]
            : false
        ;
    }
}
