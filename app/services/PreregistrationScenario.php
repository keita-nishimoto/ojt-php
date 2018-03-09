<?php
/**
 * PreregistrationScenario
 * 仮ユーザー登録のシナリオ
 */

namespace App\Services;

use App\Models\Domain\Preregistration\PreregistrationEntity;
use App\Models\Domain\Preregistration\PreregistrationValueBuilder;
use App\Models\Repository\PreregistrationRepository;
use Ramsey\Uuid\Uuid;

/**
 * Class PreregistrationScenario
 *
 * @package App\Models\Domain
 */
class PreregistrationScenario
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var PreregistrationRepository
     */
    private $preregistrationRepository;

    /**
     * PreregistrationScenario constructor.
     *
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->preregistrationRepository = new PreregistrationRepository($this->pdo);
    }

    /**
     * 仮ユーザー登録を行う
     *
     * @param array $params
     * @return PreregistrationEntity
     * @throws \Exception
     */
    public function preregistration(array $params): PreregistrationEntity
    {
        try {
            $this->pdo->beginTransaction();

            $uuid4 = Uuid::uuid4();
            $expiredOn = new \DateTime();
            $expiredOn->add(new \DateInterval('P1D'));

            $builder = new PreregistrationValueBuilder();
            $builder->setToken($uuid4->toString());
            $builder->setExpiredOn($expiredOn);
            $builder->setEmail($params['email']);

            $preregistrationValue = $builder->build();
            $preregistrationEntity = $this->preregistrationRepository->createToken($preregistrationValue);

            $this->pdo->commit();

            return $preregistrationEntity;
        } catch (\PDOException $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            throw $e;
        }
    }
}
