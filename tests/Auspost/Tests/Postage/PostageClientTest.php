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
namespace Auspost\Tests\Postage;

use Auspost\Postage\PostageClient;

/**
 * @covers Auspost\Postage\PostageClient
 */
class PostageClientTest extends \Guzzle\Tests\GuzzleTestCase
{
    /**
     * @covers Auspost\Postage\PostageClient::factory
     * @dataProvider provider
     */
    public function testFactoryInitalisesClient(
        $userAuthKey,
        $developerMode = true,
        $reqUrl = 'https://test.npe.auspost.com.au',
        $reqAuthKey = '28744ed5982391881611cca6cf5c2409'
    ) {
        $client = PostageClient::factory(array(
            'developer_mode' => $developerMode,
            'auth_key' => $userAuthKey
        ));
        $this->assertEquals($developerMode, $client->getConfig('developer_mode'));
        $this->assertEquals($reqUrl, $client->getBaseUrl());
        $this->assertEquals($reqAuthKey, $client->getConfig('auth_key'));
    }

    public function provider()
    {
        return array(
            array('e53060fe-01e4-4b50-bed4-b0335f71a9bb'),
            array('e53060fe-01e4-4b50-bed4-b0335f71a9bb', false, 'https://auspost.com.au', 'e53060fe-01e4-4b50-bed4-b0335f71a9bb'),
        );
    }
}
