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

namespace Fontis\Auspost\Model\Postage;

class Service
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var float|null
     */
    private $maxExtraCover;

    /**
     * @var array|null
     */
    private $options;

    /**
     * @param string $code
     * @param string $name
     * @param float $price
     * @param float|null $maxExtraCover
     * @param OptionCollection|null $option
     */
    public function __construct(
        string $code,
        string $name,
        float $price,
        ?float $maxExtraCover = null,
        ?OptionCollection $option = null
    ) {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
        $this->maxExtraCover = $maxExtraCover;
        $this->options = $option;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getMaxExtraCover(): ?float
    {
        return $this->maxExtraCover;
    }

    /**
     * @return OptionCollection
     */
    public function getOptions(): ?OptionCollection
    {
        return $this->options;
    }
}
