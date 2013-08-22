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
namespace Auspost\Postage;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

/**
 * Client to interact with Postage Assessment Calculator and Postcode Search
 * services
 */
class PostageClient extends Client
{
    public static function factory($config = array())
    {
        if (isset($config['developer_mode']) && is_bool($config['developer_mode'])) {
            $developerMode = $config['developer_mode'];
        } else {
            $developerMode = false;
        }

        $baseUrl = array(
            'https://auspost.com.au',
            'https://test.npe.auspost.com.au'
        );

        // Ignore unnecessary user-specified configuration values
        if ($developerMode) {
            unset($config['auth_key']);
        }
        unset($config['base_url']);

        $default = array(
            'developer_mode' => $developerMode,
            'base_url' => $baseUrl[$developerMode],
            'auth_key' => '28744ed5982391881611cca6cf5c2409'
        );

        $required = array(
            'developer_mode',
            'base_url',
            'auth_key'
        );

        $config = Collection::fromConfig($config, $default, $required);

        $client =  new self($config->get('base_url'), $config);

        $client->getConfig()->setPath('request.options/headers/Accept', 'application/json');
        $client->getConfig()->setPath('request.options/headers/Auth-Key', $config->get('auth_key'));
        $client->setDescription(ServiceDescription::factory(__DIR__ . '/service.json'));
        $client->setSslVerification(false);

        return $client;
    }
}
