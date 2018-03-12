<?php
/**
 * SendMailInterface
 * メール送信を行う際は必ずこのインターフェースを利用する
 */

namespace App\Lib;

/**
 * Interface SendMailInterface
 *
 * @package App\Lib
 */
interface SendMailInterface
{
    /**
     * 送信元のメールアドレスを取得する
     *
     * @return string
     */
    public function getFrom(): string;

    /**
     * メールのタイトルを取得する
     *
     * @return string
     */
    public function getSubject(): string;

    /**
     * 送信先のメールアドレスを取得する
     *
     * @return string
     */
    public function getTo(): string;

    /**
     * メール本文を取得する
     *
     * @return string
     */
    public function getContent(): string;
}
