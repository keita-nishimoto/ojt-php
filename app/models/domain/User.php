<?php

namespace App\Models\Domain;

class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * User constructor.
     *
     * @param UserBuilder $builder
     */
    public function __construct(UserBuilder $builder)
    {
        $this->id = $builder->getId();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
