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
 * ReportItemTest unit test
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class ReportItemTest extends \PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $item = new ReportItem('foo', 12, 21);
        $this->assertEquals('foo', $item->getUrl());
        $this->assertEquals(12, $item->getCurlTotalTime());
        $this->assertEquals(21, $item->getExecutionTime());
    }

    public function testSubtractExecutionTime()
    {
        $firstItem = new ReportItem('foo', 0, 100);
        $secondItem = new ReportItem('bar', 0, 30);
        $thirdItem = new ReportItem('bar', 0, 155);

        $this->assertEquals(70, $secondItem->subtractExecutionTime($firstItem));
        $this->assertEquals(-55, $thirdItem->subtractExecutionTime($firstItem));

    }
}
