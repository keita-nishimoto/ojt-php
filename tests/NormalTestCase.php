<?php
/**
 * NormalTestCase
 * DBを使わない通常のテストケースはこちらを継承して作成する
 */

namespace Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

/**
 * Class NormalTestCase
 *
 * @package Tests
 */
class NormalTestCase extends TestCase
{

    /**
     * 継承元でも必ずこの処理を呼び出す事
     */
    protected function setUp()
    {
        $dotenv = new Dotenv(__DIR__ . '/../');
        $dotenv->load();
    }
}
