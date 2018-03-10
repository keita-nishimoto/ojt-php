<?php
/**
 * PreregistrationEntity
 * 仮ユーザー登録のEntity
 */

namespace App\Models\Domain\Preregistration;

/**
 * Class PreregistrationEntity
 *
 * @package App\Models\Domain
 */
class PreregistrationEntity
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
     * @var TokenEntity
     */
    private $tokenEntity;

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
     * Preregistration constructor.
     *
     * @param PreregistrationEntityBuilder $builder
     */
    public function __construct(PreregistrationEntityBuilder $builder)
    {
        $this->id = $builder->getId();
        $this->isRegistered = $builder->isRegistered();
        $this->tokenEntity = $builder->getTokenEntity();
        $this->emailValue = $builder->getEmailValue();
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
     * @return bool
     */
    public function isRegistered(): bool
    {
        return $this->isRegistered;
    }

    /**
     * @return TokenEntity
     */
    public function getTokenEntity(): TokenEntity
    {
        return $this->tokenEntity;
    }

    /**
     * @return EmailValue
     */
    public function getEmailValue(): EmailValue
    {
        return $this->emailValue;
    }

    /**
     * @return int
     */
    public function getLockVersion(): int
    {
        return $this->lockVersion;
    }
}
