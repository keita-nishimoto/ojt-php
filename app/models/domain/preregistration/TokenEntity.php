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
     * TokenEntity constructor.
     *
     * @param TokenEntityBuilder $builder
     */
    public function __construct(TokenEntityBuilder $builder)
    {
        $this->token = $builder->getToken();
        $this->expiredOn = $builder->getExpiredOn();
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
}
