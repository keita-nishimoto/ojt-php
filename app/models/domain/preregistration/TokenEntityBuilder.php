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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

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
     * @return int
     */
    public function getLockVersion(): int
    {
        return $this->lockVersion;
    }

    /**
     * @param int $lockVersion
     */
    public function setLockVersion(int $lockVersion): void
    {
        $this->lockVersion = $lockVersion;
    }

    /**
     * @return TokenEntity
     */
    public function build()
    {
        return new TokenEntity($this);
    }
}
