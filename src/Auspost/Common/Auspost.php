<?php
/**
 * This file is part of Auspost API Client Library for PHP.
 *
 * The Auspost API Client Library for PHP is free software: you can redistribute
 * it and/or modify it under the terms of the GNU Lesser General Public License
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * The Auspost API Client Library for PHP is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser
 * General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with the Auspost API Client Library for PHP.  If not, see
 * <http://www.gnu.org/licenses/>.
 *
 * @category   Fontis
 * @package    auspost-api-php
 * @author     Thai Phan
 * @copyright  Copyright (c) 2013 Fontis Pty Ltd (http://www.fontis.com.au)
 * @license    http://opensource.org/licenses/LGPL-3.0 GNU Lesser General Public License (LGPL 3.0)
 */
namespace Auspost\Common;

use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Service\Builder\ServiceBuilderLoader;

class Auspost extends ServiceBuilder
{
    /**
     * @param array|string $config
     * @param array $globalParameters
     *
     * @return Auspost
     */
    public static function factory($config = null, array $globalParameters = array())
    {
        if (!$config) {
            // If nothing is passed in, then use the default configuration file with credentials from the environment
            $config = self::getDefaultServiceDefinition();
        } elseif (is_array($config)) {
            // If an array was passed, then use the default configuration file with parameter overrides
            $globalParameters = $config;
            $config = self::getDefaultServiceDefinition();
        }

        $loader = new ServiceBuilderLoader();
        $loader->addAlias('_auspost', self::getDefaultServiceDefinition());

        return $loader->load($config, $globalParameters);
    }

    /**
     * Get the full path to the default service builder definition file
     *
     * @return string
     */
    public static function getDefaultServiceDefinition()
    {
        return __DIR__ . '/config.json';
    }

    /**
     * Returns the configuration for the service builder
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->builderConfig;
    }
}
