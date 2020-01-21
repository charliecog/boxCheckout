<?php

namespace Tests\Entities;

require_once __DIR__ . '/../../vendor/autoload.php';

use BoxCheckout\Entities\UserEntity;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function createUserEntity()
    {
        $title = 'mr';
        $firstName = 'Bob';
        $lastName = 'Barker';
        $email = 'bobby@bob.com';
        $phone = '07900398786';
        $businessName = 'Bobs Cars';
        $secondaryPhone = '02083320998';
        return new UserEntity($title, $firstName, $lastName, $email, $phone, $businessName, $secondaryPhone);
    }

    public function testConstructorSuccess()
    {
        $user = $this->createUserEntity();
        $this->assertInstanceOf(UserEntity::class, $user);
    }

    public function testConstructorTitleFailure()
    {
        $this->expectException(\Exception::class);
        $title = 'mrdsfjsdlfj';
        $firstName = 'Bob';
        $lastName = 'Barker';
        $email = 'bobby@bob.com';
        $phone = '07900398786';
        $businessName = 'Bobs Cars';
        $secondaryPhone = '02083320998';
        return new UserEntity($title, $firstName, $lastName, $email, $phone, $businessName, $secondaryPhone);
    }

    public function testConstructorPhoneFailure()
    {
        $this->expectException(\Exception::class);
        $title = 'mr';
        $firstName = 'Bob';
        $lastName = 'Barker';
        $email = 'bobby@bob.com';
        $phone = '079003987863333';
        $businessName = 'Bobs Cars';
        $secondaryPhone = '02083320998';
        return new UserEntity($title, $firstName, $lastName, $email, $phone, $businessName, $secondaryPhone);
    }

    public function testGetters()
    {
        $user = $this->createUserEntity();
        $this->assertEquals('mr', $user->getTitle());
        $this->assertEquals('Bob', $user->getFirstName());
        $this->assertEquals('Barker', $user->getLastName());
        $this->assertEquals('bobby@bob.com', $user->getEmail());
        $this->assertEquals('07900398786', $user->getPhone());
        $this->assertEquals('Bobs Cars', $user->getBusinessName());
        $this->assertEquals('02083320998', $user->getSecondaryPhone());
    }
}