<?php
/**
 * Fontis Australia Post API client library for PHP
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/osl-3.0.php
 *
 * @category   Fontis
 * @package    Fontis_Auspost
 * @copyright  Copyright (c) 2019 Fontis Pty. Ltd. (https://www.fontis.com.au)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

use Fontis\Auspost\Api\Postage\Domestic\Letter\Cost\CalculationParams;
use Fontis\Auspost\Api\Postage\Domestic\Parcel\Cost\CalculationParams as DomesticParcelCostParam;
use Fontis\Auspost\Api\Postage\Domestic\Letter\Services\GetServicesParams;
use Fontis\Auspost\Api\Postage\Domestic\Parcel\Services\GetServicesParams as DomesticParcelServicesParams;
use Fontis\Auspost\Api\Postage\Domestic\Postcode\PostcodeSearchParams;
use Fontis\Auspost\Api\Postage\International\Letter\Cost\CalculationParams as InternationalLetterCalculationParams;
use Fontis\Auspost\Api\Postage\International\Letter\Services\GetServiceParams;
use Fontis\Auspost\Api\Postage\International\Parcel\Cost\CalculationParams as InternationalParcelCalculationParams;
use Fontis\Auspost\Api\Postage\International\Parcel\Services\GetServiceParams as InternationalParcelServiceParams;
use Fontis\Auspost\Auspost;
use Fontis\Auspost\Model\Postage\Enum\ServiceCode;

require 'vendor/autoload.php';

$authKey = "28744ed5982391881611cca6cf5c240";
$auspost = Auspost::create($authKey);

//$result = $auspost->postage()->listInternationalParcelWeights();
////------------------------DOMESTIC LETTER---------------------------------
$domesticLetterServiceParams = new GetServicesParams(
    10,
    10,
    10,
    10
);
// Test sub-option
$result = $auspost->postage()->listDomesticLetterServices($domesticLetterServiceParams);
//---------------------------------------------------------
$domesticLetterParams = new CalculationParams(
    'AUS_LETTER_REGULAR_LARGE',
    100
);
$result = $auspost->postage()->calculateDomesticLetterPostage($domesticLetterParams);


$result = $auspost->postage()->listDomesticLetterSizes();
$result = $auspost->postage()->listDomesticLetterThicknesses();
$result = $auspost->postage()->listDomesticLetterWeights();

//---------------------DOMESTIC PARCEL------------------------------------
$domesticParcelParam = new DomesticParcelCostParam(
    3000,
    3011,
    10,
    10,
    10,
    10,
    ServiceCode::AUS_PARCEL_REGULAR
);
$result = $auspost->postage()->calculateDomesticParcelPostage($domesticParcelParam);

$domesticParcelServiceRequest = new DomesticParcelServicesParams(
    3000,
    3011,
    10,
    10,
    10,
    10
);

$result = $auspost->postage()->listDomesticParcelServices($domesticParcelServiceRequest);

$result = $auspost->postage()->listDomesticParcelSizes();

$result = $auspost->postage()->listDomesticParcelTypes();

$result = $auspost->postage()->listDomesticParcelWeights();

//---------------------------------------------------------
// Auspost return response 503
// This API endpoint is out of service.
//$param = new PostcodeSearchParams(
//    "Melbourne",
//    "VIC"
//);
//
//$result = $auspost->postage()->searchPostcode($param);

//---------------------INTERNATIONAL------------------------------------
$result = $auspost->postage()->listCountries();
$calculationLetterParam = new InternationalLetterCalculationParams(
    "NZ",
    "INT_PARCEL_STD_OWN_PACKAGING",
    1
);

$result = $auspost->postage()->calculateInternationalLetterPostage($calculationLetterParam);

$internationalLetterParams = new GetServiceParams("NZ", 1);
$result = $auspost->postage()->listInternationalLetterServices($internationalLetterParams);
$result = $auspost->postage()->listInternationalLetterWeights();

$calculationParcelParam = new InternationalParcelCalculationParams(
    "NZ",
    1,
    "INT_PARCEL_STD_OWN_PACKAGING"
);
$result = $auspost->postage()->calculateInternationalParcelPostage($calculationParcelParam);

$internationalParcelServiceParams = new InternationalParcelServiceParams("NZ", 1);
$result = $auspost->postage()->listInternationalParcelServices($internationalParcelServiceParams);

$result = $auspost->postage()->listInternationalParcelWeights();
