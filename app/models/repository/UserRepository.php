<?php
/**
 * UserRepository
 */

namespace App\Models\Repository;

use App\Models\Domain\User;
use App\Models\Factory\UserFactory;

/**
 * Class UserRepository
 *
 * @package App\Models\Repository
 */
class UserRepository
{

    /**
     * @param int $id
     * @return User
     */
    public function find(int $id): User
    {
        return UserFactory::create($id);
    }
}
