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
class FileFactory
{
    /**
     * @param string $filePathFrom
     * @param string $filePathTo
     * @return File
     */
    public function createFile(string $filePathFrom, string $filePathTo)
    {
        $file = new File($filePathFrom, $filePathTo);

        return $file->read();
    }
}
