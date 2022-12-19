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
 * Class TabulationHandler
 * @package Hawk\Minify\Handlers
 */
class TabulationHandler implements HandlerInterface
{
    /**
     * @param string $value
     * @return string
     */
    public function execute(string $value): string
    {
        return trim(
            preg_replace('/\t+/', " ", $value)
        );
    }
}
