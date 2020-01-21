<?php

namespace BoxCheckout\Entities;

use BoxCheckout\Interfaces\Sanitiseable;

class UserEntity extends ValidationEntity implements Sanitiseable
{
    protected $title;
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $phone;
    protected $businessName = null;
    protected $secondaryPhone = null;

    public function __construct(
        string $title,
        string $firstName,
        string $lastName,
        string $email,
        string $phone,
        string $businessName,
        string $secondaryPhone
    ) {
        $this->title = $title;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->businessName = $businessName;
        $this->secondaryPhone = $secondaryPhone;
    }

    public function sanitiseData()
    {
        
    }
}
