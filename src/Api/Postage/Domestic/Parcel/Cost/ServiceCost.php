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

namespace Fontis\Auspost\Api\Postage\Domestic\Parcel\Cost;

use Exception;
use Fontis\Auspost\Api\Postage\Domestic\Letter\Cost\ParseJsonError;
use Fontis\Auspost\Exception\EmptyServiceResponse;
use Fontis\Auspost\HttpClient\HttpApi;
use Fontis\Auspost\Model\Postage\Cost;
use Fontis\Auspost\Model\Postage\CostCollection;
use Psr\Http\Message\ResponseInterface;

class ServiceCost
{
    /**
     * @var HttpApi
     */
    private $httpClient;

    /**
     * @param HttpApi $httpClient
     */
    public function __construct(HttpApi $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param CalculationParams $params
     * @return CalculationResponse
     */
    public function calculate(CalculationParams $params): CalculationResponse
    {
        $apiParams = $this->generateApiParam($params);
        $response = $this->httpClient->get('postage/parcel/domestic/calculate', $apiParams);
        $responseBody = $this->parseResponse($response);

        $costs = [];
        if (!empty($responseBody["postage_result"]["costs"])) {
            foreach ($responseBody["postage_result"]["costs"] as $cost) {
                $itemTitle = isset($cost["item"]) ? $cost["item"] : "";
                $costValue = isset($cost["cost"]) ? (float) $cost["cost"] : 0;
                array_push($costs, new Cost($itemTitle, $costValue));
            }
        }

        $costCollection = new CostCollection($costs);

        $result = new CalculationResponse(
            $responseBody["postage_result"]["service"],
            $responseBody["postage_result"]["delivery_time"],
            (float) $responseBody["postage_result"]["total_cost"],
            $costCollection
        );

        return $result;
    }

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws Exception If invalid response.
     */
    private function parseResponse(ResponseInterface $response): array
    {
        $responseBody = (string) $response->getBody();
        if (empty($responseBody)) {
            throw new EmptyServiceResponse("The response body is empty.");
        }

        $result = json_decode($responseBody, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ParseJsonError('Error parsing JSON: ' . json_last_error_msg());
        }

        return $result;
    }

    /**
     * @param CalculationParams $params
     * @return array
     */
    private function generateApiParam(CalculationParams $params): array
    {
        $urlParams = [
            'from_postcode' => $params->getFromPostcode(),
            'to_postcode' => $params->getToPostcode(),
            'length' => $params->getLength(),
            'width' => $params->getWidth(),
            'height' => $params->getHeight(),
            'weight' => $params->getWeight(),
            'service_code' => $params->getServiceCode(),
        ];

        if (!empty($params->getOptionCode())) {
            $urlParams['option_code'] = $params->getOptionCode();
        }

        if (!empty($params->getSubOptionCode())) {
            $urlParams['suboption_code'] = $params->getSubOptionCode();
        }

        if (!empty($params->getExtraCover())) {
            $urlParams['extra_cover'] = $params->getExtraCover();
        }

        return $urlParams;
    }
}
