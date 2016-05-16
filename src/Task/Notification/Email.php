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
 * Email class
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class Email implements NotificationInterface
{
    public function __construct()
    {
        $config = Configuration::getInstance();

        $transport = \Swift_SmtpTransport::newInstance($config->getSmtpHost(), $config->getSmtpPort())
            ->setUsername($config->getSmtpUsername())
            ->setPassword($config->getSmtpPort())
        ;

        $this->mailer = \Swift_Mailer::newInstance($transport);

        $this->emailFrom = $config->getEmailFrom();
        $this->emailTo = $config->getEmailTo();
    }

    /**
     * @param string $subject
     * @param string $message
     * @return bool True if send successfully
     */
    public function send(string $subject, string $message): bool
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($this->emailFrom)
            ->setTo($this->emailTo)
            ->setBody($message)
        ;

        $result = $this->mailer->send($message);

        return $result;
    }
}
