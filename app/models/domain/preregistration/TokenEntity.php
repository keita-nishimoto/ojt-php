<?php
/**
 * TokenEntity
 */

namespace App\Models\Domain\Preregistration;

/**
 * Class TokenEntity
 *
 * @package App\Models\Domain\Preregistration
 */
class TokenEntity
{
    /**
     * 識別子
     *
     * @var int
     */
    private $id;

    /**
     * トークン
     *
     * @var string
     */
    private $token;

    /**
     * 有効期限切れになる日時
     *
     * @var \DateTime
     */
    private $expiredOn;

    /**
     * バージョン
     *
     * @var int
     */
    private $lockVersion;

    /**
     * TokenEntity constructor.
     *
     * @param TokenEntityBuilder $builder
     */
    public function __construct(TokenEntityBuilder $builder)
    {
        $this->id = $builder->getId();
        $this->token = $builder->getToken();
        $this->expiredOn = $builder->getExpiredOn();
        $this->lockVersion = $builder->getLockVersion();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return \DateTime
     */
    public function getExpiredOn(): \DateTime
    {
        return $this->expiredOn;
    }

    /**
     * @return int
     */
    public function getLockVersion(): int
    {
        return $this->lockVersion;
    }
}
