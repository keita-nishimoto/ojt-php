<?php
/**
 * PreregistrationValue
 * 仮ユーザー登録時のParameterを格納する値オブジェクト
 */

namespace App\Models\Domain\Preregistration;

/**
 * Class PreregistrationValue
 *
 * @package App\Models\Domain\Preregistration
 */
class PreregistrationValue
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
     * メールアドレス
     *
     * @var string
     */
    private $email;

    /**
     * PreregistrationValue constructor.
     *
     * @param PreregistrationValueBuilder $builder
     */
    public function __construct(PreregistrationValueBuilder $builder)
    {
        $this->token = $builder->getToken();
        $this->expiredOn = $builder->getExpiredOn();
        $this->email = $builder->getEmail();
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
}
