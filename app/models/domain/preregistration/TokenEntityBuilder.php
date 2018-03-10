<?php
/**
 * TokenEntityBuilder
 */

namespace App\Models\Domain\Preregistration;

/**
 * Class TokenEntityBuilder
 *
 * @package App\Models\Domain\Preregistration
 */
class TokenEntityBuilder
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
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return \DateTime
     */
    public function getExpiredOn(): \DateTime
    {
        return $this->expiredOn;
    }

    /**
     * @param \DateTime $expiredOn
     */
    public function setExpiredOn(\DateTime $expiredOn): void
    {
        $this->expiredOn = $expiredOn;
    }

    /**
     * @return TokenEntity
     */
    public function build()
    {
        return new TokenEntity($this);
    }
}
