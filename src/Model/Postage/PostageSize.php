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

final class PostageSize
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $code;

    /**
     * @var string|null
     */
    private $value;

    /**
     * @param string $code
     * @param string $name
     * @param string|null $value
     */
    public function __construct(string $code, string $name, ?string $value = null)
    {
        $this->code = $code;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
    public function getValue(): ?string
    {
        return $this->value;
    }
}
