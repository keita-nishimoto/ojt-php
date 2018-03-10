<?php
/**
 * PreregistrationEntityBuilder
 */

namespace App\Models\Domain\Preregistration;

/**
 * Class PreregistrationEntityBuilder
 *
 * @package App\Models\Domain
 */
class PreregistrationEntityBuilder
{
    /**
     * 識別子
     *
     * @var int
     */
    private $id;

    /**
     * 本登録済かどうか
     *
     * @var boolean
     */
    private $isRegistered;

    /**
     * @var TokenValue
     */
    private $tokenValue;

    /**
     * @var EmailValue
     */
    private $emailValue;

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
     * @return bool
     */
    public function isRegistered(): bool
    {
        return $this->isRegistered;
    }

    /**
     * @param bool $isRegistered
     */
    public function setIsRegistered(bool $isRegistered): void
    {
        $this->isRegistered = $isRegistered;
    }

    /**
     * @return TokenValue
     */
    public function getTokenValue(): TokenValue
    {
        return $this->tokenValue;
    }

    /**
     * @param TokenValue $tokenValue
     */
    public function setTokenValue(TokenValue $tokenValue): void
    {
        $this->tokenValue = $tokenValue;
    }

    /**
     * @return EmailValue
     */
    public function getEmailValue(): EmailValue
    {
        return $this->emailValue;
    }

    /**
     * @param EmailValue $emailValue
     */
    public function setEmailValue(EmailValue $emailValue): void
    {
        $this->emailValue = $emailValue;
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
     * @return PreregistrationEntity
     */
    public function build(): PreregistrationEntity
    {
        return new PreregistrationEntity($this);
    }
}
