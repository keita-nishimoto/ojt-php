<?php
/**
 * EmailService
 * ドメインの直下に置いたのは以下の理由から
 * - 他のドメインモデルから利用出来るようにする為
 * - 属性チェック等はビジネス上受け入れて良いかどうかの判定も含む為
 */

namespace App\Models\Domain;

/**
 * Class EmailService
 *
 * @package App\Models\Domain
 */
class EmailService
{
    const EMAIL_REQUIRED_MESSAGE = 'メールアドレスを入力して下さい。';

    const EMAIL_VALIDATION_ERROR_MESSAGE = 'メールアドレスを正しく入力して下さい。';

    /**
     * メールアドレスとして正しい値かどうかを判定する
     *
     * @param $email
     * @return bool
     */
    public static function isEmail($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === $email) {
            return true;
        }

        return false;
    }
}
