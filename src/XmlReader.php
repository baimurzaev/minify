<?php

/**
 * Minify code a before deployment
 *
 * @author     Ruslan Baimurzaev
 * @license    http://mit-license.org
 * @link       https://github.com/baimurzaev/minify
 */

namespace Hawk\Minify;

/**
 * Class XmlReader
 * @package Hawk\Minify
 */
class XmlReader
{
    /**
     * @var \SimpleXMLElement
     */
    private $xml;

    /**
     * XmlReader constructor.
     * @param null $path
     */
    public function __construct($path = null)
    {
        if ($path !== null) {
            $this->load($path);
        }
    }

    /**
     * @param $filePath
     * @return $this
     */
    public function load($filePath)
    {
        if (file_exists($filePath) === false) {
            throw new \InvalidArgumentException(sprintf("File %s not found", $filePath));
        }

        $this->xml = simplexml_load_file($filePath);

        return $this;
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getXml()
    {
        return $this->xml;
    }

    /**
     * @param $name
     * @return \SimpleXMLElement
     */
    public function getElement($name)
    {
        return $this->xml->$name;
    }

    /**
     * @param $name
     * @return int
     */
    public function hasElement($name)
    {
        return (bool)$this->xml->{$name}->count();
    }

    /**
     * @param string $name
     * @param string|null $sub
     * @return mixed
     */
    public function toArray($name, $sub = null)
    {
        $data = array();

        foreach ((array)$this->xml->{$name} as $index => $node) {
            $data[$index] = (is_object($node)) ? $this->toArray($node) : $node;
        }

        if (is_string($sub) && $sub !== '') {
            return $data[$sub];
        }

        return $data;
    }
}
