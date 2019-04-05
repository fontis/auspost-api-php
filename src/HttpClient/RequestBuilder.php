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

use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Psr\Http\Message\RequestInterface;

class RequestBuilder
{
    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * Create request.
     *
     * @param string $method
     * @param string $uri
     * @param array $headers
     * @param mixed|null $body
     * @return RequestInterface
     */
    public function create(string $method, string $uri, array $headers = [], $body = null): RequestInterface
    {
        if (!is_array($body)) {
            return $this->getRequestFactory()->createRequest($method, $uri, $headers, $body);
        }

        return $this->getRequestFactory()->createRequest($method, $uri, $headers);
    }

    /**
     * @return RequestFactory
     */
    private function getRequestFactory(): RequestFactory
    {
        if ($this->requestFactory === null) {
            $this->requestFactory = MessageFactoryDiscovery::find();
        }

        return $this->requestFactory;
    }

    /**
     * @param RequestFactory $requestFactory
     *
     * @return RequestBuilder
     */
    public function setRequestFactory(RequestFactory $requestFactory): RequestBuilder
    {
        $this->requestFactory = $requestFactory;

        return $this;
    }
}
