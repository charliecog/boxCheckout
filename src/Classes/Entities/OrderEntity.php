<?php

namespace BoxCheckout\Entities;

use BoxCheckout\Interfaces\Sanitiseable;

class OrderEntity extends ValidationEntity implements Sanitiseable
{
    protected $userId;
    protected $deliveryId;
    protected $paymentId;
    protected $totalPrice;
    protected $discountApplied;
    protected $totalChargedPrice;

    public function __construct(
        int $userId,
        int $deliveryId,
        int $paymentId,
        float $totalPrice,
        int $discountApplied,
        float $totalChargedPrice
    ) {
        $this->userId = $userId;
        $this->deliveryId = $deliveryId;
        $this->paymentId = $paymentId;
        $this->totalPrice = $totalPrice;
        $this->discountApplied = $discountApplied;
        $this->totalChargedPrice = $totalChargedPrice;

        $this->sanitiseData();
    }

    public function sanitiseData()
    {
        self::validatePositiveInt($this->userId);
        self::validatePositiveInt($this->deliveryId);
        self::validatePositiveInt($this->paymentId);
        self::validatePositiveFloat($this->totalPrice);
        self::validatePositiveInt($this->discountApplied);
        $this->validateDiscount();
        self::validatePositiveFloat($this->totalChargedPrice);
    }

    /**
     * Validates entity discount value, throws an Exception if not valid
     *
     * @return mixed, true if valid
     * @throws \Exception if not a valid selection
     */
    public function validateDiscount() : bool
    {
        if( $this->discountApplied === 0 ||
            $this->discountApplied === 15
        ) {
            return true;
        } else {
            throw new \Exception('discount is not valid');
        }
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getDeliveryId(): int
    {
        return $this->deliveryId;
    }

    /**
     * @return int
     */
    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @return int
     */
    public function getDiscountApplied(): int
    {
        return $this->discountApplied;
    }

    /**
     * @return float
     */
    public function getTotalChargedPrice(): float
    {
        return $this->totalChargedPrice;
    }
}
