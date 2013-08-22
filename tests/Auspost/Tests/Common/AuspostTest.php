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
namespace Auspost\Tests\Common;

use Auspost\Common\Auspost;

/**
 * @covers Auspost\Common\Auspost
 */
class AuspostTest extends \Guzzle\Tests\GuzzleTestCase
{
    public function provider()
    {
        return array(
            array('deliverychoice', array(
                'email_address' => 'gaben@valvesoftware.com',
                'password' => 'MoolyFTW'
            )),
            array('postage', array(
                'auth_key' => 'e53060fe-01e4-4b50-bed4-b0335f71a9bb'
            ))
        );
    }

    /**
     * @covers \Auspost\Common\Auspost::factory
     * @dataProvider provider
     */
    public function testFactoryInstantiatesAuspostObjectUsingDefaultConfig(
        $service
    ) {
        $builder = Auspost::factory();
        $this->assertTrue($builder->offsetExists($service));
        $this->assertArrayHasKey($service, $builder->getConfig());
    }

    /**
     * @covers \Auspost\Common\Auspost::factory
     * @dataProvider provider
     */
    public function testTreatsArrayInFirstArgAsGlobalParametersUsingDefaultConfigFile(
        $service, $config
    ) {
        $builder = Auspost::factory($config);
        foreach ($config as $key => $value) {
            $this->assertEquals($value, $builder->get($service)->getConfig($key));
        }
    }

    /**
     * @covers \Auspost\Common\Auspost::getDefaultServiceDefinition
     */
    public function testReturnsDefaultConfigPath()
    {
        $this->assertContains('config.json', Auspost::getDefaultServiceDefinition());
    }
}
