<?php

namespace BoxCheckout\Entities;

use PHPUnit\Runner\Exception;

class BoxEntity extends ValidationEntity implements \JsonSerializable {
    protected $id;
    protected $size;
    protected $strength;
    protected $price;

    public function __construct(int $id, string $size, string $strength, float $price)
    {
        $this->id = $id;
        $this->size = $size;
        $this->strength = $strength;
        $this->price = $price;

        $this->sanitiseData();
    }

    private function sanitiseData()
    {
        $this->id = (int) $this->id;
        $this->validateSize();
        self::validateExistsAndLength($this->size, 6);
        $this->validateStrength();
        self::validateExistsAndLength($this->strength, 12);
        $this->price = self::validateFloat($this->price);
    }

    public function validateSize() : bool
    {
        if($this->size == 'small' || $this->size == 'medium' || $this->size == 'large'){
            return true;
        } else {
            throw new Exception('box size is not valid');
        }
    }

    public function validateStrength() : bool
    {
        if($this->strength == 'standard' || $this->strength == 'strong' || $this->strength == 'extra_strong'){
            return true;
        } else {
            throw new Exception('box strength is not valid');
        }
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'size' => $this->size,
            'strength' => $this->strength,
            'price' => $this->price
        ];
    }

}
