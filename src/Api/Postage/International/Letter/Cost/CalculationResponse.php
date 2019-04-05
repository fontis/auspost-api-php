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

namespace Fontis\Auspost\Api\Postage\International\Letter\Cost;

use Fontis\Auspost\Model\Postage\Cost;
use Fontis\Auspost\Model\Postage\CostCollection;

final class CalculationResponse
{
    /**
     * @var string
     */
    private $service;

    /**
     * @var float
     */
    private $totalCost;

    /**
     * @var Cost[]
     */
    private $costs = [];

    /**
     * @param string $service
     * @param float $totalCost
     * @param CostCollection $costs
     */
    public function __construct(
        string $service,
        float $totalCost,
        CostCollection $costs
    ) {
        $this->service = $service;
        $this->totalCost = $totalCost;
        $this->costs = $costs;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @return float
     */
    public function getTotalCost(): float
    {
        return $this->totalCost;
    }

    /**
     * @return CostCollection
     */
    public function getCosts(): CostCollection
    {
        return $this->costs;
    }
}
