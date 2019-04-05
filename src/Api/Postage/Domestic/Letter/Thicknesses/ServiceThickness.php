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

namespace Fontis\Auspost\Api\Postage\Domestic\Letter\Thicknesses;

use Exception;
use Fontis\Auspost\Api\Postage\Domestic\Letter\Cost\ParseJsonError;
use Fontis\Auspost\Exception\EmptyServiceResponse;
use Fontis\Auspost\HttpClient\HttpApi;
use Fontis\Auspost\Model\Postage\Thickness;
use Fontis\Auspost\Model\Postage\ThicknessCollection;
use Psr\Http\Message\ResponseInterface;

class ServiceThickness
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
     * @return ThicknessCollection
     */
    public function listThickness(): ThicknessCollection
    {
        $response = $this->httpClient->get('postage/letter/domestic/thickness.json');
        $responseBody = $this->parseResponse($response);

        if (!isset($responseBody["thicknesses"])
            || !isset($responseBody["thicknesses"]["thickness"])
            || !count($responseBody["thicknesses"]["thickness"])) {
            return new ThicknessCollection([]);
        }

        $result = [];
        foreach ($responseBody["thicknesses"]["thickness"] as $thickness) {
            $code = $thickness["code"] ?? "";
            $name = $thickness["name"] ?? "";
            $value = isset($thickness["value"]) ? (float) $thickness["value"] : 0;

            array_push($result, new Thickness($code, $name, $value));
        }

        $thicknessCollection = new ThicknessCollection($result);

        return $thicknessCollection;
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
