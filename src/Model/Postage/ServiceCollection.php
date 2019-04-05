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

use ArrayIterator;
use Countable;
use Fontis\Auspost\Exception\EmptyCollection;
use IteratorAggregate;
use OutOfBoundsException;
use Traversable;

final class ServiceCollection implements IteratorAggregate, Countable
{
    /**
     * @var array
     */
    private $postageServices;

    /**
     * @param Service[] $postageServices
     */
    public function __construct(array $postageServices = [])
    {
        $this->postageServices = array_values($postageServices);
    }

    /**
     * @return Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->postageServices);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->postageServices);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->postageServices);
    }

    /**
     * @return Service
     * @throws EmptyCollection If the collection is empty.
     */
    public function first(): Service
    {
        if ($this->isEmpty()) {
            throw new EmptyCollection();
        }

        return reset($this->postageServices);
    }

    /**
     * @param int $index
     * @return Service
     * @throws OutOfBoundsException If the index param is not existed.
     */
    public function get(int $index): Service
    {
        if (!isset($this->postageServices[$index])) {
            throw new OutOfBoundsException(sprintf('The index "%s" does not exist in this collection.', $index));
        }

        return $this->postageServices[$index];
    }
}
