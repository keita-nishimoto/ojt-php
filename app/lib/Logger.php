<?php
/**
 * Logger
 */

namespace App\lib;

use Monolog\Handler\StreamHandler;

/**
 * Class Logger
 *
 * @package App\lib
 */
class Logger
{
    /**
     * @var \Monolog\Logger
     */
    private $logger;

    /**
     * Logger constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $loggingPath = __DIR__ . '/../../logs/app.log';
        $this->logger = new \Monolog\Logger('ojt-php');

        $this->logger->pushHandler(
            new StreamHandler($loggingPath, \Monolog\Logger::DEBUG)
        );
    }

    /**
     * デバッグログを出力する
     *
     * @param $var
     */
    public function debug($var)
    {
        $context = [
            'debugValue' => $var,
        ];

        $this->logger->debug('App\lib\Logger:debug', $context);
    }
}
