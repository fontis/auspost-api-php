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

namespace Fontis\Auspost\Api\Postage\Domestic\Letter\Services;

use Fontis\Auspost\Helper\Validation;

class GetServicesParams
{
    /**
     * @var float The letter length in millimeters.
     */
    private $length;

    /**
     * @var float The letter width in millimeters.
     */
    private $width;

    /**
     * @var float The letter thickness in millimeters.
     */
    private $thickness;

    /**
     * @var float The letter weight in grams.
     */
    private $weight;

    /**
     * @param float $length
     * @param float $width
     * @param float $thickness
     * @param float $weight
     */
    public function __construct(float $length, float $width, float $thickness, float $weight)
    {
        Validation::notNull($weight);

        $this->length = $length;
        $this->width = $width;
        $this->thickness = $thickness;
        $this->weight = $weight;
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
    public function getThickness(): float
    {
        return $this->thickness;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }
}
