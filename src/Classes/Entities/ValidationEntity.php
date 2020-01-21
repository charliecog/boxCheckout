<?php

namespace BoxCheckout\Entities;

abstract class ValidationEntity
{
    /**
     * Validate that a string exists and is within length allowed, throws an error if not
     *
     * @param string $validateData
     * @param int $characterLength
     * @return string, which will return the validateData
     * @throws \Exception if the array is empty
     */
    public static function validateExistsAndLength(string $validateData, int $characterLength)
    {
        if (empty($validateData) == false && strlen($validateData) <= $characterLength) {
            return $validateData;
        } else {
            throw new \Exception('An input string does not exist or is too long');
        }
    }

    /**
     * Validate that an input is a float, throws an error if not
     *
     * @param float $float
     * @return float, which will return the float
     * @throws \Exception if not a float
     */
    public static function validateFloat(float $float) :float
    {
        if (is_float($float)) {
            return $float;
        } else {
            throw new \Exception('Not a valid float');
        }
    }

    /**
     * Sanitise an input by trimming whitespace and stripping unwanted tags
     *
     * @param string $string
     * @return string, which will return the trimmed/sanitised string
     */
    public function sanitiseString(string $string) :string
    {
        $trimmed = trim($string);
        return filter_var($trimmed, FILTER_SANITIZE_STRING);
    }
}