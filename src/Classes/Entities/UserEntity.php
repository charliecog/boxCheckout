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

        $this->sanitiseData();
    }

    public function sanitiseData()
    {
        $this->validateTitle();
        $this->firstName = self::sanitiseString($this->firstName);
        self::validateExistsAndLength($this->firstName, 255);
        $this->lastName = self::sanitiseString($this->lastName);
        self::validateExistsAndLength($this->lastName, 255);
        $this->email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
        self::validateExistsAndLength($this->email, 320);
        self::validatePhoneNumber($this->phone);
        if (!is_null($this->businessName)) {
            $this->businessName = self::sanitiseString($this->businessName);
            $this->businessName = self::sanitiseString($this->businessName);
        }
        if (!is_null($this->secondaryPhone)) {
            self::validatePhoneNumber($this->secondaryPhone);
        }
    }

    /**
     * Validates entity title value, throws an Exception if not valid
     *
     * @return mixed, true if valid
     * @throws \Error if not a valid selection
     */
    public function validateTitle() : bool
    {
        if( $this->title === 'mr' ||
            $this->title === 'mrs' ||
            $this->title === 'miss' ||
            $this->title === 'master' ||
            $this->title === 'mx'){
            return true;
        } else {
            throw new \Exception('title is not valid');
        }
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return null|string
     */
    public function getBusinessName()
    {
        return $this->businessName;
    }

    /**
     * @return null|string
     */
    public function getSecondaryPhone()
    {
        return $this->secondaryPhone;
    }

}
