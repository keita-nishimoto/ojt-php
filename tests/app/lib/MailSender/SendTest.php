<?php
/**
 * SendTest
 */

namespace Tests\App\Lib\MailSender;

use App\Lib\MailSender;
use App\Models\Domain\Preregistration\EmailValue;
use App\Models\Domain\Preregistration\PreregistrationEntityBuilder;
use App\Models\Domain\Preregistration\PreregistrationMailValue;
use App\Models\Domain\Preregistration\PreregistrationValueBuilder;
use App\Models\Domain\Preregistration\TokenValueBuilder;
use Ramsey\Uuid\Uuid;
use Tests\NormalTestCase;

/**
 * Class SendTest
 *
 * @package Tests\App\Lib\MailSender
 */
class SendTest extends NormalTestCase
{
    /**
     * 初期化
     * .envをロードする処理を実行
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * 正常系テストメソッド
     * メールが正常に送信出来る事を確認
     */
    public function testSuccess()
    {
        $uuid4 = Uuid::uuid4();
        $email = getenv('ADMIN_EMAIL');

        $expiredOn = new \DateTime();
        $expiredOn->add(new \DateInterval('P1D'));

        $builder = new PreregistrationValueBuilder();
        $builder->setToken($uuid4->toString());
        $builder->setExpiredOn($expiredOn);
        $builder->setEmail($email);

        $preregistrationValue = $builder->build();

        $preregistrationId = 1;
        $preregistrationEntityBuilder = new PreregistrationEntityBuilder();
        $preregistrationEntityBuilder->setId($preregistrationId);
        $preregistrationEntityBuilder->setIsRegistered(false);

        $tokenValueBuilder = new TokenValueBuilder();
        $tokenValueBuilder->setToken($preregistrationValue->getToken());
        $tokenValueBuilder->setExpiredOn($preregistrationValue->getExpiredOn());

        $preregistrationEntityBuilder->setTokenValue($tokenValueBuilder->build());

        $emailValue = new EmailValue($preregistrationValue->getEmail());

        $preregistrationEntityBuilder->setEmailValue($emailValue);
        $preregistrationEntityBuilder->setLockVersion(0);

        $preregistrationEntity = $preregistrationEntityBuilder->build();

        $preregistrationMailValue = new PreregistrationMailValue($preregistrationEntity);
        $mailSender = new MailSender();

        $result = $mailSender->send($preregistrationMailValue);

        $this->assertSame(202, $result->statusCode());
    }
}
