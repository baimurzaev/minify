<?php

/**
 * Minify code a before deployment
 *
 * @author     Ruslan Baimurzaev
 * @license    http://mit-license.org
 * @link       https://github.com/baimurzaev/minify
 */

namespace Hawk\Minify\Handlers;

use Hawk\Minify\Interfaces\HandlerInterface;

/**
 * Class SpaceHandler
 * @package Hawk\Minify\Handlers
 */
class SpaceHandler implements HandlerInterface
{
    /**
     * @param string $value
     * @return string
     */
    public function execute(string $value):string
    {
        return preg_replace("/ {2,}/", " ", $value);
    }
}
