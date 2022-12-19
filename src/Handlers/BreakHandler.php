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
 * Class BreakHandler
 * @package Hawk\Minify\Handlers
 */
final class BreakHandler implements HandlerInterface
{
    /**
     * @param string $value
     * @return string
     */
    public function execute(string $value): string
    {
        return str_replace(array("\r\n", "\r", "\n"), " ", $value);
    }
}
