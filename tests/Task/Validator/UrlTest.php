<?php

/*
 * This file is part of the MnumiPrint package.
 * 
 * (c) Mnumi Sp. z o.o. <mnumi@mnumi.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Task\Validator;

/**
 * UrlTest unit test
 *
 * @author Piotr Plenik <piotr.plenik@mnumi.com>
 */
class UrlTest extends \PHPUnit_Framework_TestCase
{
    public function testValidate()
    {
        $url = new Url();

        $this->assertTrue($url->validate('http://www.address.com/'));
        $this->assertTrue($url->validate('http://subpage.com/page.html'));

        $this->assertTrue($url->validate(array('http://www.address.com/', 'http://new.pl/')));

        $this->assertFalse($url->validate('www.address.com'));
        $this->assertFalse($url->validate(array('http://www.address.com/', 'new.pl/')));
    }
}
