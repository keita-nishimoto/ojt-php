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

        $preregistration = $preregistrationScenario->preregistration(
            ['email' => 'keita.koga.work+1@gmail.com']
        );

        $this->assertInstanceOf('\\App\\Models\\Domain\\Preregistration', $preregistration);

        // テーブルの件数が意図した通りに変わっているかを確認
        $this->assertEquals(
            2,
            $this->getConnection()->getRowCount('preregistrations_tokens')
        );

        $queryTable = $this->getConnection()->createQueryTable(
            'preregistrations_tokens',
            'SELECT * FROM preregistrations_tokens'
        );

        // テーブルの中身が意図した通りに変わっているかを確認
        $expectedPreregistrationsTokens = [
            'id'           => '2',
            'register_id'  => '2',
            'token'        => $preregistration->getToken(),
            'lock_version' => '0',
        ];

        $actualPreregistrationsTokens = [
            'id'           => $queryTable->getValue(1, 'id'),
            'register_id'  => $queryTable->getValue(1, 'register_id'),
            'token'        => $queryTable->getValue(1, 'token'),
            'lock_version' => $queryTable->getValue(1, 'lock_version'),
        ];

        $this->assertSame($expectedPreregistrationsTokens, $actualPreregistrationsTokens);
    }
}
