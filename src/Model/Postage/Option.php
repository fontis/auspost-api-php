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

use Fontis\Auspost\Model\Postage\OptionCollection;

final class Option
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $code;

    /**
     * @var OptionCollection|null
     */
    private $subOptions;

    /**
     * @param string $code
     * @param string $name
     * @param OptionCollection|null $subOption
     */
    public function __construct(string $code = null, string $name = null, ?OptionCollection $subOption = null)
    {
        $this->code = $code;
        $this->name = $name;
        $this->subOptions = $subOption;
    }

    /**
     * @return string|null
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
     * @return OptionCollection
     */
    public function getSubOptions(): ?OptionCollection
    {
        return $this->subOptions;
    }
}
