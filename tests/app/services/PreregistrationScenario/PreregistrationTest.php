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
    }
}
