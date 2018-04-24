<?php

namespace Engine\Entities;

use Engine\DateCount;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 *  @Entity
 *  @Table(name="comment")
 */
class Comment
{
    /**
     * @Id
     * @Column(name="id", type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(name="userid", type="integer")
     */
    private $userid;

    /**
     * @Column(name="postid", type="integer")
     */
    private $postid;

    /**
     * @var \DateTime $created
     * @Column(name="created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /** @Column(name="content", type="text", nullable=false) */
    private $content;

    /**
     * Timestamp the created variable.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return integer
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param integer $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * @return integer
     */
    public function getPostid()
    {
        return $this->postid;
    }

    /**
     * @param integer $postid
     */
    public function setPostid($postid)
    {
        $this->postid = $postid;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return DateCount::getNormal($this->created);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

}