<?php
/**
 * PreregistrationMailValue
 * 仮ユーザー登録の認証メール
 */

namespace App\Models\Domain\Preregistration;

use App\Lib\SendMailInterface;

/**
 * Class PreregistrationMailValue
 *
 * @package App\Models\Domain\Preregistration
 */
class PreregistrationMailValue implements SendMailInterface
{
    /**
     * 送信元のメールアドレス
     *
     * @var string
     */
    private $from;

    /**
     * メールのタイトル
     *
     * @var string
     */
    private $subject;

    /**
     * 送信先のメールアドレス
     *
     * @var string
     */
    private $to;

    /**
     * メール本文
     *
     * @var string
     */
    private $content;

    /**
     * @var PreregistrationEntity
     */
    private $preregistrationEntity;

    /**
     * PreregistrationMailValue constructor.
     *
     * @param PreregistrationEntity $preregistrationEntity
     */
    public function __construct(PreregistrationEntity $preregistrationEntity)
    {
        $this->from = 'ojt-php-test-mail@example.com';
        $this->subject = '仮ユーザー登録完了のお知らせ';
        $this->to = $preregistrationEntity->getEmailValue()->getEmail();
        $this->preregistrationEntity = $preregistrationEntity;

        $this->generateContent();
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return PreregistrationEntity
     */
    public function getPreregistrationEntity(): PreregistrationEntity
    {
        return $this->preregistrationEntity;
    }

    /**
     * メール本文を生成する
     */
    private function generateContent()
    {
        $path = sprintf(
            '/registration/%s',
            $this->getPreregistrationEntity()->getTokenValue()->getToken()
        );

        $url = getenv('APP_URL') . $path;

        $this->content = "
            以下のURLより、本登録を行って下さい。
            URLの有効期限は24時間になります。
            $url
        ";
    }
}
