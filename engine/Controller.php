<?php
/**
 * Created by PhpStorm.
 * User: Szotyi Lehet
 * Date: 2018. 04. 17.
 * Time: 13:13
 */

namespace Engine;

use Doctrine\ORM\EntityManager;
use Engine\Entities\Post;

class Controller
{
    /** @var EntityManager */
    private $entityManager;

    /**
     * @param integer $id
     */
    public function selectPost($id)
    {
        $repository = $this->entityManager->getRepository('Engine\Entities\Post');
        $post = $repository->find($id);

        Variable::set('post', $post->getContentfile());
        Variable::set('title', $post->getTitle());
        Variable::set('created', $post->getCreated());
        Variable::set('tags', $post->getTags());

        include TEMPLATE . "post.php";
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertPost() {

        $post = new Post();
        $post->setTitle("Apple");
        $post->setContentfile("oop");
        $post->setHeaderfile("alma");
        $post->setDescription("sds");
        $post->setTags("ssdsa");

        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return "Created post with ID: " . $post->getId() . "\n";
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}