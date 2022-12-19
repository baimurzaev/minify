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
 * Class CommentsHandler
 * @package Hawk\Minify\Handlers
 */
final class CommentsHandler implements HandlerInterface
{
    private const REGEXP_ARRAY = [
        "!/\*.*?\*/!s",
        "/\/\/ .*(\n|\r\n)/",
        "/# .*(\n|\r\n)/"
    ];

    /**
     * Remove "*", "#", "//" (php comments)
     *
     * @param string $value
     * @return string
     */
    public function execute(string $value): string
    {
        foreach (self::REGEXP_ARRAY as $regex) {
            $value = preg_replace($regex, " ", $value);
        }

        return $value;
    }
}
