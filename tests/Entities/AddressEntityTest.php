<?php

namespace Tests\Entities;

require_once __DIR__ . '/../../vendor/autoload.php';

use BoxCheckout\Entities\AddressEntity;
use PHPUnit\Framework\TestCase;

class AddressEntityTest extends TestCase
{
    public function createAddressEntity(){
        $firstLine = '52 Taylor Ave';
        $secondLine = 'Kew Gardens';
        $town = 'Richmond';
        $postcode = 'TW9 4ED';
        $county = 'Surrey';
        $country = 'United Kingdom';
        return new AddressEntity($firstLine, $secondLine, $town, $postcode, $county, $country);
    }

    public function testConstructionSuccess()
    {
        $address = $this->createAddressEntity();
        $this->assertInstanceOf(AddressEntity::class, $address);
    }

    public function testConstructorPostcodeFailure()
    {
        $this->expectException(\Exception::class);
        $firstLine = '52 Taylor Ave';
        $secondLine = 'Kew Gardens';
        $town = 'Richmond';
        $postcode = 'TW9 4EDsdjklfjslkdfjjsdlj';
        $county = 'Surrey';
        $country = 'United Kingdom';
        return new AddressEntity($firstLine, $secondLine, $town, $postcode, $county, $country);
    }

    public function testGetters()
    {
        $address = $this->createAddressEntity();
        $this->assertEquals('52 Taylor Ave', $address->getFirstLine());
        $this->assertEquals('Kew Gardens', $address->getSecondLine());
        $this->assertEquals('Richmond', $address->getTown());
        $this->assertEquals('TW9 4ED', $address->getPostcode());
        $this->assertEquals('Surrey', $address->getCounty());
        $this->assertEquals('United Kingdom', $address->getCountry());
    }
}