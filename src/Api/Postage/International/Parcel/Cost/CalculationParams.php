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

namespace Fontis\Auspost\Api\Postage\International\Parcel\Cost;

use Fontis\Auspost\Helper\Validation;

class CalculationParams
{
    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var float The letter weight in grams.
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
     * @param string $countryCode
     * @param float $weight
     * @param string $serviceCode
     * @param string|null $optionCode
     * @param string|null $subOptionCode
     * @param float|null $extraCover
     */
    public function __construct(
        string $countryCode,
        float $weight,
        string $serviceCode,
        ?string $optionCode = null,
        ?string $subOptionCode = null,
        ?float $extraCover = null
    ) {
        Validation::notNull($countryCode);
        Validation::notNull($weight);
        Validation::notNull($serviceCode);

        $this->countryCode = $countryCode;
        $this->weight = $weight;
        $this->serviceCode = $serviceCode;
        $this->optionCode = $optionCode;
        $this->subOptionCode = $subOptionCode;
        $this->extraCover = $extraCover;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
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
