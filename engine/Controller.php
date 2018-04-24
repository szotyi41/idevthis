<?php
/**
 * Created by PhpStorm.
 * User: Szotyi Lehet
 * Date: 2018. 04. 17.
 * Time: 13:13
 */

namespace Engine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Engine\Entities\Post;
use Engine\Entities\Comment;
use Engine\Entities\User;

class Controller
{
    /** @var EntityManager */
    private $entityManager;

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

    /**
     * @param integer $id
     */
    public function selectPost($id)
    {
        $repository = $this->entityManager->getRepository('Engine\Entities\Post');
        $post = $repository->find($id);

        Variable::set('postId', $post->getId());
        Variable::set('postTitle', $post->getTitle());
        Variable::set('postContent', $post->getContentfile());
        Variable::set('postCreated', $post->getCreated());
        Variable::set('postTags', $post->getTags());

        $this->selectComments($id);

        include TEMPLATE . "post.php";
    }


    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertPost() {
        $post = new Post();
        $post->setTitle("Composer és a Dependenciakezelés");
        $post->setContentfile("composer.html");
        $post->setDescription("");
        $post->setTags("");

        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return "Created post with ID: " . $post->getId() . "\n";
    }

    public function selectPosts($search) {
        $repository = $this->entityManager->getRepository('Engine\Entities\Post');
        $query = $repository->createQueryBuilder('p')
            ->where("p.title LIKE :search OR p.tags LIKE :search OR p.description LIKE :search")
            ->setParameter('search', '%' . $search . '%')
            ->setMaxResults(POST_PER_PAGE);

        $posts = $query->getQuery()->getResult();

        /** @var Post $post */
        foreach ($posts as $post) {
            Variable::addToArray('postId', $post->getId());
            Variable::addToArray('postTitle', $post->getTitle());
            Variable::addToArray('postCreated', $post->getCreated());
            Variable::addToArray('postHeader', $post->getHeaderfile());
            Variable::addToArray('postDescription', $post->getDescription());
            Variable::addToArray('postTags', $post->getTags());
        }

        include TEMPLATE . "home.php";
    }


    public function selectComments($postid) {
        $repository = $this->entityManager->getRepository('Engine\Entities\Comment');
        $query = $repository->createQueryBuilder('c')
            ->where("c.postid = :postid")
            ->setParameter('postid', $postid);

        $comments = $query->getQuery()->getResult();

        /** @var Comment $comment */
        foreach ($comments as $comment) {
            Variable::addToArray('commentId', $comment->getId());
            Variable::addToArray('commentUserid', $comment->getUserid());
            Variable::addToArray('commentCreated', $comment->getCreated());
            Variable::addToArray('commentContent', $comment->getContent());

            try {

                /** @var User $user */
                $user = self::selectUser($comment->getUserid());

                Variable::addToArray('commentUserAvatar', $user->getAvatar());
                Variable::addToArray('commentUserName', $user->getName());
                Variable::addToArray('commentUserPrefix', $user->getPrefix());
            } catch (NoResultException $e) {
                Variable::addToArray('commentUserName', 'Removed user');
            }

        }
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertComment() {
        $comment = new Comment();
        $comment->setPostid(Variable::get('post'));
        $comment->setUserid(1);
        $comment->setContent($_POST['content']);

        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        echo "Created post with ID: " . $comment->getId() . "\n";
    }

    /**
     * @param $userid integer
     * @return User
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function selectUser($userid) {
        $repository = $this->entityManager->getRepository('Engine\Entities\User');
        $query = $repository->createQueryBuilder('c')
            ->where("c.id = :id")
            ->setParameter('id', $userid);

        return $query->getQuery()->getSingleResult();
    }

}