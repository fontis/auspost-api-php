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

namespace Fontis\Auspost\HttpClient;

use Fontis\Auspost\Exception\EndpointServiceError;
use Http\Client\HttpClient;
use Psr\Http\Message\ResponseInterface;

class HttpApi
{
    /**
     * The HTTP client.
     *
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var RequestBuilder
     */
    protected $requestBuilder;

    /**
     * @param HttpClient $httpClient
     * @param RequestBuilder $requestBuilder
     */
    public function __construct(HttpClient $httpClient, RequestBuilder $requestBuilder)
    {
        $this->httpClient = $httpClient;
        $this->requestBuilder = $requestBuilder;
    }

    /**
     * Send a GET request with query parameters.
     *
     * @param string $path Request path.
     * @param array $parameters GET parameters.
     * @param array $requestHeaders Request Headers.
     * @return ResponseInterface
     * @throws EndpointServiceError If the network has issue.
     */
    public function get(string $path, array $parameters = [], array $requestHeaders = []): ResponseInterface
    {
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        $response = $this->httpClient->sendRequest(
            $this->requestBuilder->create('GET', $path, $requestHeaders)
        );

        $statusCode = $response->getStatusCode();
        if ($statusCode !== 200) {
            $errorResponse = $response->getBody()->__toString();
            $errorMessage = !empty($errorResponse) ? $errorResponse : "Invalid Auspost API response.";

            throw new EndpointServiceError($errorMessage);
        }

        return $response;
    }
}
