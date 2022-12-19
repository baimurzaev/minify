<?php

/**
 * Minify code a before deployment
 *
 * @author     Ruslan Baimurzaev
 * @license    http://mit-license.org
 * @link       https://github.com/baimurzaev/minify
 */

namespace Hawk\Minify\Factory;

use Hawk\Minify\File;

/**
 * Class FileFactory
 * @package Hawk\Minify\Factory
 */
final class FileFactory
{
    /**
     * @param string $filePathFrom
     * @param string $filePathTo
     * @return File
     */
    public function createFile(string $filePathFrom, string $filePathTo): File
    {
        return (new File($filePathFrom, $filePathTo))->read();
    }
}
