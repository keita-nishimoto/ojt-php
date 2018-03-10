<?php
/**
 * PreregistrationTest
 * 仮ユーザー登録のシナリオテスト
 */

namespace Tests\App\Models\Domain\PreregistrationScenario;

use App\Services\PreregistrationScenario;
use PHPUnit\DbUnit\DataSet\FlatXmlDataSet;
use Tests\DbTestCase;

/**
 * Class PreregistrationTest
 *
 * @package Tests\App\Models\Domain\PreregistrationScenario
 */
class PreregistrationTest extends DbTestCase
{

    /**
     * @return FlatXmlDataSet
     */
    public function getDataSet(): FlatXmlDataSet
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/PreregistrationTest.xml');
    }

    /**
     * 正常系テストケース
     * 仮ユーザー登録が正常に行われる事を確認する
     */
    public function testSuccess()
    {
        $pdo = $this->getPdo();

        $preregistrationScenario = new PreregistrationScenario($pdo);

        $email = 'keita.koga.work+1@gmail.com';
        $nowDate = $expectedExpiredOn = new \DateTime();

        $expectedExpiredOn = new \DateTime();
        $expectedExpiredOn->add(new \DateInterval('P1D'));

        $preregistrationEntity = $preregistrationScenario->preregistration(
            ['email' => $email]
        );

        // 意図した通りのドメインオブジェクトが返却される事を確認する
        $this->assertInstanceOf('\\App\\Models\\Domain\\Preregistration\\PreregistrationEntity', $preregistrationEntity);

        // 各属性が意図した値かどうかを確認
        $this->assertSame(
            2,
            $preregistrationEntity->getId()
        );

        $this->assertSame(
            false,
            $preregistrationEntity->isRegistered()
        );

        $this->assertSame(
            $expectedExpiredOn->format('Y-m-d'),
            $preregistrationEntity->getTokenEntity()->getExpiredOn()->format('Y-m-d')
        );

        $this->assertSame(
            $email,
            $preregistrationEntity->getEmailValue()->getEmail()
        );

        // 仮ユーザー登録のテーブルが意図した通りに変わっているか確認する
        $this->assertEquals(
            2,
            $this->getConnection()->getRowCount('preregistrations')
        );

        $preregistrationsQueryTable = $this->getConnection()->createQueryTable(
            'preregistrations_tokens',
            'SELECT * FROM preregistrations'
        );

        $expectedCreatedAt = new \DateTime(
            $preregistrationsQueryTable->getValue(1, 'created_at')
        );

        $expectedUpdatedAt = new \DateTime(
            $preregistrationsQueryTable->getValue(1, 'updated_at')
        );

        $expectedPreregistrations = [
            'id'            => '2',
            'is_registered' => '0',
            'lock_version'  => '0',
            'created_at'    => $nowDate->format('Y-m-d'),
            'updated_at'    => $nowDate->format('Y-m-d'),
        ];

        $actualPreregistrations = [
            'id'            => $preregistrationsQueryTable->getValue(1, 'id'),
            'is_registered' => $preregistrationsQueryTable->getValue(1, 'is_registered'),
            'lock_version'  => $preregistrationsQueryTable->getValue(1, 'lock_version'),
            'created_at'    => $expectedCreatedAt->format('Y-m-d'),
            'updated_at'    => $expectedUpdatedAt->format('Y-m-d'),
        ];

        $this->assertSame($expectedPreregistrations, $actualPreregistrations);

        // トークンが意図した通りに登録されているか確認する
        $this->assertEquals(
            2,
            $this->getConnection()->getRowCount('preregistrations_tokens')
        );

        $preregistrationsTokensQueryTable = $this->getConnection()->createQueryTable(
            'preregistrations_tokens',
            'SELECT * FROM preregistrations_tokens'
        );

        $expectedPreregistrationsTokens = [
            'id'           => '2',
            'register_id'  => '2',
            'token'        => $preregistrationEntity->getTokenEntity()->getToken(),
            'lock_version' => '0',
            'created_at'   => $nowDate->format('Y-m-d'),
            'updated_at'   => $nowDate->format('Y-m-d'),
        ];

        $expectedCreatedAt = new \DateTime(
            $preregistrationsTokensQueryTable->getValue(1, 'created_at')
        );

        $expectedUpdatedAt = new \DateTime(
            $preregistrationsTokensQueryTable->getValue(1, 'updated_at')
        );

        $actualPreregistrationsTokens = [
            'id'           => $preregistrationsTokensQueryTable->getValue(1, 'id'),
            'register_id'  => $preregistrationsTokensQueryTable->getValue(1, 'register_id'),
            'token'        => $preregistrationsTokensQueryTable->getValue(1, 'token'),
            'lock_version' => $preregistrationsTokensQueryTable->getValue(1, 'lock_version'),
            'created_at'   => $expectedCreatedAt->format('Y-m-d'),
            'updated_at'   => $expectedUpdatedAt->format('Y-m-d'),
        ];

        $this->assertSame($expectedPreregistrationsTokens, $actualPreregistrationsTokens);

        // メールアドレスが意図した通りに登録されているか確認する
        $this->assertEquals(
            2,
            $this->getConnection()->getRowCount('preregistrations_emails')
        );

        $preregistrationsEmailsQueryTable = $this->getConnection()->createQueryTable(
            'preregistrations_tokens',
            'SELECT * FROM preregistrations_emails'
        );

        $expectedPreregistrationsEmails = [
            'id'           => '2',
            'register_id'  => '2',
            'token'        => $email,
            'lock_version' => '0',
            'created_at'   => $nowDate->format('Y-m-d'),
            'updated_at'   => $nowDate->format('Y-m-d'),
        ];

        $expectedCreatedAt = new \DateTime(
            $preregistrationsEmailsQueryTable->getValue(1, 'created_at')
        );

        $expectedUpdatedAt = new \DateTime(
            $preregistrationsEmailsQueryTable->getValue(1, 'updated_at')
        );

        $actualPreregistrationsEmails = [
            'id'           => $preregistrationsEmailsQueryTable->getValue(1, 'id'),
            'register_id'  => $preregistrationsEmailsQueryTable->getValue(1, 'register_id'),
            'token'        => $preregistrationsEmailsQueryTable->getValue(1, 'email'),
            'lock_version' => $preregistrationsEmailsQueryTable->getValue(1, 'lock_version'),
            'created_at'   => $expectedCreatedAt->format('Y-m-d'),
            'updated_at'   => $expectedUpdatedAt->format('Y-m-d'),
        ];

        $this->assertSame($expectedPreregistrationsEmails, $actualPreregistrationsEmails);
    }
}
