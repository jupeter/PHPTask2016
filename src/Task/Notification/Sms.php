<?php

namespace Task\Notification;

/*
 * This file is part of sample Task command package.
 * 
 * (c) Piotr Plenik <piotr.plenik@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Task\Configuration;

/**
 * Sms class
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class Sms implements NotificationInterface
{
    private $smsTo;

    public function __construct()
    {
        $config = Configuration::getInstance();
        $this->smsTo = $config->getSmsTo();
    }

    public function send(string $subject, string $message): bool
    {
        $message = sprintf('[%s] %s', $subject, $message);

        /* Mock up class */
        return true;
    }
}
