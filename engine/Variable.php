<?php
/**
 * Created by PhpStorm.
 * User: Szotyi Lehet
 * Date: 2018. 04. 17.
 * Time: 13:36
 */

namespace Engine;

class Variable
{
    public static function get($var) {
        if (isset($_GET[$var]) and !empty($_GET[$var])) {
            return $_GET[$var];
        }

        return "null";
    }

    public static function set($var, $value) {
        $_GET[$var] = $value;
    }
}