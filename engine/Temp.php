<?php
/**
 * Created by PhpStorm.
 * User: Szotyi Lehet
 * Date: 2018. 04. 17.
 * Time: 13:36
 */

namespace Engine;

abstract class Temp
{
    /**
     * You can get a POST variable value.
     * @param $var
     * @return string
     */
    public static function get($var) {
        if (isset($_POST[$var]) and !empty($_POST[$var])) {
            return $_POST[$var];
        }

        return null;
    }

    /**
     * You can set a POST variable value.
     * @param $var
     * @param $value
     */
    public static function set($var, $value) {
        $_POST[$var] = $value;
    }

    /**
     * You can add an array item to array.
     * @param $array
     * @param $value
     */
    public static function addToArray($array, $value) {
        $_POST[$array][] = $value;
    }

    /**
     * @param $array
     * @param $i
     * @return array
     */
    public static function getItem($array, $i) {
        if (isset($_POST[$array][$i]) and !empty($_POST[$array][$i])) {
            return $_POST[$array][$i];
        }

        return null;
    }

    /**
     * Clear all of posts.
     */
    public static function clear() {
        $_POST = null;
    }
}