<?php

namespace BoxCheckout\Entities;

use BoxCheckout\Interfaces\Sanitiseable;

class OrderDetailsEntity extends ValidationEntity implements Sanitiseable
{
    protected $orderId;
    protected $boxId;
    protected $quantity;

    public function __construct(
        int $orderId,
        int $boxId,
        int $quantity
    ) {
        $this->orderId = $orderId;
        $this->boxId = $boxId;
        $this->quantity = $quantity;

        $this->sanitiseData();
    }

    public function sanitiseData()
    {
        self::validatePositiveInt($this->orderId);
        self::validatePositiveInt($this->boxId);
        self::validatePositiveInt($this->quantity);
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @return int
     */
    public function getBoxId(): int
    {
        return $this->boxId;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
