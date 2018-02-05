<?php

namespace App\Models\Repository;

use App\Models\Domain\User;
use App\Models\Domain\UserBuilder;

class UserRepository
{

    /**
     * @param int $id
     * @return User
     */
    public function find(int $id): User
    {
        $userBuilder = new UserBuilder();
        $userBuilder->setId($id);

        return $userBuilder->build();
    }
}
