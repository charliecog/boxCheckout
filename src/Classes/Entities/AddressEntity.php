<?php

namespace BoxCheckout\Entities;

class AddressEntity extends ValidationEntity
{
    protected $firstLine;
    protected $secondLine;
    protected $town;
    protected $postcode;
    protected $county;
    protected $country;

    public function __construct(
        string $firstLine,
        string $secondLine,
        string $town,
        string $postcode,
        string $county,
        string $country
    ) {
       $this->firstLine = $firstLine;
       $this->secondLine = $secondLine;
       $this->town = $town;
       $this->postcode = $postcode;
       $this->county = $county;
       $this->country = $country;

       $this->sanitiseData();
    }

    /**
     * Sanitise the data within the Entity
     *
     * @return void
     */
    public function sanitiseData(): void
    {
        $this->firstLine = self::sanitiseString($this->firstLine);
        self::validateExistsAndLength($this->firstLine, 1000);
        $this->secondLine = self::sanitiseString($this->secondLine);
        self::validateExistsAndLength($this->secondLine, 1000);
        $this->town = self::sanitiseString($this->town);
        self::validateExistsAndLength($this->town, 255);
        $this->postcode = self::sanitiseString($this->postcode);
        self::validateExistsAndLength($this->postcode, 10);
        $this->county = self::sanitiseString($this->county);
        self::validateExistsAndLength($this->county, 255);
        $this->country = self::sanitiseString($this->country);
        self::validateExistsAndLength($this->country, 255);
    }

    /**
     * @return string
     */
    public function getFirstLine(): string
    {
        return $this->firstLine;
    }

    /**
     * @return string
     */
    public function getSecondLine(): string
    {
        return $this->secondLine;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @return string
     */
    public function getCounty(): string
    {
        return $this->county;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

}