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

namespace Fontis\Auspost\Api\Postage\Domestic\Postcode;

final class PostcodeSearchParams
{
    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $state;

    /**
     * @var bool
     */
    private $excludePostboxFlag;

    /**
     * @param string $query
     * @param string $state
     * @param bool $excludePostboxFlag
     */
    public function __construct(string $query, string $state = '', bool $excludePostboxFlag = false)
    {
        $this->query = $query;
        $this->state = $state;
        $this->excludePostboxFlag = $excludePostboxFlag;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return bool
     */
    public function isExcludePostboxFlag(): bool
    {
        return $this->excludePostboxFlag;
    }
}
