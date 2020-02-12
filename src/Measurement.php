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
        'litre' => 1,
        'l' => 1,
        'milliliters' => 0.001,
        'ml' => 0.001,
    ];

    /**
     * Volume in liters
     *
     * @var array
     */
    private const MASS_TO_KILOGRAM = [
        'ounces' =>	0.0283495,
        'pounds' =>	0.453592,
        'stones' =>	6.35029,
        'long_tons' =>	1016.05,
        'short_tons' =>	907.185,
        'milligrams' =>	0.000001,
        'grams' =>	0.001,
        'gm' =>	0.001,
        'kilograms' =>	1,
        'metric_tonnes' =>	1000
    ];

    /**
     * Default volume measurement type
     *
     * Used when summing multiple different types and
     * you need a standard.
     *
     * @var string
     */
    protected $defaultVolumeMeasure = 'ml';

    /**
     * Default volume measurement type
     *
     * Used when summing multiple different types and
     * you need a standard.
     *
     * @var string
     */
    protected $defaultMassMeasure = 'gm';

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

        throw new \Exception('Unsupported unit: ' . $fromUnit);
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

        throw new \Exception('Unsupported unit: ' . $toUnit);
    }

    /**
     * Convert volume from unit to unit
     *
     * @param float|string $value
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
     * Convert to kilograms
     *
     * @param float $value
     * @param string $fromUnit
     * @return float
     */
    protected function convertToKilograms($value, $fromUnit)
    {
        if(array_key_exists($fromUnit, self::MASS_TO_KILOGRAM)) {
            return $value * self::MASS_TO_KILOGRAM[$fromUnit];
        }

        throw new \Exception('Unsupported unit: ' . $fromUnit);
    }

    /**
     * Convert from kilograms
     *
     * @param float $value
     * @param string $toUnit
     * @return float
     */
    protected function convertFromKilograms($value, $toUnit)
    {
        if(array_key_exists($toUnit, self::MASS_TO_KILOGRAM)) {
            return $value / self::MASS_TO_KILOGRAM[$toUnit];
        }

        throw new \Exception('Unsupported unit: ' . $toUnit);
    }

    /**
     * Convert mass from unit to unit
     *
     * @param float|string $value
     * @param string $fromUnit
     * @param string|null $toUnit
     * @return float
     */
    public function convertMass($value, $fromUnit, $toUnit=null)
    {
        // The value contains the fromUnit; We need to extract
        // it and update the parameters.
        if (is_string($value) && $toUnit === null) {
            preg_match('/(\d+)(.+)/m', $value, $m);

            $value  = $m[1];
            $toUnit = $fromUnit;
            $fromUnit = trim($m[2]);
        }

        return $this->convertFromKilograms(
            $this->convertToKilograms($value, $fromUnit),
            $toUnit
        );
    }

    /**
     * Convert value to default measurement
     *
     * @param string $value
     * @return void
     */
    public function convert($value)
    {
        $measurementType = $this->getMeasurementType($value);

        if ($measurementType == 'volume') {
            return $this->convertVolume($value, $this->defaultVolumeMeasure);
        }

        if ($measurementType == 'mass') {
            return $this->convertMass($value, $this->defaultMassMeasure);
        }

        return 0;
    }

    /**
     * Get default volume measurement type
     *
     * Used when summing multiple different types and
     * you need a standard.
     *
     * @return string
     */
    public function getDefaultVolumeMeasurement()
    {
        return $this->defaultVolumeMeasure;
    }

    /**
     * Get default mass measurement type
     *
     * Used when summing multiple different types and
     * you need a standard.
     *
     * @return string
     */
    public function getDefaultMassMeasurement()
    {
        return $this->defaultMassMeasure;
    }

    /**
     * Get default measurement type for a value
     *
     * Used when summing multiple different types and
     * you need a standard.
     *
     * @return string
     */
    public function getDefaultMeasurementForValue($value)
    {
        $measurementType = $this->getMeasurementType($value);

        if ($measurementType == 'volume') {
            return $this->getDefaultVolumeMeasurement();
        }

        if ($measurementType == 'mass') {
            return $this->getDefaultMassMeasurement();
        }

        return '';
    }

    /**
     * Extract the amount from a value
     *
     * @param string $value
     * @return float
     */
    public function extractAmount($value)
    {
        preg_match('/(\d+)(.+)/m', $value, $m);

        if ( ! isset($m[1])) {
            return 0;
        }

        return trim($m[1]);
    }

    /**
     * Extract the amount from a value
     *
     * @param string $value
     * @return float
     */
    public function extractType($value)
    {
        preg_match('/(\d+)(.+)/m', $value, $m);

        if ( ! isset($m[2])) {
            return '';
        }

        return trim($m[2]);
    }

    /**
     * Check if value is supported
     *
     * @param string $value
     * @return boolean
     */
    public function supported($value)
    {
        $type = $this->extractType($value);

        return isset(self::VOLUME_TO_LITER[$type])
            || isset(self::MASS_TO_KILOGRAM[$type]);
    }

    /**
     * Get measurement type; volume or mass
     *
     * @param string $value
     * @return string|null
     */
    public function getMeasurementType($value)
    {
        $type = $this->extractType($value);

        if (isset(self::VOLUME_TO_LITER[$type])) {
            return 'volume';
        } else if (isset(self::MASS_TO_KILOGRAM[$type])) {
            return 'mass';
        }

        return null;
    }
}
