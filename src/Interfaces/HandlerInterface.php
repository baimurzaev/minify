<?php

/**
 * Minify code a before deployment
 *
 * @author     Ruslan Baimurzaev
 * @license    http://mit-license.org/
 * @link       https://github.com/baimurzaev/minify
 */

namespace Hawk\Minify\Interfaces;

/**
 * Interface HandlerInterface
 * @package Hawk\Minify\Interfaces
 */
interface HandlerInterface
{
    /**
     * @param string $value
     * @return mixed
     */
    public function process($value);
}
