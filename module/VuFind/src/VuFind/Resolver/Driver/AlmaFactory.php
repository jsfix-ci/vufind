<?php
/**
 * Factory for Alma resolver driver.
 *
 * PHP version 7
 *
 * Copyright (C) Villanova University 2020.
 * Copyright (C) Düsseldorf University and State Library 2022.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category VuFind
 * @package  Resolver_Drivers
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @author   Helge Ahrens <helge.ahrens@ulb.hhu.de>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org/wiki/development Wiki
 */
namespace VuFind\Resolver\Driver;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;

/**
 * Factory for Alma resolver driver.
 *
 * @category VuFind
 * @package  Resolver_Drivers
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @author   Helge Ahrens <helge.ahrens@ulb.hhu.de>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org/wiki/development Wiki
 */
class AlmaFactory extends DriverWithHttpClientFactory
{
    /**
     * Create an object
     *
     * @param ContainerInterface $container     Service manager
     * @param string             $requestedName Service being created
     * @param null|array         $options       Extra options (optional)
     *
     * @return object
     *
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     * creating a service.
     * @throws ContainerException&\Throwable if any other error occurs
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $configs = [$container->get(\VuFind\Config\PluginManager::class)
            ->get('config')->OpenURL->toArray()];
        if ($options) {
            array_unshift($options, $configs);
        } else {
            $options = [$configs];
        }
        return parent::__invoke($container, $requestedName, $options);
    }
}
