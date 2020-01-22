<?php

namespace BoxCheckout\Models;

use BoxCheckout\Entities\AddressEntity;

class OrderModel
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Adds address data to the database.
     *
     * @param \BoxCheckout\Entities\AddressEntity All the details of the address
     *
     * @return int The id of the inserted row.
     */
    public function addAddress(AddressEntity $address)
    {
        $query = $this->db->prepare(
            "INSERT INTO `addresses` (`first_line`, `second_line`, `town`, `post_code`, `county`, `country`) VALUES (:firstLine, :secondLine, :town, :postcode, :county, :country);"
        );
        $query->bindParam(':firstLine', $address->getFirstLine());
        $query->bindParam(':secondLine', $address->getSecondLine());
        $query->bindParam(':town', $address->getTown());
        $query->bindParam(':postcode', $address->getPostcode());
        $query->bindParam(':county', $address->getCounty());
        $query->bindParam(':country', $address->getCountry());
        $query->execute();
        return $this->db->lastInsertId();
    }
}