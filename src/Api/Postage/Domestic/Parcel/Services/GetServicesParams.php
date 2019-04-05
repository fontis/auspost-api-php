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

namespace Fontis\Auspost\Api\Postage\Domestic\Parcel\Services;

use Fontis\Auspost\Helper\Validation;

final class GetServicesParams
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
     * @var float The parcel width in centimeters.
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
     * @param string $fromPostcode
     * @param string $toPostcode
     * @param float $length
     * @param float $width
     * @param float $height
     * @param float $weight
     */
    public function __construct(
        string $fromPostcode,
        string $toPostcode,
        float $length,
        float $width,
        float $height,
        float $weight
    ) {
        Validation::notNull($fromPostcode);
        Validation::notNull($toPostcode);

        $this->fromPostcode = $fromPostcode;
        $this->toPostcode = $toPostcode;
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->weight = $weight;
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
}
