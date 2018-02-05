<?php

namespace Tests\App\Models\Repository\UserRepository;

use App\Models\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class FindTest extends TestCase
{
    /**
     * 正常系テストケース
     *
     * ユーザーを1件取得出来る
     */
    public function testSuccess()
    {
        $id = 100;

        $userRepository = new UserRepository();

        $user = $userRepository->find($id);

        $this->assertSame($id, $user->getId());
    }
}
