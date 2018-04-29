<?php
/**
 * Created by PhpStorm.
 * User: Szotyi Lehet
 * Date: 2018. 04. 25.
 * Time: 22:58
 */

namespace Engine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;
use Engine\Entities\Post;
use Engine\Entities\Comment;
use Engine\Entities\User;

class Model
{
    /** @var EntityManager */
    private $entityManager;

    function __construct($entitytManager)
    {
        $this->entityManager = $entitytManager;
    }

    /**
     * Select a Post by id
     * @param integer $id
     */
    public function selectPost($id)
    {
        $repository = $this->entityManager->getRepository(Post::class);
        $post = $repository->find($id);

        Temp::set('postId', $post->getId());
        Temp::set('postTitle', $post->getTitle());
        Temp::set('postContent', $post->getContentfile());
        Temp::set('postCreated', $post->getCreated());
        Temp::set('postTags', $post->getTags());

        $this->selectComments($id);

        include TEMPLATE . "post.php";
    }


    /**
     * Insert a new post by class
     * @param $post Post
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertPost($post) {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    /**
     * Select posts by search text, set null if you need all of them
     * @param $search
     */
    public function selectPosts($search) {
        $repository = $this->entityManager->getRepository(Post::class);
        $query = $repository->createQueryBuilder('p')
            ->where("p.title LIKE :search OR p.tags LIKE :search OR p.description LIKE :search")
            ->setParameter('search', '%' . $search . '%')
            ->setMaxResults(POST_PER_PAGE);

        $posts = $query->getQuery()->getResult();

        /** @var Post $post */
        foreach ($posts as $post) {
            Temp::addToArray('postId', $post->getId());
            Temp::addToArray('postTitle', $post->getTitle());
            Temp::addToArray('postCreated', $post->getCreated());
            Temp::addToArray('postHeader', $post->getHeaderfile());
            Temp::addToArray('postDescription', $post->getDescription());
            Temp::addToArray('postTags', $post->getTags());
        }

        include TEMPLATE . "home.php";
    }


    /**
     * Select comments by PostId
     * @param $postid
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function selectComments($postid) {
        $repository = $this->entityManager->getRepository(Comment::class);
        $query = $repository->createQueryBuilder('c')
            ->where("c.postid = :postid")
            ->setParameter('postid', $postid);

        $comments = $query->getQuery()->getResult();

        /** @var Comment $comment */
        foreach ($comments as $comment) {
            Temp::addToArray('commentId', $comment->getId());
            Temp::addToArray('commentUserid', $comment->getUserid());
            Temp::addToArray('commentCreated', $comment->getCreated());
            Temp::addToArray('commentContent', $comment->getContent());

            try {

                /** @var User $user */
                $user = self::selectUser($comment->getUserid());

                Temp::addToArray('commentUserAvatar', AVATAR_FILE[$user->getAvatar()]);
                Temp::addToArray('commentUserName', $user->getName());
                Temp::addToArray('commentUserPrefix', $user->getPrefix());
            } catch (NoResultException $e) {
                Temp::addToArray('commentUserName', 'Removed user');
            }

        }
    }

    /**
     * Insert a new comment by Comment class
     * @param $comment Comment
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertComment($comment) {
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
    }

    /**
     * Select a User by id
     * @param $userid integer
     * @return User
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function selectUser($userid) {
        $repository = $this->entityManager->getRepository(User::class);
        $query = $repository->createQueryBuilder('c')
            ->where("c.id = :id")
            ->setParameter('id', $userid);

        return $query->getQuery()->getSingleResult();
    }
}