<?php
/**
 * Logger
 */

namespace App\Lib;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;

/**
 * Class Logger
 *
 * @package App\Lib
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
        $stream = new StreamHandler($loggingPath, \Monolog\Logger::DEBUG);
        $formatter = new LineFormatter(null, null, true);
        $stream->setFormatter($formatter);

        $this->logger = new \Monolog\Logger('ojt-php');

        $this->logger->pushHandler($stream);
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

        if (is_object($var)) {
            $context = [
                'debugValue' => $this->varDump($var),
            ];
        }

        $this->logger->debug('App\Lib\Logger:debug', $context);
    }

    /**
     * var_dumpの出力を文字列として取得する
     *
     * @param $var
     * @return string
     */
    private function varDump($var)
    {
        ob_start();
        var_dump($var);
        $result = ob_get_contents();
        ob_end_clean();
        return strip_tags($result);
    }
}
