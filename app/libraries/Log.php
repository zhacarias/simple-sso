<?php

namespace App\Libraries;

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

class Log
{
    public function __construct()
    {
        Logger::setTimezone(new \DateTimeZone('Asia/Manila'));
    }

    private function microtime_diff($start, $end = null)
    {
        if (!$end) {
            $end = microtime();
        }

        list($start_usec, $start_sec) = explode(" ", $start);
        list($end_usec, $end_sec) = explode(" ", $end);

        $diff_sec = intval($end_sec) - intval($start_sec);
        $diff_usec = floatval($end_usec) - floatval($start_usec);

        return floatval($diff_sec) + $diff_usec;
    }

    public function authLog($message, $attribute = [], $time_start)
    {
        // create a log channel
        $this->logger = new Logger('Auth');
        $this->logger->pushHandler(new RotatingFileHandler(__DIR__ . '/../../logs/auth.log', 0, Logger::INFO));

        // End Process time
        $time_elapsed = $this->microtime_diff($time_start);
        $total_time = round($time_elapsed, 4);

        // Add process time attribute
        $attribute['RUNTIME'] = $total_time;

        $this->logger->info($message, $attribute);
    }

    public function ldapLog($message, $attribute = [], $time_start)
    {
        // create a log channel
        $this->logger = new Logger('Ldap');
        $this->logger->pushHandler(new RotatingFileHandler(__DIR__ . '/../../logs/ldap.log', 0, Logger::INFO));

        // End Process time
        $time_elapsed = $this->microtime_diff($time_start);
        $total_time = round($time_elapsed, 4);

        // Add process time attribute
        $attribute['RUNTIME'] = $total_time;

        $this->logger->info($message, $attribute);
    }

    public function dbLog($message, $attribute = [])
    {
        // create a log channel
        $this->logger = new Logger('Database');
        $this->logger->pushHandler(new RotatingFileHandler(__DIR__ . '/../../logs/db.log', 0, Logger::ERROR));

        $this->logger->error($message, $attribute);
    }
}