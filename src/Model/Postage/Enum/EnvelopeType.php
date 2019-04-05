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

namespace Fontis\Auspost\Model\Postage\Enum;

use Fontis\Auspost\Model\Enum;

class EnvelopeType extends Enum
{
    const INTL_ENVELOPE_TYPE_POSTCARD = 'INTL_ENVELOPE_TYPE_POSTCARD';

    const INTL_ENVELOPE_TYPE_UP_TO_50G = 'INTL_ENVELOPE_TYPE_UP_TO_50G';

    const INTL_ENVELOPE_TYPE_50G_250G = 'INTL_ENVELOPE_TYPE_50G_250G';

    const INTL_ENVELOPE_TYPE_250G_500G = 'INTL_ENVELOPE_TYPE_250G_500G';
}
