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
    }

    public function sanitiseData()
    {
        
    }
}
