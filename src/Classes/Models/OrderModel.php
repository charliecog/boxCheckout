<?php

namespace BoxCheckout\Models;

use BoxCheckout\Entities\AddressEntity;
use BoxCheckout\Entities\OrderDetailsEntity;
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
     * Creates an address entity.
     *
     * @param string $firstLine first Line of the address
     * @param string $secondLine second Line of the address
     * @param string $town town of the address
     * @param string $postcode postcode of the address
     * @param string $county county of the address
     * @param string $country country of the address
     *
     * @return AddressEntity The created AddressEntity.
     */
    public function createAddressEntity(
        string $firstLine,
        string $secondLine,
        string $town,
        string $postcode,
        string $county,
        string $country
    ): AddressEntity {
        return new AddressEntity(
            $firstLine,
            $secondLine,
            $town,
            $postcode,
            $county,
            $country);
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
     * Creates a user entity.
     *
     * @param string $title
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $phone
     * @param string $businessName
     * @param string $secondaryPhone
     *
     * @return UserEntity The created UserEntity.
     */
    public function createUserEntity(
        string $title,
        string $firstName,
        string $lastName,
        string $email,
        string $phone,
        string $businessName,
        string $secondaryPhone
    ): UserEntity {
        return new UserEntity(
            $title,
            $firstName,
            $lastName,
            $email,
            $phone,
            $businessName,
            $secondaryPhone);
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
     * @param \BoxCheckout\Entities\OrderEntity All the details of the Order
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

    /**
     * Adds OrderDetails data to the database.
     *
     * @param \BoxCheckout\Entities\OrderDetailsEntity All the details of the OrderDetails
     *
     * @return int The id of the inserted row.
     */
    public function addOrderDetails(OrderDetailsEntity $orderDetails)
    {
        $query = $this->db->prepare(
            "INSERT INTO `order_details` (`order_id`, `box_id`, `quantity`) VALUES (:orderId, :boxId, :quantity);"
        );
        $query->bindParam(':orderId', $orderDetails->getOrderId());
        $query->bindParam(':boxId', $orderDetails->getBoxId());
        $query->bindParam(':quantity', $orderDetails->getQuantity());
        $query->execute();
        return $this->db->lastInsertId();
    }
}