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

namespace Fontis\Auspost\Api\Postage\Domestic\Letter\Sizes;

use Exception;
use Fontis\Auspost\Api\Postage\Domestic\Letter\Cost\ParseJsonError;
use Fontis\Auspost\Exception\EmptyServiceResponse;
use Fontis\Auspost\HttpClient\HttpApi;
use Fontis\Auspost\Model\Postage\PostageSize;
use Fontis\Auspost\Model\Postage\PostageSizeCollection;
use Psr\Http\Message\ResponseInterface;

class ServiceSize
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
     * @return PostageSizeCollection
     */
    public function listSizes(): PostageSizeCollection
    {
        $response = $this->httpClient->get('postage/letter/domestic/size.json');
        $responseBody = $this->parseResponse($response);

        if (!isset($responseBody["sizes"])
            || !isset($responseBody["sizes"]["size"])
            || !count($responseBody["sizes"]["size"])) {
            return new PostageSizeCollection([]);
        }

        $result = [];
        foreach ($responseBody["sizes"]["size"] as $size) {
            $code = $size["code"] ?? "";
            $name = $size["name"] ?? "";
            $value = $size["value"] ?? null;

            array_push($result, new PostageSize($code, $name, $value));
        }

        $sizeCollection = new PostageSizeCollection($result);

        return $sizeCollection;
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
}
