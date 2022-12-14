<?php

/**
 * Minify code a before deployment
 *
 * @author     Ruslan Baimurzaev
 * @license    http://mit-license.org
 * @link       https://github.com/baimurzaev/minify
 */

namespace Hawk\Minify;

use Hawk\Minify\Exceptions\TerminateException;

/**
 * Class MinifyStarter
 * @package Hawk\Minify
 */
class MinifyStarter
{
    const SEPARATOR = "===================================================================================";

    /**
     * @throws TerminateException
     * @throws \Exception
     */
    public function squeeze()
    {
        $this->checkRequirements();

        $xmlConfigPath = realpath(__DIR__ . '/../../../../') . '/minify.hawk.xml';
        $config = new Config($xmlConfigPath);

        $runner = new Runner($config);
        $runner->toBegin();
    }

    /**
     * @return string
     */
    public function getSeparator()
    {
        return self::SEPARATOR . PHP_EOL;
    }

    /**
     * @throws \Exception
     */
    private function checkRequirements()
    {
        if (extension_loaded("SimpleXML") === false) {
            throw new TerminateException(
                "The SimpleXML extension to be enabled." . PHP_EOL
            );
        }

        if (PHP_VERSION_ID < 50400) {
            throw new TerminateException(
                'Minify requires PHP version 5.4 or greater.' . PHP_EOL
            );
        }
    }
}
