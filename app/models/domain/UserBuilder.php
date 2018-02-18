<?php
/**
 * UserBuilder
 */

namespace App\Models\Domain;

/**
 * Class UserBuilder
 *
 * @package App\Models\Domain
 */
class UserBuilder
{
    /**
     * @var int
     */
    private $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function build(): User
    {
        return new User($this);
    }
}
