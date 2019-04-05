<?php
/**
 * Fontis Australia Post API client library for PHP
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Fontis
 * @package    Fontis_Auspost
 * @copyright  Copyright (c) 2019 Fontis Pty. Ltd. (https://www.fontis.com.au)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

declare(strict_types=1);

namespace Fontis\Auspost\Model\Postage\Enum;

use Fontis\Auspost\Model\Enum;

class ServiceCode extends Enum
{
    const AUS_LETTER_EXPRESS_SMALL = 'AUS_LETTER_EXPRESS_SMALL';

    const AUS_LETTER_REGULAR_LARGE = 'AUS_LETTER_REGULAR_LARGE';

    const AUS_PARCEL_REGULAR = 'AUS_PARCEL_REGULAR';

    const AUS_PARCEL_EXPRESS = 'AUS_PARCEL_EXPRESS';

    const AUS_PARCEL_COURIER = 'AUS_PARCEL_COURIER';

    const AUS_PARCEL_COURIER_SATCHEL_MEDIUM = 'AUS_PARCEL_COURIER_SATCHEL_MEDIUM';

    const INT_PARCEL_AIR_OWN_PACKAGING = 'INT_PARCEL_AIR_OWN_PACKAGING';

    const INT_LETTER_COR_OWN_PACKAGING = 'INT_LETTER_COR_OWN_PACKAGING';

    const INT_PARCEL_EXP_OWN_PACKAGING = 'INT_PARCEL_EXP_OWN_PACKAGING';

    const INT_PARCEL_SEA_OWN_PACKAGING = 'INT_PARCEL_SEA_OWN_PACKAGING';

    const INT_PARCEL_STD_OWN_PACKAGING = 'INT_PARCEL_STD_OWN_PACKAGING';

    const INTL_SERVICE_EPI_B4 = 'INTL_SERVICE_EPI_B4';

    const INTL_SERVICE_EPI_C5 = 'INTL_SERVICE_EPI_C5';

    const INTL_SERVICE_RPI_B4 = 'INTL_SERVICE_RPI_B4';

    const INTL_SERVICE_RPI_DLE = 'INTL_SERVICE_RPI_DLE';

}
