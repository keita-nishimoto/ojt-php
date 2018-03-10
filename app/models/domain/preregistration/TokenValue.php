<?php
/**
 * TokenValue
 */

namespace App\Models\Domain\Preregistration;

/**
 * Class TokenValue
 *
 * @package App\Models\Domain\Preregistration
 */
class TokenValue
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
     * TokenValue constructor.
     *
     * @param TokenValueBuilder $builder
     */
    public function __construct(TokenValueBuilder $builder)
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
