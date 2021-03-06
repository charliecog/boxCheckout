<?php

namespace BoxCheckout\Entities;

class BoxEntity extends ValidationEntity implements \JsonSerializable {
    protected $id;
    protected $size;
    protected $strength;
    protected $price;

    //data is hydrated directly into the properties so don't need to pass params into construct
    public function __construct()
    {
        $this->sanitiseData();
    }

    /**
     * Sanitise the data within the Entity
     *
     * @return void
     */
    private function sanitiseData() :void
    {
        $this->id = (int) $this->id;
        $this->validateSize();
        self::validateExistsAndLength($this->size, 6);
        $this->validateStrength();
        self::validateExistsAndLength($this->strength, 12);
        $this->price = self::validateFloat($this->price);
    }

    /**
     * Validates entity size value, throws an Exception if not
     *
     * @return mixed, true if valid
     * @throws \Error if not a valid selection
     */
    public function validateSize() : bool
    {
        if($this->size == 'small' || $this->size == 'medium' || $this->size == 'large'){
            return true;
        } else {
            throw new \Error('box size is not valid');
        }
    }

    /**
     * Validates entity strength value, throws an Exception if not
     *
     * @return mixed, true if valid
     * @throws \Exception if not a valid selection
     */
    public function validateStrength() : bool
    {
        if($this->strength == 'standard' || $this->strength == 'strong' || $this->strength == 'extra_strong'){
            return true;
        } else {
            throw new Exception('box strength is not valid');
        }
    }

    /**
     * Returns entity data
     *
     * @return array, the entity data
     */
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
