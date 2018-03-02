<?php
/**
 * DbTestCase
 */

namespace Tests;

use Dotenv\Dotenv;
use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class DbTestCase
 *
 * @package Tests
 */
class DbTestCase extends TestCase
{
    use TestCaseTrait;

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @return \PHPUnit\DbUnit\Database\DefaultConnection
     */
    public function getConnection()
    {
        $dotenv = new Dotenv(__DIR__ . '/../');
        $dotenv->load();

        $dbName = getenv('TEST_DB_NAME');
        $dns = sprintf('mysql:dbname=%s;host=localhost', $dbName);

        $pdo = new \PDO(
            $dns,
            getenv('TEST_DB_USER'),
            getenv('TEST_DB_PASSWORD')
        );

        $this->pdo = $pdo;

        return $this->createDefaultDBConnection($pdo);
    }

    /**
     * 継承元のクラスで必ずオーバーライドする事
     */
    public function getDataSet()
    {
    }

    /**
     * @return \PDO
     */
    protected function getPdo()
    {
        return $this->pdo;
    }
}
