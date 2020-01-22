<?php

namespace Tests\Entities;

require_once __DIR__ . '/../../vendor/autoload.php';

use BoxCheckout\Entities\OrderDetailsEntity;
use PHPUnit\Framework\TestCase;

class OrderDetailsEntityTest extends TestCase
{
    public function createOrderDetailsEntity()
    {
        $orderId = 1;
        $boxId = 2;
        $quantity = 3;
        return new OrderDetailsEntity($orderId, $boxId, $quantity);
    }

    public function testConstructorSuccess()
    {
        $orderDetails = $this->createOrderDetailsEntity();
        $this->assertInstanceOf(OrderDetailsEntity::class, $orderDetails);
    }

    public function testConstructorOrderIdFailure()
    {
        $this->expectException(\Exception::class);
        $orderId = -1;
        $boxId = 2;
        $quantity = 3;
        return new OrderDetailsEntity($orderId, $boxId, $quantity);
    }

    public function testGetters()
    {
        $orderDetails = $this->createOrderDetailsEntity();
        $this->assertEquals(1, $orderDetails->getOrderId());
        $this->assertEquals(2, $orderDetails->getBoxId());
        $this->assertEquals(3, $orderDetails->getQuantity());
    }
}
