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

        $preregistration = $preregistrationScenario->preregistration(
            ['email' => $email]
        );

        $this->assertInstanceOf('\\App\\Models\\Domain\\Preregistration', $preregistration);

        // 仮ユーザー登録のテーブルが意図した通りに変わっているか確認する
        $this->assertEquals(
            2,
            $this->getConnection()->getRowCount('preregistrations')
        );

        $preregistrationsQueryTable = $this->getConnection()->createQueryTable(
            'preregistrations_tokens',
            'SELECT * FROM preregistrations'
        );

        $expectedPreregistrations = [
            'id'           => '2',
            'lock_version' => '0',
        ];

        $actualPreregistrations = [
            'id'           => $preregistrationsQueryTable->getValue(1, 'id'),
            'lock_version' => $preregistrationsQueryTable->getValue(1, 'lock_version'),
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
            'token'        => $preregistration->getToken(),
            'lock_version' => '0',
        ];

        $actualPreregistrationsTokens = [
            'id'           => $preregistrationsTokensQueryTable->getValue(1, 'id'),
            'register_id'  => $preregistrationsTokensQueryTable->getValue(1, 'register_id'),
            'token'        => $preregistrationsTokensQueryTable->getValue(1, 'token'),
            'lock_version' => $preregistrationsTokensQueryTable->getValue(1, 'lock_version'),
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
        ];

        $actualPreregistrationsEmails = [
            'id'           => $preregistrationsEmailsQueryTable->getValue(1, 'id'),
            'register_id'  => $preregistrationsEmailsQueryTable->getValue(1, 'register_id'),
            'token'        => $preregistrationsEmailsQueryTable->getValue(1, 'email'),
            'lock_version' => $preregistrationsEmailsQueryTable->getValue(1, 'lock_version'),
        ];

        $this->assertSame($expectedPreregistrationsEmails, $actualPreregistrationsEmails);
    }
}
