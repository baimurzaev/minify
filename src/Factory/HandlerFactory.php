<?php

/**
 * Minify code a before deployment
 *
 * @author     Ruslan Baimurzaev
 * @license    http://mit-license.org
 * @link       https://github.com/baimurzaev/minify
 */

namespace Hawk\Minify\Factory;

use Hawk\Minify\Interfaces\HandlerInterface;

/**
 * Class HandlerFactory
 * @package Hawk\Minify\Factory
 */
final class HandlerFactory
{
    /**
     * @param string $name
     * @return HandlerInterface
     */
    public function create(string $name): HandlerInterface
    {
        $className = "Hawk\\Minify\\Handlers\\" . ucfirst(strtolower($name)) . "Handler";

        return new $className();
    }
}
