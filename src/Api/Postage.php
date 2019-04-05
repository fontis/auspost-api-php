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

declare(strict_types=1);

namespace Fontis\Auspost\Api;

use Fontis\Auspost\Api\Postage\Domestic\Letter\Cost\CalculationParams as DomesticLetterCostParams;
use Fontis\Auspost\Api\Postage\Domestic\Letter\Cost\ServiceCost as DomesticLetterServiceCost;
use Fontis\Auspost\Api\Postage\Domestic\Letter\Services\GetServicesParams as GetDomesticLetterServicesParams;
use Fontis\Auspost\Api\Postage\Domestic\Letter\Services\ServiceRequest as DomesticLetterServiceRequest;
use Fontis\Auspost\Api\Postage\Domestic\Letter\Sizes\ServiceSize as DomesticLetterSizes;
use Fontis\Auspost\Api\Postage\Domestic\Letter\Thicknesses\ServiceThickness as DomesticLetterThicknesses;
use Fontis\Auspost\Api\Postage\Domestic\Letter\Weights\ServiceWeight as DomesticLetterWeight;
use Fontis\Auspost\Api\Postage\Domestic\Parcel\Cost\CalculationParams as DomesticParcelCost;
use Fontis\Auspost\Api\Postage\Domestic\Parcel\Cost\CalculationResponse as DomesticParcelCostResponse;
use Fontis\Auspost\Api\Postage\Domestic\Letter\Cost\CalculationResponse as DomesticLetterCostResponse;
use Fontis\Auspost\Api\Postage\Domestic\Parcel\Cost\ServiceCost as DomesticParcelServiceCost;
use Fontis\Auspost\Api\Postage\Domestic\Parcel\Services\GetServicesParams as DomesticParcelService;
use Fontis\Auspost\Api\Postage\Domestic\Parcel\Services\ServiceRequest as GetDomesticParcelServicesRequest;
use Fontis\Auspost\Api\Postage\Domestic\Parcel\Sizes\ServiceSize as GetDomesticParcelSizesRequest;
use Fontis\Auspost\Api\Postage\Domestic\Parcel\Types\ServiceType as DomesticParcelTypes;
use Fontis\Auspost\Api\Postage\Domestic\Parcel\Weights\ServiceWeight as DomesticParcelWeightsRequest;
use Fontis\Auspost\Api\Postage\International\Letter\Cost\CalculationParams as InternationalLetterCalculationParams;
use Fontis\Auspost\Api\Postage\International\Letter\Cost\CalculationResponse as InternationalLetterCostResponse;
use Fontis\Auspost\Api\Postage\International\Letter\Cost\ServiceCost as InternationalLetterServiceCost;
use Fontis\Auspost\Api\Postage\International\Letter\Services\GetServiceParams as InternationalLetterServicesParams;
use Fontis\Auspost\Api\Postage\International\Letter\Services\ServiceRequest as InternationalLetterServiceRequest;
use Fontis\Auspost\Api\Postage\International\Letter\Weights\ServiceWeight as InternationalLetterServiceWeight;
use Fontis\Auspost\Api\Postage\International\Parcel\Cost\CalculationParams as InternationalParcelCalculationParams;
use Fontis\Auspost\Api\Postage\International\Parcel\Cost\CalculationResponse as InternationalParcelCostResponse;
use Fontis\Auspost\Api\Postage\International\Parcel\Cost\ServiceCost as InternationalParcelServiceCost;
use Fontis\Auspost\Api\Postage\International\Parcel\Services\GetServiceParams as InternationalParcelServicesParams;
use Fontis\Auspost\Api\Postage\International\Parcel\Services\ServiceRequest as InternationalParcelServiceRequest;
use Fontis\Auspost\Api\Postage\International\Parcel\Weights\ServiceWeight as InternationalParcelServiceWeight;
use Fontis\Auspost\Api\Postage\Domestic\Postcode\PostcodeSearchParams;
use Fontis\Auspost\Api\Postage\Domestic\Postcode\SearchRequest;
use Fontis\Auspost\Api\Postage\International\Country\ServiceCountry;
use Fontis\Auspost\HttpClient\HttpApi;
use Fontis\Auspost\Model\Postage\CountryCollection;
use Fontis\Auspost\Model\Postage\PostageSizeCollection;
use Fontis\Auspost\Model\Postage\PostageTypeCollection;
use Fontis\Auspost\Model\Postage\ServiceCollection;
use Fontis\Auspost\Model\Postage\ThicknessCollection;
use Fontis\Auspost\Model\Postage\WeightCollection;
use Http\Client\HttpClient;

class Postage
{
    /**
     * The HTTP client.
     *
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @param HttpApi $httpClient
     */
    public function __construct(HttpApi $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return CountryCollection
     */
    public function listCountries()
    {
        return (new ServiceCountry($this->httpClient))->listCountries();
    }

    /**
     * @return PostageSizeCollection
     */
    public function listDomesticLetterSizes()
    {
        return (new DomesticLetterSizes($this->httpClient))->listSizes();
    }

    /**
     * @return WeightCollection
     */
    public function listDomesticLetterWeights()
    {
        return (new DomesticLetterWeight($this->httpClient))->listWeights();
    }

    /**
     * @return WeightCollection
     */
    public function listInternationalLetterWeights()
    {
        return (new InternationalLetterServiceWeight($this->httpClient))->listWeights();
    }

    /**
     * @return WeightCollection
     */
    public function listInternationalParcelWeights()
    {
        return (new InternationalParcelServiceWeight($this->httpClient))->listWeights();
    }

    /**
     * @return ThicknessCollection
     */
    public function listDomesticLetterThicknesses()
    {
        return (new DomesticLetterThicknesses($this->httpClient))->listThickness();
    }

    /**
     * @return PostageSizeCollection
     */
    public function listDomesticParcelSizes()
    {
        return (new GetDomesticParcelSizesRequest($this->httpClient))->listSizes();
    }

    /**
     * @return PostageTypeCollection
     */
    public function listDomesticParcelTypes()
    {
        return (new DomesticParcelTypes($this->httpClient))->listTypes();
    }

    /**
     * @return WeightCollection
     */
    public function listDomesticParcelWeights()
    {
        return (new DomesticParcelWeightsRequest($this->httpClient))->listWeights();
    }

    /**
     * @param GetDomesticLetterServicesParams $params
     * @return ServiceCollection
     */
    public function listDomesticLetterServices(GetDomesticLetterServicesParams $params)
    {
        return (new DomesticLetterServiceRequest($this->httpClient))->listServices($params);
    }

    /**
     * @param DomesticParcelService $params
     * @return ServiceCollection
     */
    public function listDomesticParcelServices(DomesticParcelService $params)
    {
        return (new GetDomesticParcelServicesRequest($this->httpClient))->listServices($params);
    }

    /**
     * @param DomesticParcelCost $params
     * @return DomesticParcelCostResponse
     */
    public function calculateDomesticParcelPostage(DomesticParcelCost $params)
    {
        return (new DomesticParcelServiceCost($this->httpClient))->calculate($params);
    }

    /**
     * @param DomesticLetterCostParams $params
     * @return DomesticLetterCostResponse
     */
    public function calculateDomesticLetterPostage(DomesticLetterCostParams $params)
    {
        return (new DomesticLetterServiceCost($this->httpClient))->calculate($params);
    }

    /**
     * @param InternationalLetterCalculationParams $params
     * @return InternationalLetterCostResponse
     */
    public function calculateInternationalLetterPostage(InternationalLetterCalculationParams $params)
    {
        return (new InternationalLetterServiceCost($this->httpClient))->calculate($params);
    }

    /**
     * @param InternationalParcelCalculationParams $params
     * @return InternationalParcelCostResponse
     */
    public function calculateInternationalParcelPostage(InternationalParcelCalculationParams $params)
    {
        return (new InternationalParcelServiceCost($this->httpClient))->calculate($params);
    }

    /**
     * @param PostcodeSearchParams $params
     * @return mixed
     */
    public function searchPostcode(PostcodeSearchParams $params)
    {
        return (new SearchRequest($this->httpClient))->search($params);
    }

    /**
     * @param InternationalLetterServicesParams $params
     * @return ServiceCollection
     */
    public function listInternationalLetterServices(InternationalLetterServicesParams $params)
    {
        return (new InternationalLetterServiceRequest($this->httpClient))->listServices($params);
    }

    /**
     * @param InternationalParcelServicesParams $params
     * @return ServiceCollection
     */
    public function listInternationalParcelServices(InternationalParcelServicesParams $params)
    {
        return (new InternationalParcelServiceRequest($this->httpClient))->listServices($params);
    }
}
