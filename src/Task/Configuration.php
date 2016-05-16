<?php

namespace Task;

/*
 * This file is part of sample Task command package.
 * 
 * (c) Piotr Plenik <piotr.plenik@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Configuration class
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class Configuration
{
    private static $instance;

    private $config;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Configuration();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $iniFile = getcwd().'/config/app.ini';
        $this->config = parse_ini_file($iniFile);
    }

    public function getLogFilename()
    {
        return getcwd().$this->config["logFilename"];
    }

    public function getEmailFrom()
    {
        return $this->config['emailFrom'];
    }
    public function getEmailTo()
    {
        return $this->config['emailTo'];
    }
    public function getSmtpHost()
    {
        return $this->config['smtpHost'];
    }
    public function getSmtpPort()
    {
        return $this->config['smtpPort'];
    }
    public function getSmtpUsername()
    {
        return $this->config['smtpUsername'];
    }
    public function getSmtpPassword()
    {
        return $this->config['smtpPassword'];
    }
    public function getSmsTo()
    {
        return $this->config['smsTo'];
    }
}
