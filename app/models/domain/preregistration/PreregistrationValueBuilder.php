<?php
/**
 * PreregistrationValueBuilder
 * 仮ユーザー登録時のParameterを格納する値オブジェクト
 */

namespace App\Models\Domain\Preregistration;

/**
 * Class PreregistrationValueBuilder
 *
 * @package App\Models\Domain\Preregistration
 */
class PreregistrationValueBuilder
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
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return PreregistrationValue
     */
    public function build(): PreregistrationValue
    {
        return new PreregistrationValue($this);
    }
}
