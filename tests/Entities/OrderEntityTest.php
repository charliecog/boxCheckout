<?php

namespace Tests\Entities;

require_once __DIR__ . '/../../vendor/autoload.php';

use BoxCheckout\Entities\OrderEntity;
use PHPUnit\Framework\TestCase;

class OrderEntityTest extends TestCase
{
    public function createOrderEntity()
    {
        $userId = 1;
        $deliveryId = 2;
        $paymentId = 8398;
        $totalPrice = 40.71;
        $discountApplied = 0;
        $totalChargedPrice = 40.71;
        return new OrderEntity($userId, $deliveryId, $paymentId, $totalPrice, $discountApplied, $totalChargedPrice);
    }

    public function testConstructorSuccess()
    {
        $order = $this->createOrderEntity();
        $this->assertInstanceOf(OrderEntity::class, $order);
    }

    public function testConstructorPaymentIdFailure()
    {
        $this->expectException(\Exception::class);
        $userId = 1;
        $deliveryId = 2;
        $paymentId = -8398;
        $totalPrice = 40.71;
        $discountApplied = 0;
        $totalChargedPrice = 40.71;
        return new OrderEntity($userId, $deliveryId, $paymentId, $totalPrice, $discountApplied, $totalChargedPrice);
    }

    public function testConstructorTotalPriceFailure()
    {
        $this->expectException(\Exception::class);
        $userId = 1;
        $deliveryId = 2;
        $paymentId = 8398;
        $totalPrice = -40.71;
        $discountApplied = 0;
        $totalChargedPrice = 40.71;
        return new OrderEntity($userId, $deliveryId, $paymentId, $totalPrice, $discountApplied, $totalChargedPrice);
    }

    public function testGetters()
    {
        $order = $this->createOrderEntity();
        $this->assertEquals(1, $order->getUserId());
        $this->assertEquals(2, $order->getDeliveryId());
        $this->assertEquals(8398, $order->getPaymentId());
        $this->assertEquals(40.71, $order->getTotalPrice());
        $this->assertEquals(0, $order->getDiscountApplied());
        $this->assertEquals(40.71, $order->getTotalChargedPrice());
    }
}