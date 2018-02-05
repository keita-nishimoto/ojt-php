<?php

namespace App\Models\Factory;

use App\Models\Domain\User;
use App\Models\Domain\UserBuilder;

class UserFactory
{

    /**
     * @param int $id
     * @return User
     */
    public static function create(int $id): User
    {
        $userBuilder = new UserBuilder();
        $userBuilder->setId($id);

        return $userBuilder->build();
    }
}