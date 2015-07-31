<?php

namespace MrColor\Types;

use MrColor\Types\Transformers\RgbToHex;
use MrColor\Types\Transformers\RgbToHsl;

/**
 * Class RGB
 * @package MrColor\Types
 */
class RGB extends ColorType
{
    /**
     * @param int    $red
     * @param int    $green
     * @param int    $blue
     * @param double $alpha
     */
    public function __construct($red = 255, $green = 255, $blue = 255, $alpha = 1.0)
    {
        $this->setAttributes([
            'red' => $red,
            'green' => $green,
            'blue' => $blue,
            'alpha' => $alpha > 1 ? $alpha / 100 : $alpha
        ]);
    }

    /**
     * @return Hex
     */
    public function toHex()
    {
        return $this->transform(new RgbToHex(), Hex::class);
    }

    /**
     * @return HSL
     */
    public function toHsl()
    {
        return $this->transform(new RgbToHsl(), HSL::class);
    }

    /**
     * @return RGB
     */
    public function toRgb()
    {
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        list($red, $green, $blue) = $this->getValues();

        return "rgb($red, $green, $blue)";
    }

    /**
     * Return JSON represenation of this object
     *
     * @param int $options
     *
     * @return mixed
     */
    public function toJson($options = 0)
    {
        $values = $this->getValues();

        return json_encode(['rgb' => $values, 'css' => $this->__toString()], $options);
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return [
            $this->getAttribute('red'),
            $this->getAttribute('green'),
            $this->getAttribute('blue')
        ];
    }
}
