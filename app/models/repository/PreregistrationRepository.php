<?php
/**
 * PreregistrationRepository
 */

namespace App\Models\Repository;

/**
 * Class PreregistrationRepository
 *
 * @package App\Models\Repository
 */
class PreregistrationRepository
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * PreregistrationRepository constructor.
     *
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * トークンを作成する
     * TODO 仮実装
     *
     * @return bool
     */
    public function createToken()
    {
        $sql = 'INSERT INTO preregistrations (is_registered) VALUES (0)';

        $statement = $this->pdo->prepare($sql);

        return $statement->execute();
    }
}
