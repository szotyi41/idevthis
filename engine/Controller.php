<?php
/**
 * Created by PhpStorm.
 * User: Szotyi Lehet
 * Date: 2018. 04. 17.
 * Time: 13:13
 */

namespace Engine;

use Doctrine\ORM\OptimisticLockException;
use Engine\Entities\Comment;

class Controller
{

    private $entityManager;

    /**@var $model Model */
    private $model;
    /**@var $view View */
    private $view;

    function __construct($entityManager)
    {
        $this->entityManager = $entityManager;

        $this->getModel();
        $this->getView();
        $this->createAvatars();
        $this->action();
    }

    /**
     *  Run the application engine.
     */
    public function action()
    {

        /** Add a new comment if there is a content */
        if (Temp::get('comment'))
        {
            $comment = new Comment();
            $comment->setPostid($_GET['post']);
            $comment->setUserid(1);
            $comment->setContent(Temp::get('comment'));

            try {
                $this->model->insertComment($comment);
            } catch (OptimisticLockException $e) {
                echo "Can't add a new comment.";
            }
        }

        /** Select a post by id */
        if      (isset($_GET['post'])) {
            $this->model->selectPost($_GET['post']);
            $this->model->selectPosts("", Temp::get('postId'));
            $this->view->get('post');
        }

        /** Select post list by Search text */
        elseif  (isset($_GET['search'])) {
            $this->model->selectPosts($_GET['search'], 0);
            $this->view->get('home');
        }
        else    {
            $this->model->selectPosts("", 0);
            $this->view->get('home');
        }
    }

    /**
     *  Create constant Avatar icons from template/images/avatars.
     */
    public function createAvatars()
    {
        $directory = TEMPLATE . "images" . DIR . "avatars" . DIR;
        $files = scandir($directory);

        foreach($files as $file) {
            if(is_file($directory . $file)) {
                $avatarName[] = explode(".", $file)[0];
                $avatarFile[] = $file;
            }
        }

        define("AVATAR_NAME", $avatarName);
        define("AVATAR_FILE", $avatarFile);
    }

    /**
     * Get the called model, or call it. (singleton)
     * @return Model
     */
    public function getModel()
    {
        if($this->model == null) {
            $this->model = new Model($this->entityManager);
        }

        return $this->model;
    }

    /**
     * Get the called view, or call it. (singleton)
     * @return View
     */
    public function getView()
    {
        if($this->view == null) {
            $this->view = new View($this->entityManager);
        }

        return $this->view;
    }

}