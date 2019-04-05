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

namespace Fontis\Auspost\Api\Postage\Domestic\Letter\Services;

use Exception;
use Fontis\Auspost\Api\Postage\Domestic\Letter\Cost\ParseJsonError;
use Fontis\Auspost\Exception\EmptyServiceResponse;
use Fontis\Auspost\HttpClient\HttpApi;
use Fontis\Auspost\Model\Postage\Option;
use Fontis\Auspost\Model\Postage\OptionCollection;
use Fontis\Auspost\Model\Postage\Service;
use Fontis\Auspost\Model\Postage\ServiceCollection;
use Psr\Http\Message\ResponseInterface;

class ServiceRequest
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
     * @param GetServicesParams $param
     * @return ServiceCollection
     */
    public function listServices(GetServicesParams $param): ServiceCollection
    {
        $apiParams = $this->generateApiParam($param);
        $resource = $this->httpClient->get('postage/letter/domestic/service', $apiParams);
        $responseBody = $this->parseResponse($resource);

        if (!isset($responseBody["services"])
            || !isset($responseBody["services"]["service"])
            || !count($responseBody["services"]["service"])) {
            return new ServiceCollection([]);
        }

        $result = [];
        foreach ($responseBody["services"]["service"] as $serviceItem) {
            $options = [];
            $optionsCollection = null;
            if (!empty($serviceItem["options"])) {
                if (count($serviceItem["options"]["option"]) > 1) {
                    $optionList = $serviceItem["options"]["option"];
                } else {
                    $optionList = $serviceItem["options"];
                }

                foreach ($optionList as $optionItem) {
                    $subOptionCollection = null;
                    if (!empty($optionItem["suboptions"])) {
                        $subOptionCollection = $this->parseSubOptions($optionItem["suboptions"]);
                    }

                    $optionItem = new Option(
                        $optionItem["code"],
                        $optionItem["name"],
                        $subOptionCollection
                    );
                    array_push($options, $optionItem);
                    $optionsCollection = new OptionCollection($options);
                }
            }

            $serviceCode = $serviceItem["code"] ?? '';
            $serviceName = $serviceItem["name"] ?? '';
            $servicePrice = isset($serviceItem["price"]) ? (float) $serviceItem["price"] : 0;
            $serviceExtraCover = isset($serviceItem["max_extra_cover"]) ? (float) $serviceItem["max_extra_cover"] : 0;

            $service = new Service(
                $serviceCode,
                $serviceName,
                $servicePrice,
                $serviceExtraCover,
                $optionsCollection
            );
            array_push($result, $service);
        }

        $serviceCollection = new ServiceCollection($result);

        return $serviceCollection;
    }

    /**
     * @param array $options
     * @return OptionCollection
     */
    private function parseSubOptions(array $options): OptionCollection
    {
        $subOptions = [];

        if (isset($options["option"]["code"])) {
            $objSubOption = new Option(
                $options["option"]["code"],
                $options["option"]["name"]
            );

            array_push($subOptions, $objSubOption);
        } else {
            foreach ($options["option"] as $subOptionItem) {
                $objSubOption = new Option(
                    $subOptionItem["code"],
                    $subOptionItem["name"]
                );

                array_push($subOptions, $objSubOption);
            }
        }

        $subOptionCollection = new OptionCollection($subOptions);

        return $subOptionCollection;
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
     * @param GetServicesParams $param
     * @return array
     */
    private function generateApiParam(GetServicesParams $param): array
    {
        $result = [
            'length' => $param->getLength(),
            'width' => $param->getWidth(),
            'thickness' => $param->getThickness(),
            'weight' => $param->getWeight(),
        ];

        return $result;
    }
}
