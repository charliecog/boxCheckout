<?php

namespace BoxCheckout\entities;

class BoxEntity {
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
    }

}
