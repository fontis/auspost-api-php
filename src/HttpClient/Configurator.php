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

use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\PluginClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\UriFactory;

class Configurator
{
    /**
     * @var string
     */
    private $endpoint = 'https://digitalapi.auspost.com.au';

    /**
     * If debug is true we will send all the request to the endpoint without appending any path.
     *
     * @var bool
     */
    private $debug = false;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var UriFactoryDiscovery
     */
    private $uriFactory;

    /**
     * @param string $apiKey
     * @param string $endpoint
     */
    public function __construct(string $apiKey, string $endpoint)
    {
        $this->apiKey = $apiKey;
        $this->endpoint = $endpoint;
    }

    /**
     * @return PluginClient
     */
    public function createHttpClient()
    {
        $client = HttpClientDiscovery::find();

        $plugins = [
            new AddHostPlugin($this->getUriFactory()->createUri($this->getEndpoint())),
            new HeaderDefaultsPlugin([
                'AUTH-KEY' => $this->getApiKey(),
            ]),
        ];

        return new PluginClient($client, $plugins);
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @return UriFactory
     */
    private function getUriFactory(): UriFactory
    {
        if ($this->uriFactory === null) {
            $this->uriFactory = UriFactoryDiscovery::find();
        }

        return $this->uriFactory;
    }

    /**
     * @return bool
     */
    public function isDebug(): bool
    {
        return $this->debug;
    }

    /**
     * @param bool $debug
     */
    public function setDebug(bool $debug): void
    {
        $this->debug = $debug;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }
}
