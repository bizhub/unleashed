<?php

namespace Bizhub\Unleashed;

class Measurement
{
    /**
     * Volume in liters
     *
     * @var array
     */
    private const VOLUME_TO_LITER = [
        'cubic_inches' => 0.0163871,
        'cubic_feet' => 28.3168,
        'cubic_centimeters' => 0.001,
        'cubic_meters' => 1000,
        'imperial_gallons' => 4.54609,
        'imperial_quarts' => 1.13652,
        'imperial_pints' => 0.568261,
        'imperial_cups' => 0.284131,
        'imperial_ounces' => 0.0284131,
        'imperial_tablespoons' => 0.0177582,
        'imperial_teaspoons' => 0.00591939,
        'us_gallons' => 3.78541,
        'us_quarts' => 0.946353,
        'us_pints' => 0.473176,
        'us_cups' => 0.24,
        'us_ounces' => 0.0295735,
        'us_tablespoons' => 0.0147868,
        'us_teaspoons' => 0.00492892,
        'liters' => 1,
        'l' => 1,
        'milliliters' => 0.001,
        'ml' => 0.001,
    ];

    /**
     * Convert value to litres
     *
     * @param float $value
     * @param string $fromUnit
     * @return float
     */
    protected function convertToLitres($value, $fromUnit)
    {
        if(array_key_exists($fromUnit, self::VOLUME_TO_LITER)) {
            return $value * self::VOLUME_TO_LITER[$fromUnit];
        }

        throw new \Exception('Unsupported unit.');
    }

    /**
     * Convert value from litres
     *
     * @param float $value
     * @param string $toUnit
     * @return float
     */
    protected function convertFromLitres($value, $toUnit)
    {
        if(array_key_exists($toUnit, self::VOLUME_TO_LITER)) {
            return $value / self::VOLUME_TO_LITER[$toUnit];
        }

        throw new \Exception('Unsupported unit.');
    }

    /**
     * Convert volume from unit to unit
     *
     * @param float $value
     * @param string $fromUnit
     * @param string|null $toUnit
     * @return float
     */
    public function convertVolume($value, $fromUnit, $toUnit=null)
    {
        // The value contains the fromUnit; We need to extract
        // it and update the parameters.
        if (is_string($value) && $toUnit === null) {
            preg_match('/(\d+)(.+)/m', $value, $m);

            $value  = $m[1];
            $toUnit = $fromUnit;
            $fromUnit = trim($m[2]);
        }

        return $this->convertFromLitres(
            $this->convertToLitres($value, strtolower($fromUnit)),
            strtolower($toUnit)
        );
    }

    /**
     * Check if value is supported
     *
     * @param string $value
     * @return boolean
     */
    public function supported($value)
    {
        preg_match('/(\d+)(.+)/m', $value, $m);

        if ( ! isset($m[2])) {
            return false;
        }

        return isset(self::VOLUME_TO_LITER[trim($m[2])]);
    }
}
