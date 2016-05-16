<?php

namespace Task\Report;

/**
 * This file is part of sample task command package.
 *
 * (c) Piotr Plenik <piotr.plenik@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * ReportTest unit test
 *
 * @author Piotr Plenik <piotr.plenik@mnumi.com>
 */
class ReportTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $report = new Report();
        $this->assertEmpty($report->getResults());

        $item = new ReportItem('foo', 1, 2);

        $report->add($item);

        $this->assertEquals(array($item), $report->getResults());
    }

    public function testGetFirst()
    {
        $report = new Report();
        $item = new ReportItem('foo', 1, 2);
        $report->add($item);

        $this->assertEquals($item, $report->getFirst());
    }

    public function testGetFastest()
    {
        $report = new Report();
        $item = new ReportItem('foo', 1, 5);
        $report->add($item);

        $this->assertEquals($item, $report->getFastest());

        $fasterItem = new ReportItem('bar', 1, 3);
        $report->add($fasterItem);

        $this->assertEquals($fasterItem, $report->getFastest());

        $slowerItem = new ReportItem('baz', 1, 4);
        $report->add($slowerItem);

        $this->assertEquals($fasterItem, $report->getFastest());

    }
}
