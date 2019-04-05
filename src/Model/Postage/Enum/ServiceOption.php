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

/**
 * Class ServiceOption
 *
 * @package Fontis\Auspost\Model\Postage\Enum
 * @see https://auspost.com.au/pdfs/pac-api-update-2016.pdf
 */
class ServiceOption extends Enum
{
    const AUS_SERVICE_OPTION_COD_MONEY_COLLECTION = 'AUS_SERVICE_OPTION_COD_MONEY_COLLECTION';

    const AUS_SERVICE_OPTION_COD_POSTAGE_FEES = 'AUS_SERVICE_OPTION_COD_POSTAGE_FEES';

    const AUS_SERVICE_OPTION_COURIER_EXTRA_COVER_SERVICE = 'AUS_SERVICE_OPTION_COURIER_EXTRA_COVER_SERVICE';

    const AUS_SERVICE_OPTION_DELIVERY_CONFIRMATION = 'AUS_SERVICE_OPTION_DELIVERY_CONFIRMATION';

    const AUS_SERVICE_OPTION_EXTRA_COVER = 'AUS_SERVICE_OPTION_EXTRA_COVER';

    const AUS_SERVICE_OPTION_PERSON_TO_PERSON = 'AUS_SERVICE_OPTION_PERSON_TO_PERSON';

    const AUS_SERVICE_OPTION_SIGNATURE_ON_DELIVERY = 'AUS_SERVICE_OPTION_SIGNATURE_ON_DELIVERY';

    const AUS_SERVICE_OPTION_STANDARD = 'AUS_SERVICE_OPTION_STANDARD';

    const AUS_SERVICE_OPTION_REGISTERED_POST = 'AUS_SERVICE_OPTION_REGISTERED_POST';

    const INTL_SERVICE_OPTION_EXTRA_COVER = 'INTL_SERVICE_OPTION_EXTRA_COVER';

    const INT_SIGNATURE_ON_DELIVERY = 'INT_SIGNATURE_ON_DELIVERY';
}
