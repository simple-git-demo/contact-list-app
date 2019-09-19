<?php

namespace ContactListApp\Entity;

class Contact
{
    /** @var string */
    public $firstName;

    /** @var string */
    public $lastName;

    /** @var string */
    public $phoneNumber;

    public function __construct(string $firstName, string $lastName, string $phoneNumber)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
    }
}
