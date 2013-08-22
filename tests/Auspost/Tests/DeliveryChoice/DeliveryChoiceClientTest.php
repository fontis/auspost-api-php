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
namespace Auspost\Tests\DeliveryChoice;

use Auspost\DeliveryChoice\DeliveryChoiceClient;

/**
 * @covers Auspost\DeliveryChoice\DeliveryChoiceTest
 */
class DeliveryChoiceClientTest extends \Guzzle\Tests\GuzzleTestCase
{
    /**
     * @covers Auspost\Postage\DeliveryChoiceClient::factory
     * @dataProvider provider
     */
    public function testFactoryInitalisesClientInDeveloperMode(
        $userEmail,
        $userPwd,
        $developerMode = true,
        $reqUrl = 'https://devcentre.auspost.com.au/myapi',
        $reqEmail = 'anonymous@auspost.com.au',
        $reqPwd = 'password'
    ) {
        $client = DeliveryChoiceClient::factory(array(
            'developer_mode' => $developerMode,
            'email_address' => $userEmail,
            'password' => $userPwd
        ));
        $this->assertEquals($developerMode, $client->getConfig('developer_mode'));
        $this->assertEquals($reqUrl, $client->getBaseUrl());
        $this->assertEquals($reqEmail, $client->getConfig('email_address'));
        $this->assertEquals($reqPwd, $client->getConfig('password'));
    }

    public function provider()
    {
        return array(
            array('cthon98@gmail.com', 'hunter2'),
            array('cthon98@gmail.com', 'hunter2', false, 'https://api.auspost.com.au', 'cthon98@gmail.com', 'hunter2'),
        );
    }
}
