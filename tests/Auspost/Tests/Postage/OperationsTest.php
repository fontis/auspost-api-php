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

use Auspost\Common\Auspost;
use Auspost\Postage\Enum\EnvelopeType;
use Auspost\Postage\Enum\ServiceCode;
use Auspost\Postage\Enum\ServiceOption;
use Auspost\Postage\PostageClient;

class OperationsTest extends \Guzzle\Tests\GuzzleTestCase
{
    /** @var PostageClient */
    private $client;

    public function setUp()
    {
        $this->client = self::getServiceBuilder()->get('postage', true);
    }

    public function testListCountries()
    {
        $this->setMockResponse(
            $this->client,
            array('postage/list_countries')
        );

        $response = $this->client->listCountries();
        $this->assertArrayHasKey('countries', $response);
        $this->assertArrayHasKey('country', $response['countries']);
        $countries = array();
        foreach ($response['countries']['country'] as $country) {
            $countries[$country['code']] = $country['name'];
        }
        $this->assertArrayNotHasKey('AU', $countries);
        $this->assertArrayHasKey('GB', $countries);
        $this->assertEquals('UNITED KINGDOM', $countries['GB']);
    }

    public function testListDomesticLetterSizes()
    {
        $this->setMockResponse(
            $this->client,
            array('postage/list_domestic_letter_sizes')
        );

        $response = $this->client->listDomesticLetterSizes();
        $this->assertArrayHasKey('sizes', $response);
        $this->assertArrayHasKey('size', $response['sizes']);
        $this->assertCount(6, $response['sizes']['size']);
    }

    public function testListDomesticLetterThicknesses()
    {
        $this->setMockResponse(
            $this->client,
            array('postage/list_domestic_letter_thicknesses')
        );

        $response = $this->client->listDomesticLetterThicknesses();
        $this->assertArrayHasKey('thicknesses', $response);
        $this->assertArrayHasKey('thickness', $response['thicknesses']);
        $this->assertCount(2, $response['thicknesses']['thickness']);
    }

    public function testListDomesticLetterWeights()
    {
        $this->setMockResponse(
            $this->client,
            array('postage/list_domestic_letter_weights')
        );

        $response = $this->client->listDomesticLetterWeights();
        $this->assertArrayHasKey('weights', $response);
        $this->assertArrayHasKey('weight', $response['weights']);
        $this->assertCount(3, $response['weights']['weight']);
    }

    public function testListDomesticParcelSizes()
    {
        $this->setMockResponse(
            $this->client,
            array('postage/list_domestic_parcel_sizes')
        );

        $response = $this->client->listDomesticParcelSizes();
        $this->assertArrayHasKey('sizes', $response);
        $this->assertArrayHasKey('size', $response['sizes']);
        $this->assertCount(9, $response['sizes']['size']);
    }

    public function testListDomesticParcelWeights()
    {
        $this->setMockResponse(
            $this->client,
            array('postage/list_domestic_parcel_weights')
        );

        $response = $this->client->listDomesticParcelWeights();
        $this->assertArrayHasKey('weights', $response);
        $this->assertArrayHasKey('weight', $response['weights']);
        $this->assertCount(23, $response['weights']['weight']);
    }

    public function testListInternationalLetterWeights()
    {
        $this->setMockResponse(
            $this->client,
            array('postage/list_international_letter_weights')
        );

        $response = $this->client->listInternationalLetterWeights();
        $this->assertArrayHasKey('weights', $response);
        $this->assertArrayHasKey('weight', $response['weights']);
        $this->assertCount(4, $response['weights']['weight']);
        $weights = $response['weights']['weight'];
        $codes = array();
        foreach ($weights as $weight) {
            if ($weight['code'] == EnvelopeType::INTL_ENVELOPE_TYPE_POSTCARD) {
                $this->assertArrayNotHasKey('value', $weight);
            } else {
                $this->assertArrayHasKey('value', $weight);
            }
            $codes[$weight['code']] = $weight['name'];
        }
        $this->assertArrayHasKey(EnvelopeType::INTL_ENVELOPE_TYPE_POSTCARD, $codes);
        $this->assertArrayHasKey(EnvelopeType::INTL_ENVELOPE_TYPE_UP_TO_50G, $codes);
        $this->assertArrayHasKey(EnvelopeType::INTL_ENVELOPE_TYPE_50G_250G, $codes);
        $this->assertArrayHasKey(EnvelopeType::INTL_ENVELOPE_TYPE_250G_500G, $codes);
        $this->assertEquals('Postcard/Greeting card', $codes[EnvelopeType::INTL_ENVELOPE_TYPE_POSTCARD]);
        $this->assertEquals('Up to 50g', $codes[EnvelopeType::INTL_ENVELOPE_TYPE_UP_TO_50G]);
        $this->assertEquals('>50g - 250g', $codes[EnvelopeType::INTL_ENVELOPE_TYPE_50G_250G]);
        $this->assertEquals('>250g - 500g', $codes[EnvelopeType::INTL_ENVELOPE_TYPE_250G_500G]);
    }

    public function testListInternationalParcelWeights()
    {
        $this->setMockResponse(
            $this->client,
            array('postage/list_international_parcel_weights')
        );

        $response = $this->client->listInternationalParcelWeights();
        $this->assertArrayHasKey('weights', $response);
        $this->assertArrayHasKey('weight', $response['weights']);
        $this->assertCount(40, $response['weights']['weight']);
    }

    public function testListDomesticLetterServices()
    {
        $this->setMockResponse(
            $this->client,
            array('postage/list_domestic_letter_services')
        );

        $response = $this->client->listDomesticLetterServices(array(
            'length' => 100,
            'width' => 100,
            'thickness' => 10,
            'weight' => 20
        ));
        $this->assertArrayHasKey('services', $response);
        $this->assertArrayHasKey('service', $response['services']);
        $services = $response['services']['service'];

        $codes = array();
        foreach ($services as $service) {
            $codes[] = $service['code'];
        }
        $this->assertContains(ServiceCode::AUS_LETTER_REGULAR_LARGE, $codes);
        $this->assertContains(ServiceCode::AUS_LETTER_EXPRESS_SMALL, $codes);
    }

    public function testListDomesticParcelServices()
    {
        $this->setMockResponse(
            $this->client,
            array('postage/list_domestic_parcel_services')
        );

        $response = $this->client->listDomesticParcelServices(array(
            'from_postcode' => 3000,
            'to_postcode' => 3011,
            'length' => 100,
            'width' => 100,
            'height' => 10,
            'weight' => 20
        ));
        $this->assertArrayHasKey('services', $response);
        $this->assertArrayHasKey('service', $response['services']);
        $services = $response['services']['service'];
        $this->assertCount(4, $services);
        $codes = array();
        foreach ($services as $service) {
            $codes[] = $service['code'];
        }
        $this->assertContains(ServiceCode::AUS_PARCEL_COURIER, $codes);
        $this->assertContains(ServiceCode::AUS_PARCEL_COURIER_SATCHEL_MEDIUM, $codes);
        $this->assertContains(ServiceCode::AUS_PARCEL_EXPRESS, $codes);
        $this->assertContains(ServiceCode::AUS_PARCEL_REGULAR, $codes);
    }

    public function testListInternationalLetterServices()
    {
        $this->setMockResponse(
            $this->client,
            array('postage/list_international_letter_services')
        );

        $response = $this->client->listInternationalLetterServices(
            array('country_code' => 'US', 'weight' => 10)
        );
        $this->assertArrayHasKey('services', $response);
        $this->assertArrayHasKey('service', $response['services']);
        $services = $response['services']['service'];
        $codes = array();
        foreach ($services as $service) {
            $codes[] = $service['code'];
        }
        $this->assertContains(ServiceCode::INTL_SERVICE_ECI_PLATINUM, $codes);
        $this->assertContains(ServiceCode::INTL_SERVICE_ECI_D, $codes);
        $this->assertNotContains(ServiceCode::INTL_SERVICE_ECI_M, $codes);
        $this->assertNotContains(ServiceCode::INTL_SERVICE_EPI, $codes);
        $this->assertContains(ServiceCode::INTL_SERVICE_EPI_C5, $codes);
        $this->assertContains(ServiceCode::INTL_SERVICE_EPI_B4, $codes);
        $this->assertContains(ServiceCode::INTL_SERVICE_PTI, $codes);
        $this->assertContains(ServiceCode::INTL_SERVICE_RPI_DLE, $codes);
        $this->assertContains(ServiceCode::INTL_SERVICE_RPI_B4, $codes);
        $this->assertContains(ServiceCode::INTL_SERVICE_AIR_MAIL, $codes);
        $this->assertNotContains(ServiceCode::INTL_SERVICE_SEA_MAIL, $codes);
    }

    public function testListInternationalParcelServices()
    {
        $this->setMockResponse(
            $this->client,
            array('postage/list_international_parcel_services')
        );

        $response = $this->client->listInternationalParcelServices(
            array('country_code' => 'US', 'weight' => 10)
        );
        $this->assertArrayHasKey('services', $response);
        $this->assertArrayHasKey('service', $response['services']);
        $services = $response['services']['service'];
        $codes = array();
        foreach ($services as $service) {
            $codes[] = $service['code'];
        }
        $this->assertContains(ServiceCode::INTL_SERVICE_ECI_PLATINUM, $codes);
        $this->assertContains(ServiceCode::INTL_SERVICE_ECI_D, $codes);
        $this->assertContains(ServiceCode::INTL_SERVICE_ECI_M, $codes);
        $this->assertContains(ServiceCode::INTL_SERVICE_EPI, $codes);
        $this->assertNotContains(ServiceCode::INTL_SERVICE_EPI_C5, $codes);
        $this->assertNotContains(ServiceCode::INTL_SERVICE_EPI_B4, $codes);
        $this->assertNotContains(ServiceCode::INTL_SERVICE_PTI, $codes);
        $this->assertNotContains(ServiceCode::INTL_SERVICE_RPI_DLE, $codes);
        $this->assertNotContains(ServiceCode::INTL_SERVICE_RPI_B4, $codes);
        $this->assertContains(ServiceCode::INTL_SERVICE_AIR_MAIL, $codes);
        $this->assertContains(ServiceCode::INTL_SERVICE_SEA_MAIL, $codes);
    }

    /**
     * @dataProvider searchPostcodeProvider
     */
    public function testSearchPostcode($mock, $args, $result)
    {
        $this->setMockResponse($this->client, $mock);

        $response = $this->client->searchPostcode($args);
        $this->assertArrayHasKey('localities', $response);
        $this->assertArrayHasKey('locality', $response['localities']);
        $localities = $response['localities']['locality'];
        if ($result['count'] > 1) {
            $this->assertCount($result['count'], $localities);
            foreach ($localities as $locality) {
                $this->assertContains($result['value'], (string)$locality[$result['key']]);
            }
        } else {
            $this->assertContains($result['value'], (string)$localities[$result['key']]);
        }
    }

    public function searchPostcodeProvider()
    {
        return array(
            array(
                array('postage/search_postcode_using_location'),
                array('q' => 'Melbourne'),
                array('count' => 16, 'key' => 'location', 'value' => 'MELBOURNE')
            ),
            array(
                array('postage/search_postcode_using_location_and_state'),
                array('q' => 'Melbourne', 'state' => 'SA'),
                array('count' => 1, 'key' => 'state', 'value' => 'SA')
            ),
            array(
                array('postage/search_postcode_using_postcode'),
                array('q' => 3011),
                array('count' => 3, 'key' => 'postcode', 'value'  => '3011')
            ),
            array(
                array('postage/search_postcode_using_postcode'),
                array('q' => '3011'),
                array('count' => 3, 'key' => 'postcode', 'value'  => '3011')
            )
        );
    }

    /**
     * @dataProvider calculateDomesticLetterPostageProvider
     */
    public function testCalculateDomesticLetterPostage($mock, $args)
    {
        $this->setMockResponse($this->client, $mock);

        $response = $this->client->listDomesticLetterServices($args);
        $this->assertArrayHasKey('services', $response);
        $this->assertArrayHasKey('service', $response['services']);
        $services = $response['services']['service'];
        foreach ($services as $service) {
            $response = $this->client->calculateDomesticLetterPostage(array(
                'service_code' => $service['code'],
                'weight' => $args['weight']
            ));
            $this->assertArrayHasKey('postage_result', $response);
            $this->assertArrayHasKey('total_cost', $response['postage_result']);
            $cost = $response['postage_result']['total_cost'];
            $this->assertEquals($service['price'], $cost);
        }
    }

    public function calculateDomesticLetterPostageProvider()
    {
        return array(
            array(
                array(
                    'postage/list_domestic_letter_services',
                    'postage/calculate_domestic_letter_postage_regular_large',
                    'postage/calculate_domestic_letter_postage_express_small'
                ),
                array(
                    'length' => 100,
                    'width' => 100,
                    'thickness' => 10,
                    'weight' => 20
                )
            )
        );
    }

    /**
     * @dataProvider calculateDomesticParcelPostageProvider
     */
    public function testCalculateDomesticParcelPostage($mock, $args, $cost, $subcosts = null)
    {
        $this->setMockResponse($this->client, $mock);

        $response = $this->client->calculateDomesticParcelPostage($args);
        $this->assertArrayHasKey('postage_result', $response);
        $this->assertArrayHasKey('total_cost', $response['postage_result']);
        $price = $response['postage_result']['total_cost'];
        $this->assertEquals($cost, $price);

        if ($subcosts) {
            $this->assertArrayHasKey('costs', $response['postage_result']);
            $this->assertArrayHasKey('cost', $response['postage_result']['costs']);
            $costs = $response['postage_result']['costs']['cost'];
            $this->assertCount(count($subcosts), $costs);
            $items = array();
            foreach ($costs as $subcost) {
                $items[$subcost['item']] = $subcost['cost'];
            }
            foreach ($subcosts as $key => $value) {
                $this->assertArrayHasKey($key, $items);
                $this->assertEquals($value, $items[$key]);
            }
        }
    }

    public function calculateDomesticParcelPostageProvider()
    {
        return array(
            array(
                array('postage/calculate_domestic_parcel_postage_regular'),
                array(
                    'from_postcode' => 3000,
                    'to_postcode' => 3011,
                    'length' => 10,
                    'width' => 10,
                    'height' => 10,
                    'weight' => 10,
                    'service_code' => ServiceCode::AUS_PARCEL_REGULAR
                ),
                '8.95'
            ),
            array(
                array('postage/calculate_domestic_parcel_postage_regular_extra_cover'),
                array(
                    'from_postcode' => 3000,
                    'to_postcode' => 3011,
                    'length' => 10,
                    'width' => 10,
                    'height' => 10,
                    'weight' => 10,
                    'service_code' => ServiceCode::AUS_PARCEL_REGULAR,
                    'option_code' => ServiceOption::AUS_SERVICE_OPTION_SIGNATURE_ON_DELIVERY,
                    'suboption_code' => ServiceOption::AUS_SERVICE_OPTION_EXTRA_COVER,
                    'extra_cover' => 100
                ),
                '13.40',
                array(
                    'Parcel Post' => '8.95',
                    'Signature on Delivery' => '2.95',
                    'Extra Cover' => '1.50'
                )
            )
        );
    }

    /**
     * @dataProvider calculateInternationalLetterPostageProvider
     */
    public function testCalculateInternationalLetterPostage($mock, $args, $serviceName, $cost)
    {
        $this->setMockResponse($this->client, $mock);

        $response = $this->client->calculateInternationalLetterPostage($args);
        $this->assertArrayHasKey('postage_result', $response);
        $this->assertArrayHasKey('total_cost', $response['postage_result']);
        $postage = $response['postage_result'];
        $totalCost = $postage['total_cost'];
        $this->assertEquals($totalCost, $cost);
        $this->assertArrayHasKey('service', $postage);
        $this->assertEquals($serviceName, $postage['service']);
    }

    public function calculateInternationalLetterPostageProvider()
    {
        return array(
            array(
                array('postage/calculate_international_letter_postage_postcard_air_mail'),
                array(
                    'country_code' => 'US',
                    'service_code' => ServiceCode::INTL_SERVICE_AIR_MAIL
                ),
                'Air Mail',
                '1.70'
            ),
            array(
                array('postage/calculate_international_letter_postage_eci_platinum'),
                array(
                    'country_code' => 'US',
                    'service_code' => ServiceCode::INTL_SERVICE_ECI_PLATINUM,
                    'weight' => 10
                ),
                'Express Courier International Platinum',
                '81.30'
            )
        );
    }

    /**
     * @dataProvider calculateInternationalParcelPostageProvider
     */
    public function testCalculateInternationalParcelPostage($mock, $args, $cost)
    {
        $this->setMockResponse($this->client, $mock);

        $response = $this->client->calculateInternationalParcelPostage($args);
        $this->assertArrayHasKey('postage_result', $response);
        $this->assertArrayHasKey('total_cost', $response['postage_result']);
        $postage = $response['postage_result'];
        $totalCost = $postage['total_cost'];
        $this->assertEquals($totalCost, $cost);
    }

    public function calculateInternationalParcelPostageProvider()
    {
        return array(
            array(
                array('postage/calculate_international_parcel_postage_air_mail'),
                array(
                    'country_code' => 'US',
                    'weight' => 10,
                    'service_code' => ServiceCode::INTL_SERVICE_AIR_MAIL
                ),
                '176.95'
            ),
            array(
                array('postage/calculate_international_parcel_postage_air_mail_extra_cover'),
                array(
                    'country_code' => 'US',
                    'weight' => 10,
                    'service_code' => ServiceCode::INTL_SERVICE_AIR_MAIL,
                    'option_code' => ServiceOption::INTL_SERVICE_OPTION_EXTRA_COVER,
                    'extra_cover' => 100
                ),
                '186.55'
            )
        );
    }
}
