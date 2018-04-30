<?php
/**
 * Created by PhpStorm.
 * User: Szotyi Lehet
 * Date: 2018. 04. 30.
 * Time: 19:51
 */

namespace Engine;


class View
{
    public function get($view)
    {
        switch ($view) {
            case 'post': include TEMPLATE . 'post.php'; break;
            case 'home': include TEMPLATE . 'home.php'; break;
        }
    }
}