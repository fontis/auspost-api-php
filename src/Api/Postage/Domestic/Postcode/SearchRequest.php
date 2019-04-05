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

namespace Fontis\Auspost\Api\Postage\Domestic\Postcode;

use Exception;
use Fontis\Auspost\Api\Postage\Domestic\Letter\Cost\ParseJsonError;
use Fontis\Auspost\Exception\EmptyServiceResponse;
use Fontis\Auspost\HttpClient\HttpApi;
use Fontis\Auspost\Model\Postage\Locality;
use Fontis\Auspost\Model\Postage\LocalityCollection;
use Psr\Http\Message\ResponseInterface;

class SearchRequest
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
     * @param PostcodeSearchParams $param
     * @return LocalityCollection
     */
    public function search(PostcodeSearchParams $param): LocalityCollection
    {
        $apiParam = $this->generateApiParam($param);
        $response = $this->httpClient->get('postcode/search.json', $apiParam);
        $responseBody = $this->parseResponse($response);

        if (!isset($responseBody["localities"])
            || !count($responseBody["localities"])) {
            return new LocalityCollection([]);
        }

        $result = [];
        foreach ($responseBody["localities"] as $locality) {
            array_push($result, new Locality(
                $locality["category"],
                $locality["id"],
                $locality["location"],
                $locality["postcode"],
                $locality["state"],
                $locality["latitude"],
                $locality["longitude"]
            ));
        }

        $localityCollection = new LocalityCollection($result);

        return $localityCollection;
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
     * @param PostcodeSearchParams $params
     * @return array
     */
    private function generateApiParam(PostcodeSearchParams $params): array
    {
        $urlParams = [
            'q' => $params->getQuery(),
        ];

        if (!empty($params->getState())) {
            $urlParams['state'] = $params->getState();
        }

        if (!empty($params->isExcludePostboxFlag())) {
            $urlParams['excludepostboxflag'] = $params->isExcludePostboxFlag();
        }

        return $urlParams;
    }
}
