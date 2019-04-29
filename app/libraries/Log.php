<?php

namespace App\Libraries;

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

class Log
{
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

    public function authLog($message, $attribute, $time_start)
    {
        // create a log channel
        Logger::setTimezone(new \DateTimeZone('Asia/Manila'));
        $this->logger = new Logger('Auth');
        $this->logger->pushHandler(new RotatingFileHandler(__DIR__ . '/../../logs/auth.log', 0, Logger::INFO));

        // End Process time
        $time_elapsed = $this->microtime_diff($time_start);
        $total_time = round($time_elapsed, 4);

        // Add process time attribute
        $attribute['PROCESS_TIME'] = $total_time;

        $this->logger->info($message, $attribute);
    }
}