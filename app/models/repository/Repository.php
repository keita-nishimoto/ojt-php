<?php
/**
 * Repository
 */

namespace App\Models\Repository;

/**
 * Class Repository
 *
 * @package App\Models\Repository
 */
abstract class Repository
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * Repository constructor.
     *
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return \PDO
     */
    public final function getPdo(): \PDO
    {
        return $this->pdo;
    }
}
