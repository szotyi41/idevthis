<?php
/**
 * Created by PhpStorm.
 * User: Szotyi Lehet
 * Date: 2018. 04. 17.
 * Time: 13:13
 */

namespace Engine;

use Doctrine\ORM\EntityManager;

class Controller
{

    public static function create(EntityManager $entityManager)
    {
        $repository = $entityManager->getRepository('\Posts');
        $posts = $repository->findAll();

        foreach ($posts as $post) {

        }
/*
        Variable::set('post', $post->getContentfile());
        Variable::set('title', $post->getTitle());
        Variable::set('created', $post->getCreated());
        Variable::set('tags', self::getTags($post->getTags()));


        include TEMPLATE . "header.php";
        //include TEMPLATE . Variable::get('post') . ".php";
        include TEMPLATE . "footer.php";*/
    }

    public static function getTags($string) {
        return explode(",", $string);
    }

}