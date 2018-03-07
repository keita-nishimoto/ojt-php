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
        $this->pdo = $this->createPdo();

        return $this->createDefaultDBConnection($this->pdo);
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

    /**
     * テスト用のPDOオブジェクトを生成する
     *
     * @return \PDO
     */
    private function createPdo()
    {
        $dotenv = new Dotenv(__DIR__ . '/../');
        $dotenv->load();

        $dbName = getenv('TEST_DB_NAME');
        $dns = sprintf('mysql:dbname=%s;host=localhost', $dbName);

        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];

        $pdo = new \PDO(
            $dns,
            getenv('TEST_DB_USER'),
            getenv('TEST_DB_PASSWORD'),
            $options
        );

        return $pdo;
    }
}
