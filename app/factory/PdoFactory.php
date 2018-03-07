<?php
/**
 * PdoFactory
 */

namespace App\Factory;

/**
 * Class PdoFactory
 *
 * @package App\Factory
 */
class PdoFactory
{

    /**
     * PDOインスタンスを生成する
     *
     * @return \PDO
     */
    public static function create(): \PDO
    {
        $dbName = getenv('DB_NAME');
        $dns = sprintf('mysql:dbname=%s;host=localhost', $dbName);

        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];

        $pdo = new \PDO(
            $dns,
            getenv('DB_USER'),
            getenv('DB_PASSWORD'),
            $options
        );

        return $pdo;
    }
}
