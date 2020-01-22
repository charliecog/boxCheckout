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
     * @return \PDO
     */
    public function getDb()
    {
        return $this->db;
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
     * Creates a Order entity.
     *
     * @param int $userId
     * @param int $deliveryId
     * @param int $paymentId
     * @param float $totalPrice
     * @param int $discountApplied
     * @param float $totalChargedPrice
     *
     * @return OrderEntity The created OrderEntity.
     */
    public function createOrderEntity(
        int $userId,
        int $deliveryId,
        int $paymentId,
        float $totalPrice,
        int $discountApplied,
        float $totalChargedPrice
    ): OrderEntity {
        return new OrderEntity(
            $userId,
            $deliveryId,
            $paymentId,
            $totalPrice,
            $discountApplied,
            $totalChargedPrice);
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
     * Creates array of OrderDetailsEntities from products array.
     *
     * @param array $products the OrderDetails as an assoc array
     * @param int $orderId the orderId the orderDetails are associated with
     *
     * @return array $result The created array of OrderDetailEntities
     */
    public function createOrderDetailsArray(array $products, int $orderId): array
    {
        $result = [];
        foreach ($products as $product){
            $result[] = new OrderDetailsEntity($orderId, $product['pid'], $product['quantity']);
        }
        return $result;
    }

    /**
     * Adds OrderDetails data to the database.
     *
     * @param array $arrOfOrderDetails the OrderDetails objects
     *
     * @return int the last inserted id of the last product
     */
    public function addOrderDetails(array $arrOfOrderDetails): int
    {
        $query = $this->db->prepare(
            "INSERT INTO `order_details` (`order_id`, `box_id`, `quantity`) VALUES (:orderId, :boxId, :quantity);"
        );
        foreach ($arrOfOrderDetails as $orderDetails){
            if($orderDetails instanceof OrderDetailsEntity){
                $query->bindParam(':orderId', $orderDetails->getOrderId());
                $query->bindParam(':boxId', $orderDetails->getBoxId());
                $query->bindParam(':quantity', $orderDetails->getQuantity());
                $query->execute();
            }
        }

        return $this->db->lastInsertId();
    }

    public function checkAllKeysPresent(array $requestData): bool
    {
        if(
            !isset($requestData['address']) ||
            !isset($requestData['address']['firstLine']) ||
            !isset($requestData['address']['secondLine']) ||
            !isset($requestData['address']['town']) ||
            !isset($requestData['address']['postcode']) ||
            !isset($requestData['address']['county']) ||
            !isset($requestData['address']['country']) ||
            !isset($requestData['user']) ||
            !isset($requestData['user']['title']) ||
            !isset($requestData['user']['firstName']) ||
            !isset($requestData['user']['lastName']) ||
            !isset($requestData['user']['email']) ||
            !isset($requestData['user']['phone']) ||
            !isset($requestData['user']['businessName']) ||
            !isset($requestData['user']['secondaryPhone']) ||
            !isset($requestData['products']) ||
            count($requestData['products']) < 1 ||
            !isset($requestData['totalPrice']) ||
            !isset($requestData['discount']) ||
            !isset($requestData['totalPriceCharged']) ||
            !isset($requestData['paymentId'])
        ){
            return true;
        } else {
            return false;
        }
    }
}