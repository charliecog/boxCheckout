<?php

namespace BoxCheckout\Models;

use BoxCheckout\Entities\AddressEntity;
use BoxCheckout\Entities\OrderEntity;
use BoxCheckout\Entities\UserEntity;

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

    /**
     * Adds User data to the database.
     *
     * @param \BoxCheckout\Entities\UserEntity All the details of the user
     *
     * @return int The id of the inserted row.
     */
    public function addUser(UserEntity $user)
    {
        $query = $this->db->prepare(
            "INSERT INTO `users` (`title`, `first_name`, `last_name`, `business_name`, `email`, `phone`, `secondary_phone`) VALUES (:title, :firstName, :lastName, :businessName, :email, :phone, :secondaryPhone);"
        );
        $query->bindParam(':title', $user->getTitle());
        $query->bindParam(':firstName', $user->getFirstName());
        $query->bindParam(':lastName', $user->getLastName());
        $query->bindParam(':businessName', $user->getBusinessName());
        $query->bindParam(':email', $user->getEmail());
        $query->bindParam(':phone', $user->getPhone());
        $query->bindParam(':secondaryPhone', $user->getSecondaryPhone());
        $query->execute();
        return $this->db->lastInsertId();
    }

    /**
     * Adds Order data to the database.
     *
     * @param \BoxCheckout\Entities\OrderEntity All the details of the user
     *
     * @return int The id of the inserted row.
     */
    public function addOrder(OrderEntity $order)
    {
        $query = $this->db->prepare(
            "INSERT INTO `orders` (`user_id`, `delivery_address_id`, `payment_transaction_id`, `total_price`, `discount_applied`, `total_charged_price`) VALUES (:userId, :deliveryId, :paymentId, :totalPrice, :discountApplied, :totalChargedPrice);"
        );
        $query->bindParam(':userId', $order->getUserId());
        $query->bindParam(':deliveryId', $order->getDeliveryId());
        $query->bindParam(':paymentId', $order->getPaymentId());
        $query->bindParam(':totalPrice', $order->getTotalPrice());
        $query->bindParam(':discountApplied', $order->getDiscountApplied());
        $query->bindParam(':totalChargedPrice', $order->getTotalChargedPrice());
        $query->execute();
        return $this->db->lastInsertId();
    }
}