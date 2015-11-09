<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 9/11/2015
 * Time: 12:16 PM
 */

namespace Mpclarkson\Stringy;

class Stringy {

    private $text;

    public function __construct($string)
    {
        if(!is_string($string)) {
            throw new StringyException();
        }

        $this->text = trim($string);
    }

    /**
     * @return string
     */
    public function string()
    {
        return $this->text;
    }

    /**
     * @param int $chars
     * @param string $appendWith
     * @return $this
     */
    public function truncate($chars = 50, $appendWith = "...")
    {
        $len = strlen($this->text);
        if($len <= $chars) {
            return $this->text;
        }

        $this->text = substr($this->text, 0, $chars) . $appendWith;
        return $this;
    }

    /**
     * @return int
     */
    public function length()
    {
        return strlen($this->text);
    }

    /**
     * @param $substring
     * @return bool
     */
    public function contains($substring)
    {
        return strpos($this->text, $substring) !== false ? true : false;
    }

    /**
     * @param $substring
     * @return bool
     */
    public function startsWith($substring)
    {
        return strrpos($this->text, $substring, -strlen($substring)) !== false;
    }

    /**
     * @param $substring
     * @return bool
     */
    public function endsWith($substring)
    {
        return ($temp = strlen($this->text) - strlen($substring)) >= 0 && strpos($this->text, $substring, $temp) !== false;
    }

    /**
     * @param $string
     * @param string $separator
     * @return $this
     */
    public function append($string, $separator = " ")
    {
        $this->text = $this->text . $separator . $string;
        return $this;
    }

    /**
     * @return $this
     */
    public function reverse()
    {
        $this->text = strrev($this->text);
        return $this;
    }

    /**
     * @return $this
     */
    public function uppercase()
    {
        $this->text = strtoupper($this->text);
        return $this;
    }

    /**
     * @return $this
     */
    public function lowercase()
    {
        $this->text = strtolower($this->text);
        return $this;
    }

    /**
     * @return $this
     */
    public function lowercaseFirst()
    {
        $this->text = lcfirst($this->text);
        return $this;
    }

    /**
     * @return $this
     */
    public function uppercaseFirst()
    {
        $this->text = ucfirst($this->text);
        return $this;
    }

    /**
     * @return $this
     */
    public function titleCase()
    {
        $this->text = ucwords($this->text);
        return $this;
    }

    /**
     * @return $this
     */
    public function sentenceCase()
    {
        $results = [];

        $arr = explode(".", $this->text);

        foreach($arr as $sentence) {
            $results[] = ucfirst(trim($sentence));
        }

        $this->text = implode(". ", $results);
        return $this;
    }

    /**
     * @param $delimiter
     * @return array
     */
    public function toArray($delimiter = null)
    {
        return !$delimiter ? str_split($this->text) : explode($delimiter, $this->text);
    }

    /**
     * @param callable $function
     * @return $this
     */
    public function apply(callable $function)
    {
        $arr = str_split($this->text);

        $result = [];

        foreach($arr as $char) {
            $result[] = $function($char);
        }

        $this->text = implode("", $result);
        return $this;

    }
}