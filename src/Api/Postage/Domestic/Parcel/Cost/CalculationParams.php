<?php
/**
 * Fontis Australia Post API client library for PHP
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/osl-3.0.php
 *
 * @category   Fontis
 * @package    Fontis_Auspost
 * @copyright  Copyright (c) 2019 Fontis Pty. Ltd. (https://www.fontis.com.au)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

declare(strict_types=1);

namespace Fontis\Auspost\Api\Postage\Domestic\Parcel\Cost;

use Fontis\Auspost\Helper\Validation;

final class CalculationParams
{
    /**
     * @var string
     */
    private $fromPostcode;

    /**
     * @var string
     */
    private $toPostcode;

    /**
     * @var float The parcel length in centimeters.
     */
    private $length;

    /**
     * @var float The parcel width in centimeters
     */
    private $width;

    /**
     * @var float The parcel height in centimeters.
     */
    private $height;

    /**
     * @var float The parcel weight in kilograms.
     */
    private $weight;

    /**
     * @var string
     */
    private $serviceCode;

    /**
     * @var string|null
     */
    private $optionCode;

    /**
     * @var string|null
     */
    private $subOptionCode;

    /**
     * @var float|null The dollar amount of the extra cover required.
     */
    private $extraCover;

    /**
     * @param string $fromPostcode
     * @param string $toPostcode
     * @param float $length
     * @param float $width
     * @param float $height
     * @param float $weight
     * @param string $serviceCode
     * @param string|null $optionCode
     * @param string|null $subOptionCode
     * @param float|null $extraCover
     */
    public function __construct(
        string $fromPostcode,
        string $toPostcode,
        float $length,
        float $width,
        float $height,
        float $weight,
        string $serviceCode,
        ?string $optionCode = null,
        ?string $subOptionCode = null,
        ?float $extraCover = null
    ) {
        Validation::notNull($fromPostcode);
        Validation::notNull($toPostcode);
        Validation::notNull($weight);

        $this->fromPostcode = $fromPostcode;
        $this->toPostcode = $toPostcode;
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->weight = $weight;
        $this->serviceCode = $serviceCode;
        $this->optionCode = $optionCode;
        $this->subOptionCode = $subOptionCode;
        $this->extraCover = $extraCover;
    }

    /**
     * @return string
     */
    public function getFromPostcode(): string
    {
        return $this->fromPostcode;
    }

    /**
     * @return string
     */
    public function getToPostcode(): string
    {
        return $this->toPostcode;
    }

    /**
     * @return float
     */
    public function getLength(): float
    {
        return $this->length;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @return string
     */
    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    /**
     * @return string
     */
    public function getOptionCode(): ?string
    {
        return $this->optionCode;
    }

    /**
     * @return string
     */
    public function getSubOptionCode(): ?string
    {
        return $this->subOptionCode;
    }

    /**
     * @return float
     */
    public function getExtraCover(): ?float
    {
        return $this->extraCover;
    }
}
