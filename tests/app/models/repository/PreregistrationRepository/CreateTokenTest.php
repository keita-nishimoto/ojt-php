<?php
/**
 * CreateTokenTest
 */

namespace Tests\App\Models\Repository\PreregistrationRepository;

use App\Models\Repository\PreregistrationRepository;
use PHPUnit\DbUnit\DataSet\FlatXmlDataSet;
use Tests\DbTestCase;

/**
 * Class CreateTokenTest
 *
 * @package Tests\App\Models\Repository\PreregistrationRepository
 */
class CreateTokenTest extends DbTestCase
{

    /**
     * @return FlatXmlDataSet
     */
    public function getDataSet(): FlatXmlDataSet
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/CreateTokenTest.xml');
    }

    /**
     * 正常系テストケース
     *
     * TODO 仮実装なので後で実装を行う
     */
    public function testSuccess()
    {
        $pdo = $this->getPdo();

        $repository = new PreregistrationRepository($pdo);

        $result = $repository->createToken();

        $this->assertTrue($result);
    }
}
