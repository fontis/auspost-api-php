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

class ServiceCode extends Enum
{
    const AUS_LETTER_EXPRESS_SMALL = 'AUS_LETTER_EXPRESS_SMALL';
    const AUS_LETTER_REGULAR_LARGE = 'AUS_LETTER_REGULAR_LARGE';
    const AUS_PARCEL_REGULAR = 'AUS_PARCEL_REGULAR';
    const AUS_PARCEL_EXPRESS = 'AUS_PARCEL_EXPRESS';
    const AUS_PARCEL_COURIER = 'AUS_PARCEL_COURIER';
    const AUS_PARCEL_COURIER_SATCHEL_MEDIUM = 'AUS_PARCEL_COURIER_SATCHEL_MEDIUM';
    const INTL_SERVICE_AIR_MAIL = 'INTL_SERVICE_AIR_MAIL';
    const INTL_SERVICE_ECI_D = 'INTL_SERVICE_ECI_D';
    const INTL_SERVICE_ECI_M = 'INTL_SERVICE_ECI_M';
    const INTL_SERVICE_ECI_PLATINUM = 'INTL_SERVICE_ECI_PLATINUM';
    const INTL_SERVICE_EPI = 'INTL_SERVICE_EPI';
    const INTL_SERVICE_EPI_B4 = 'INTL_SERVICE_EPI_B4';
    const INTL_SERVICE_EPI_C5 = 'INTL_SERVICE_EPI_C5';
    const INTL_SERVICE_PTI = 'INTL_SERVICE_PTI';
    const INTL_SERVICE_RPI_B4 = 'INTL_SERVICE_RPI_B4';
    const INTL_SERVICE_RPI_DLE = 'INTL_SERVICE_RPI_DLE';
    const INTL_SERVICE_SEA_MAIL = 'INTL_SERVICE_SEA_MAIL';
}
