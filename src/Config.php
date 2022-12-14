<?php

/**
 * Minify code a before deployment
 *
 * @author     Ruslan Baimurzaev
 * @license    http://mit-license.org
 * @link       https://github.com/baimurzaev/minify
 */

namespace Hawk\Minify;

use ArrayAccess;
use IteratorAggregate;

/**
 * Class Config
 * @property string pathFrom
 * @property string pathTo
 * @property array extensions
 * @property array handlers
 * @package Hawk\Minify
 */
class Config implements ArrayAccess, IteratorAggregate
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * Config constructor.
     * @param string|array|null $settings
     */
    public function __construct($settings = null)
    {
        $this->init($settings);

        if (is_array($settings)) {
            $this->data = $settings;
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        return null;
    }

    /**
     * @param string|null $settings
     */
    protected function init($settings)
    {
        if (is_string($settings) && file_exists($settings) === true) {
            $this->applyXmlConfig($settings);
            echo "Config loaded success: " . $settings . PHP_EOL;
        } else {
            $this->applyDefaultSettings();
            echo "Loaded default settings : " . $settings . PHP_EOL;
        }
    }

    /**
     * @param $xmlFile
     */
    public function applyXmlConfig($xmlFile)
    {
        $xml = new XmlReader($xmlFile);

        $this->data['description'] = ($xml->hasElement('description'))
            ? (string)$xml->getElement('description') : 'Minify code';

        $this->data['pathFrom'] = ($xml->hasElement('pathFrom'))
            ? (string)$xml->getElement('pathFrom') : 'src';

        $this->data['pathTo'] = ($xml->hasElement('pathTo'))
            ? (string)$xml->getElement('pathTo') : 'deploy';

        $this->data['extensions'] = ($xml->hasElement('extensions'))
            ? $xml->toArray('extensions', 'ext') : array('php');

        $this->data['packing'] = ($xml->hasElement('packing'))
            ? (bool)$xml->getElement('packing') : false;
    }

    /**
     * Default settings
     */
    public function applyDefaultSettings()
    {
        $this->data = array_merge($this->data, [
            'description' => 'Minify code',
            'pathFrom' => 'src',
            'pathTo' => 'deploy',
            'extensions' => ['php'],
            'packing' => false
        ]);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return \array_key_exists($offset, $this->data);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (null === $offset) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }
}
