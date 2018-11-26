<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-11-16
 * Time: 上午10:33
 */

namespace App\Handlers;


use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class LogHandler
{
    // 日志记录引擎列表，单例
    protected $loggers = [];
    protected $default_logger = 'klinson';

    protected static $instance;
    protected function __construct()
    {
    }
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取记录日志引擎
     * @param null $logger
     * @author klinson <klinson@163.com>
     * @return mixed|\Monolog\Logger
     */
    public static function getLogger($logger = null)
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        if (blank($logger)) {
            $logger = self::$instance->default_logger;
        }

        if (! isset(self::$instance->loggers[$logger])) {
            $log_path = storage_path("logs/{$logger}-log") . "/{$logger}.log";
            self::$instance->loggers[$logger] = new Logger($logger);

            self::$instance->loggers[$logger]->pushHandler(new RotatingFileHandler($log_path));
        }

        return self::$instance->loggers[$logger];
    }

    /**
     * 多日志项转换单日志
     * @param $logs
     * @author klinson <klinson@163.com>
     * @return string
     */
    protected function logs2log($logs)
    {
        $array = array_map(function ($log) {
            switch (gettype($log)) {
                case 'object':
                    return serialize($log);
                    break;
                case 'array':
                    return json_encode($log, JSON_UNESCAPED_UNICODE);
                    break;
                default:
                    return $log;
                    break;
            }
        }, $logs);

        return implode(', ', $array);
    }

    /**
     * 特别标记日志
     * @param $logger
     * @param array ...$logs
     * @author klinson <klinson@163.com>
     */
    public static function log($logger, $mark, ...$logs)
    {
        $log = self::getInstance()->logs2log($logs);
        self::getLogger($logger)->info('['.$mark.']: ' . $log);
    }

    public static function info($logger, ...$logs)
    {
        $log = self::getInstance()->logs2log($logs);
        self::getLogger($logger)->info($log);
    }

    public static function debug($logger, ...$logs)
    {
        $log = self::getInstance()->logs2log($logs);
        self::getLogger($logger)->debug($log);
    }

    public static function notice($logger, ...$logs)
    {
        $log = self::getInstance()->logs2log($logs);
        self::getLogger($logger)->notice($log);
    }

    public static function warning($logger, ...$logs)
    {
        $log = self::getInstance()->logs2log($logs);
        self::getLogger($logger)->warning($log);
    }

    public static function error($logger, ...$logs)
    {
        $log = self::getInstance()->logs2log($logs);
        self::getLogger($logger)->error($log);
    }

    public static function critical($logger, ...$logs)
    {
        $log = self::getInstance()->logs2log($logs);
        self::getLogger($logger)->critical($log);
    }

    public static function alert($logger, ...$logs)
    {
        $log = self::getInstance()->logs2log($logs);
        self::getLogger($logger)->alert($log);
    }

    public static function emergency($logger, ...$logs)
    {
        $log = self::getInstance()->logs2log($logs);
        self::getLogger($logger)->emergency($log);
    }

}