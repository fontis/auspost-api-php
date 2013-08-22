<?php
/**
 * This file is part of Auspost API Client Library for PHP.
 *
 * The Auspost API Client Library for PHP is free software: you can redistribute
 * it and/or modify it under the terms of the GNU Lesser General Public License
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * The Auspost API Client Library for PHP is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser
 * General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with the Auspost API Client Library for PHP.  If not, see
 * <http://www.gnu.org/licenses/>.
 *
 * @category   Fontis
 * @package    auspost-api-php
 * @author     Thai Phan
 * @copyright  Copyright (c) 2013 Fontis Pty Ltd (http://www.fontis.com.au)
 * @license    http://opensource.org/licenses/LGPL-3.0 GNU Lesser General Public License (LGPL 3.0)
 */
namespace Auspost\Postage\Enum;

use Auspost\Common\Enum;

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
    const INTL_SERVICE_OPTION_CONFIRM_DELIVERY = 'INTL_SERVICE_OPTION_CONFIRM_DELIVERY';
    const INTL_SERVICE_OPTION_EXTRA_COVER = 'INTL_SERVICE_OPTION_EXTRA_COVER';
    const INTL_SERVICE_OPTION_PICKUP_METRO = 'INTL_SERVICE_OPTION_PICKUP_METRO';
}
