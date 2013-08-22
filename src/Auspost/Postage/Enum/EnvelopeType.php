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

class EnvelopeType extends Enum
{
    const INTL_ENVELOPE_TYPE_POSTCARD = 'INTL_ENVELOPE_TYPE_POSTCARD';
    const INTL_ENVELOPE_TYPE_UP_TO_50G = 'INTL_ENVELOPE_TYPE_UP_TO_50G';
    const INTL_ENVELOPE_TYPE_50G_250G = 'INTL_ENVELOPE_TYPE_50G_250G';
    const INTL_ENVELOPE_TYPE_250G_500G = 'INTL_ENVELOPE_TYPE_250G_500G';
}
