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

final class OptionCollection implements IteratorAggregate, Countable
{
    /**
     * @var array
     */
    private $options;

    /**
     * @param Option[] $options
     */
    public function __construct(array $options = [])
    {
        $this->options = array_values($options);
    }

    /**
     * @return Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->options);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->options);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->options);
    }

    /**
     * @return Option
     * @throws EmptyCollection If the collection is empty.
     */
    public function first(): Option
    {
        if ($this->isEmpty()) {
            throw new EmptyCollection();
        }

        return reset($this->options);
    }

    /**
     * @param int $index
     * @return Option
     * @throws OutOfBoundsException If the index param is not existed.
     */
    public function get(int $index): Option
    {
        if (!isset($this->options[$index])) {
            throw new OutOfBoundsException(sprintf('The index "%s" does not exist in this collection.', $index));
        }

        return $this->options[$index];
    }
}
