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
use Auspost\DeliveryChoice\Enum\Day;
use Auspost\DeliveryChoice\Enum\DeliveryNetwork;
use Auspost\DeliveryChoice\Enum\State;

class OperationsTest extends \Guzzle\Tests\GuzzleTestCase
{
    /** @var DeliveryChoiceClient */
    private $client;

    public function setUp()
    {
        $this->client = self::getServiceBuilder()->get('deliverychoice', true);
    }

    /**
     * @dataProvider listDeliveryDatesProvider
     */
    public function testListDeliveryDates($mocks, $args)
    {
        $this->setMockResponse($this->client, $mocks);

        $response = $this->client->listDeliveryDates($args);
        $this->assertArrayHasKey('DeliveryEstimateRequestResponse', $response);
        $this->assertArrayHasKey('DeliveryEstimateDates', $response['DeliveryEstimateRequestResponse']);
        $this->assertArrayHasKey('DeliveryEstimateDate', $response['DeliveryEstimateRequestResponse']['DeliveryEstimateDates']);
        if (isset($args['number_of_dates'])) {
            if ($args['number_of_dates'] > 1) {
                $dates = $response['DeliveryEstimateRequestResponse']['DeliveryEstimateDates']['DeliveryEstimateDate'];
                $this->assertCount($args['number_of_dates'], $dates);
                foreach ($dates as $date) {
                    $this->assertArrayHasKey('NumberOfWorkingDays', $date);
                    $this->assertArrayHasKey('TimedDeliveryEnabled', $date);
                }
            } else {
                $dates = $response['DeliveryEstimateRequestResponse']['DeliveryEstimateDates']['DeliveryEstimateDate'];
                $this->assertArrayHasKey('NumberOfWorkingDays', $dates);
                $this->assertArrayHasKey('TimedDeliveryEnabled', $dates);
            }
        } else {
            $dates = $response['DeliveryEstimateRequestResponse']['DeliveryEstimateDates']['DeliveryEstimateDate'];
            foreach ($dates as $date) {
                $this->assertArrayHasKey('NumberOfWorkingDays', $date);
                $this->assertArrayHasKey('TimedDeliveryEnabled', $date);
            }
        }
    }

    public function listDeliveryDatesProvider()
    {
        return array(
            array(
                array('deliverychoice/list_delivery_dates'),
                array(
                    'from_postcode' => 3000,
                    'to_postcode' => 2000,
                    'network_id' => DeliveryNetwork::STANDARD,
                    'lodgement_date' => '2022-10-10T07:00:00Z'
                )
            ),
            array(
                array('deliverychoice/list_delivery_dates_number_of_dates_1'),
                array(
                    'from_postcode' => 3000,
                    'to_postcode' => 2000,
                    'network_id' => DeliveryNetwork::STANDARD,
                    'lodgement_date' => '2022-10-10T07:00:00Z',
                    'number_of_dates' => 1
                )
            ),
            array(
                array('deliverychoice/list_delivery_dates_number_of_dates_2'),
                array(
                    'from_postcode' => 3000,
                    'to_postcode' => 2000,
                    'network_id' => DeliveryNetwork::STANDARD,
                    'lodgement_date' => '2022-10-10T07:00:00Z',
                    'number_of_dates' => 2
                )
            )
        );
    }

    /**
     * @dataProvider listDeliveryTimeslotsProvider
     */
    public function testListDeliveryTimeslots($mock, $args, $availableDays, $unavailableDays)
    {
        $this->setMockResponse($this->client, $mock);

        $response = $this->client->listDeliveryTimeslots($args);
        $this->assertArrayHasKey('DeliveryTimeslots', $response);
        $this->assertArrayHasKey('DayTimeslot', $response['DeliveryTimeslots']);
        $dayTimeslot = $response['DeliveryTimeslots']['DayTimeslot'];
        $weekday = array();
        if (count($availableDays) > 1) {
            $this->assertCount(count($availableDays), $dayTimeslot);
            foreach ($dayTimeslot as $timeslot) {
                $this->assertArrayHasKey('WeekdayDescription', $timeslot);
                $weekday[] = $timeslot['WeekdayDescription'];
            }
        } else {
            $this->assertArrayHasKey('WeekdayDescription', $dayTimeslot);
            $weekday[] = $dayTimeslot['WeekdayDescription'];
        }
        foreach ($availableDays as $day) {
            $this->assertContains($day, $weekday);
        }
        foreach ($unavailableDays as $day) {
            $this->assertNotContains($day, $weekday);
        }
    }

    public function listDeliveryTimeslotsProvider()
    {
        return array(
            array(
                array('deliverychoice/list_delivery_timeslots'),
                array(),
                array('Monday', 'Tuesday', 'Thursday', 'Wednesday', 'Friday'),
                array('Saturday', 'Sunday')
            ),
            array(
                array('deliverychoice/list_delivery_timeslots_monday'),
                array('day' => Day::MONDAY),
                array('Monday'),
                array('Tuesday', 'Thursday', 'Wednesday', 'Friday', 'Saturday', 'Sunday')
            )
        );
    }

    /**
     * @dataProvider listPostcodeCapabilitiesProvider
     */
    public function testListPostcodeCapabilities($mock, $args)
    {
        $this->setMockResponse($this->client, $mock);

        $response = $this->client->listPostcodeCapabilities($args);
        $this->assertArrayHasKey('PostcodeDeliveryCapabilities', $response);
        $this->assertArrayHasKey('PostcodeDeliveryCapability', $response['PostcodeDeliveryCapabilities']);
        $capability = $response['PostcodeDeliveryCapabilities']['PostcodeDeliveryCapability'];
        if (empty($args)) {
            $this->assertCount(4060, $capability);
        } else {
            $this->assertEquals($args['postcode'], $capability['Postcode']);
        }
    }

    public function listPostcodeCapabilitiesProvider()
    {
        return array(
            array(
                array('deliverychoice/list_postcode_capabilities'),
                array()
            ),
            array(
                array('deliverychoice/list_postcode_capabilities_melbourne'),
                array('postcode' => 3000)
            )
        );
    }

    /**
     * @dataProvider listPostcodeCapabilitiesExceptionsProvider
     */
    public function testListPostcodeCapabilitiesExceptions($mock, $args, $exception)
    {
        $this->setMockResponse($this->client, $mock);

        $response = $this->client->listPostcodeCapabilities($args);
        $capability = $response['PostcodeDeliveryCapabilities'];
        $this->assertArrayHasKey('BusinessException', $capability);
        $this->assertEquals($exception['code'], $capability['BusinessException']['Code']);
        $this->assertEquals($exception['description'], $capability['BusinessException']['Description']);
    }

    public function listPostcodeCapabilitiesExceptionsProvider()
    {
        return array(
            array(
                array('deliverychoice/list_postcode_capabilities_10'),
                array('postcode' => 10),
                array('code' => 1201, 'description' => 'Invalid postcode')
            ),
            array(
                array('deliverychoice/list_postcode_capabilities_beverly_hills'),
                array('postcode' => 90210),
                array('code' => 1202, 'description' => 'No postcode capability found.')
            )
        );
    }

    /**
     * @dataProvider listCustomerCollectionPointsProvider
     */
    public function testListCustomerCollectionPoints(
        $mock,
        $args,
        $config,
        $availableCollectionPoints = array(),
        $unavailableCollectionPoints = array()
    ) {
        $this->setMockResponse($this->client, $mock);

        $response = $this->client->listCustomerCollectionPoints($args);
        $this->assertArrayHasKey('CustomerCollectionPoints', $response);
        if (empty($response['CustomerCollectionPoints'])) {
            $this->assertTrue($config['empty']);
        } else {
            $this->assertFalse($config['empty']);
            $this->assertArrayHasKey('CustomerCollectionPoint', $response['CustomerCollectionPoints']);
            $collectionPoints = $response['CustomerCollectionPoints']['CustomerCollectionPoint'];
            $collectionPointNames = array();
            if (isset($config['single']) && $config['single']) {
                $collectionPointNames[] = $collectionPoints['CustomerCollectionPointName'];
            } else {
                foreach ($collectionPoints as $collectionPoint) {
                    $collectionPointNames[] = $collectionPoint['CustomerCollectionPointName'];
                }
            }
            foreach ($availableCollectionPoints as $point) {
                $this->assertContains($point, $collectionPointNames);
            }
            foreach ($unavailableCollectionPoints as $point) {
                $this->assertNotContains($point, $collectionPointNames);
            }
        }
    }

    public function listCustomerCollectionPointsProvider()
    {
        return array(
            array(
                array('deliverychoice/list_customer_collection_points'),
                array(),
                array('empty' => false),
                array('North Adelaide', 'Newcastle', 'Geelong', 'Docklands', 'Hoppers Crossing')
            ),
            array(
                array('deliverychoice/list_customer_collection_points_last_update'),
                array('last_update' => '2013-03-01'),
                array('empty' => true)
            ),
            array(
                array('deliverychoice/list_customer_collection_points_victoria'),
                array('state' => State::VIC),
                array('empty' => false),
                array('Geelong', 'Docklands', 'Hoppers Crossing', 'Sunbury'),
                array('North Adelaide', 'Newcastle')
            ),
            array(
                array('deliverychoice/list_customer_collection_points_footscray'),
                array('postcode' => 3011),
                array('empty' => true),
            ),
            array(
                array('deliverychoice/list_customer_collection_points_hoppers_crossing'),
                array('postcode' => 3029),
                array('empty' => false, 'single' => true),
                array('Hoppers Crossing')
            )
        );
    }

    public function testListCustomerCollectionPointsExceptions()
    {
        $this->setMockResponse(
            $this->client,
            array('deliverychoice/list_customer_collection_points_invalid_last_update')
        );

        $response = $this->client->listCustomerCollectionPoints(
            array('last_update' => '2012-02-30')
        );
        $collectionPoints = $response['CustomerCollectionPoints'];
        $this->assertArrayHasKey('BusinessException', $collectionPoints);
        $this->assertEquals('1303', $collectionPoints['BusinessException']['Code']);
        $this->assertEquals('Invalid Date', $collectionPoints['BusinessException']['Description']);
    }

    /**
     * @dataProvider listTrackingsProvider
     */
    public function testListTrackings($mock, $args, $results)
    {
        $this->setMockResponse($this->client, $mock);

        $response = $this->client->listTrackings($args);

        $this->assertArrayHasKey('QueryTrackEventsResponse', $response);
        $this->assertArrayHasKey('TrackingResult', $response['QueryTrackEventsResponse']);
        $result = $response['QueryTrackEventsResponse']['TrackingResult'];
        $this->assertArrayHasKey('TrackingID', $result);
        $this->assertEquals($args['tracking_id'], $result['TrackingID']);
        $articleDetails = $result['ArticleDetails'];
        $this->assertEquals($args['tracking_id'], $articleDetails['ArticleID']);
        $this->assertEquals($results['event_notification'], $articleDetails['EventNotification']);
        $this->assertEquals($results['product_name'], $articleDetails['ProductName']);
        $this->assertEquals($results['event_count'], $articleDetails['EventCount']);
    }

    public function listTrackingsProvider()
    {
        return array(
            array(
                array('deliverychoice/list_trackings'),
                array('tracking_id' => 'CZ299999784AU'),
                array(
                    'event_notification' => '00',
                    'product_name' => 'International',
                    'event_count' => '0'
                )
            )
        );
    }

    /**
     * @dataProvider listTrackingsExceptionsProvider
     */
    public function testListTrackingsExceptions($mock, $args, $results)
    {
        $this->setMockResponse($this->client, $mock);

        $response = $this->client->listTrackings($args);
        $result = $response['QueryTrackEventsResponse']['TrackingResult'];
        $this->assertEquals($args['tracking_id'], $result['TrackingID']);
        $this->assertArrayHasKey('BusinessException', $result);
        $exception = $result['BusinessException'];
        $this->assertEquals($results['code'], $exception['Code']);
        $this->assertEquals($results['description'], $exception['Description']);
    }

    public function listTrackingsExceptionsProvider()
    {
        return array(
            array(
                array('deliverychoice/list_trackings_invalid_id'),
                array('tracking_id' => '123'),
                array(
                    'code' => '1401',
                    'description' => 'Invalid tracking ID'
                )
            )
        );
    }

    /**
     * @dataProvider validateAddressProvider
     */
    public function testValidateAddress($mock, $args, $valid, $description = null)
    {
        $this->setMockResponse($this->client, $mock);

        $response = $this->client->validateAddress($args);

        $result = $response['ValidateAustralianAddressResponse'];
        $this->assertEquals($valid, $result['ValidAustralianAddress']);
        if (!$valid) {
            $this->assertEquals($description, $result['BusinessException']['Description']);
        }
    }

    public function validateAddressProvider()
    {
        return array(
            array(
                array('deliverychoice/validate_address_incorrect'),
                array(
                    'address_line_1' => '483 George Street',
                    'suburb' => 'Sydney',
                    'state' => 'XYZ',
                    'postcode' => '2000',
                    'country' => 'Australia'
                ),
                false,
                'Invalid state'
            ),
            array(
                array('deliverychoice/validate_address_correct'),
                array(
                    'address_line_1' => '111',
                    'address_line_2' => 'Bourke ST',
                    'suburb' => 'Melbourne',
                    'state' => State::VIC,
                    'postcode' => '3000',
                    'country' => 'Australia'
                ),
                true
            )
        );
    }
}
