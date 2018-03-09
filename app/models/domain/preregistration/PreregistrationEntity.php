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
     * メールアドレス
     *
     * @var string
     */
    private $email;

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
        $this->token = $builder->getToken();
        $this->expiredOn = $builder->getExpiredOn();
        $this->email = $builder->getEmail();
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
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getLockVersion(): int
    {
        return $this->lockVersion;
    }
}
