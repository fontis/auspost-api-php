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

namespace Fontis\Auspost\Api\Postage\International\Parcel\Services;

use Fontis\Auspost\Helper\Validation;

class GetServiceParams
{
    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var float The parcel weight in kilograms.
     */
    private $weight;

    /**
     * @param string $countryCode
     * @param float $weight
     */
    public function __construct(
        string $countryCode,
        float $weight
    ) {
        Validation::notNull($countryCode);
        Validation::notNull($weight);

        $this->countryCode = $countryCode;
        $this->weight = $weight;
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
}
