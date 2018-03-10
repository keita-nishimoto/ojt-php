<?php
/**
 * EmailValue
 */

namespace App\Models\Domain\Preregistration;

/**
 * Class EmailValue
 *
 * @package App\Models\Domain\Preregistration
 */
class EmailValue
{
    /**
     * @var string
     */
    private $email;

    /**
     * EmailValue constructor.
     *
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
