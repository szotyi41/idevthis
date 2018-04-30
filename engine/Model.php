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
     * @var Post post
     * @throws NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function selectPost($id)
    {
        $repository = $this->entityManager->getRepository(Post::class);
        $post = $repository->find($id);

        Temp::set('postId', $post->getId());
        Temp::set('postTitle', $post->getTitle());
        Temp::set('postContent', $post->getContentfile());
        Temp::set('postCreated', $post->getCreated());
        Temp::set('postHeader', $post->getHeaderfile());
        Temp::set('postTags', $post->getTags());

        $this->selectComments($id);
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
     * @param $search string
     * @param $id
     */
    public function selectPosts($search, $id) {
        $repository = $this->entityManager->getRepository(Post::class);
        $query = $repository->createQueryBuilder("p")
            ->where("(p.id <> :noid) AND (p.title LIKE :search OR p.tags LIKE :search OR p.description LIKE :search)")
            ->setParameters(array("search" => "%" . $search . "%", "noid" => $id))
            ->setMaxResults(POST_PER_PAGE);

        $posts = $query->getQuery()->getResult();

        /** @var Post $post */
        foreach ($posts as $post) {
            Temp::addToArray('postsId', $post->getId());
            Temp::addToArray('postsTitle', $post->getTitle());
            Temp::addToArray('postsCreated', $post->getCreated());
            Temp::addToArray('postsHeader', $post->getHeaderfile());
            Temp::addToArray('postsDescription', $post->getDescription());
            Temp::addToArray('postsTags', $post->getTags());
        }
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