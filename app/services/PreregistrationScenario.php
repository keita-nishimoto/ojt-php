<?php
/**
 * PreregistrationScenario
 * 仮ユーザー登録のシナリオ
 */

namespace App\Services;

use App\Models\Domain\PreregistrationValueBuilder;
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
     * @var PreregistrationRepository
     */
    private $preregistrationRepository;

    /**
     * PreregistrationScenario constructor.
     *
     * @param PreregistrationRepository $preregistrationRepository
     */
    public function __construct(PreregistrationRepository $preregistrationRepository)
    {
        $this->preregistrationRepository = $preregistrationRepository;
    }

    /**
     * 仮ユーザー登録を行う
     *
     * @param array $params
     * @return \App\Models\Domain\Preregistration
     * @throws \Exception
     */
    public function preregistration(array $params)
    {
        $uuid4 = Uuid::uuid4();
        $expiredOn = new \DateTime();
        $expiredOn->add(new \DateInterval('P1D'));

        $builder = new PreregistrationValueBuilder();
        $builder->setToken($uuid4->toString());
        $builder->setExpiredOn($expiredOn);
        $builder->setEmail($params['email']);

        $preregistrationValue = $builder->build();

        return $this->preregistrationRepository->createToken($preregistrationValue);
    }
}
