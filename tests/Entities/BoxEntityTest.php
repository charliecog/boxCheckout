<?php

namespace Tests\Entities;

require_once __DIR__ . '/../../vendor/autoload.php';

use BoxCheckout\Entities\BoxEntity;
use PHPUnit\Exception;
use PHPUnit\Framework\TestCase;


class BoxEntityTest extends TestCase
{
    public function testValidateSizeSuccess()
    {
        $boxEntity = new BoxEntity(1,'small', 'strong', 2.99);
        $result = $boxEntity->validateSize();
        $this->assertEquals($result, true);
    }

    public function testValidateSizeFailure()
    {
        $this->expectException(Exception::class);
        $boxEntity = new BoxEntity(1,'little', 'strong', 2.99);
        $boxEntity->validateSize();
    }

    public function testValidateSizeMalformed()
    {
        $this->expectException(\TypeError::class);
        $boxEntity = new BoxEntity(1,['small'], 'strong', 2.99);
        $boxEntity->validateSize();
    }

    public function testValidateStrengthSuccess()
    {
        $boxEntity = new BoxEntity(1,'small', 'strong', 2.99);
        $result = $boxEntity->validateStrength();
        $this->assertEquals($result, true);
    }

    public function testValidateStrengthFailure()
    {
        $this->expectException(Exception::class);
        $boxEntity = new BoxEntity(1,'small', 'really strong', 2.99);
        $boxEntity->validateStrength();
    }

    public function testValidateStrengthMalformed()
    {
        $this->expectException(\TypeError::class);
        $boxEntity = new BoxEntity(1,'small', ['strong'], 2.99);
        $boxEntity->validateStrength();
    }
}