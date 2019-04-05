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

final class Locality
{
    /**
     * @var string
     */
    private $category;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $state;

    /**
     * @var float|null
     */
    private $latitude;

    /**
     * @var float|null
     */
    private $longitude;

    /**
     * @param string $category
     * @param int $id
     * @param string $location
     * @param string $postcode
     * @param string $state
     * @param float|null $latitude
     * @param float|null $longitude
     */
    public function __construct(
        string $category,
        int $id,
        string $location,
        string $postcode,
        string $state,
        ?float $latitude = null,
        ?float $longitude = null
    ) {
        $this->category = $category;
        $this->id = $id;
        $this->location = $location;
        $this->postcode = $postcode;
        $this->state = $state;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return float
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }
}
