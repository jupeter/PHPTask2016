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

/**
 * NotificationInterface interface
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 *
 * @codeCoverageIgnore
 */
interface NotificationInterface
{
    /**
     * @param string $subject
     * @param string $message
     * @return bool True if send successfully
     */
    public function send(string $subject, string $message): bool;
}
