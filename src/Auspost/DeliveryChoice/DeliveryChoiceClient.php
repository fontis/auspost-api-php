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
namespace Auspost\DeliveryChoice;

use Guzzle\Common\Collection;
use Guzzle\Common\Event;
use Guzzle\Plugin\Cookie\Cookie;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

class DeliveryChoiceClient extends Client
{
    public static function factory($config = array())
    {
        if (isset($config['developer_mode']) && is_bool($config['developer_mode'])) {
            $developerMode = $config['developer_mode'];
        } else {
            $developerMode = false;
        }

        $baseUrl = array(
            'https://api.auspost.com.au',
            'https://devcentre.auspost.com.au/myapi'
        );

        // Ignore unnecessary user-specified configuration values
        if ($developerMode) {
            unset($config['email_address']);
            unset($config['password']);
        }
        unset($config['base_url']);

        $default = array(
            'developer_mode' => $developerMode,
            'base_url' => $baseUrl[$developerMode],
            'email_address' => 'anonymous@auspost.com.au',
            'password' => 'password'
        );

        $required = array(
            'developer_mode',
            'base_url',
            'email_address',
            "password"
        );

        $config = Collection::fromConfig($config, $default, $required);

        $client =  new self($config->get('base_url'), $config);

        $client->getConfig()->setPath(
            'request.options/headers/Authorization',
            'Basic ' . base64_encode($config->get('email_address') . ':' . $config->get('password'))
        );
        $client->setDescription(ServiceDescription::factory(__DIR__ . '/service.json'));
        $client->setSslVerification(false);

        $client->getEventDispatcher()->addListener('request.before_send', function (Event $event) {
            $request = $event['request'];
            $request->addCookie('OBBasicAuth', 'fromDialog');
        });

        return $client;
    }
}
