<?php
namespace Logging;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

class Logger extends AbstractLogger
{
    private $defaultLogPath;

    public function __construct($defaultLogPath = '')
    {
        global $LOG_ACCESS;
        if (!empty($defaultLogPath)) {
            $this->defaultLogPath = $defaultLogPath;
        } else {
            $this->defaultLogPath = $LOG_ACCESS;
        }
    }

    /**
     * Logs a simple message for AFTS, using one of the defined subsystems
     *
     * @param string $message Message to log with optional placeholders
     * @param string $subsystem Default general
     * @param array $context
     */
    static function logSystem($message, $subsystem = 'general')
    {
        $context['subsystem'] = $subsystem;
        $context['message'] = $message;
        if (isset($_SESSION['username_session'])) {
            $username = $_SESSION['username_session'];
        } else {
            $username = 'unknown_user';
        }
        $context['username'] = $username;
        $msgFormat = "{subsystem} {username} {message}";
        $l = new Logger();
        $msg = $l->interpolate($msgFormat, $context);
        $l->log(LogLevel::INFO, $msg, $context);
    }

    /**
     * Interpolates context values into the message placeholders.
     */
    private function interpolate($message, array $context = array())
    {
        // build a replacement array with braces around the context keys
        $replace = array();
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }

        // interpolate replacement values into the message and return
        return strtr($message, $replace);
    }

    /**
     * Logs a message
     * @param mixed $level Use Psr\Log\LogLevel constants
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        $context['datetime'] = date(DATE_W3C);
        $context['message'] = str_replace("\n",'',$message);
        $context['ip'] = $_SERVER['REMOTE_ADDR'];
        $msg = "{datetime} {ip} {message}";
        $log_line = $this->interpolate($msg, $context) . PHP_EOL;
        @file_put_contents($this->defaultLogPath, $log_line, FILE_APPEND);
    }


}
