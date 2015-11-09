<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 9/11/2015
 * Time: 1:25 PM
 */

namespace Mpclarkson\Stringy;


class StringyException extends \Exception
{
    public function __construct() {
        $message = "You can only pass a string to a Stringy object";
        parent::__construct($message, 400);
    }
}