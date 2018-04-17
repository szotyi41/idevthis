<?php

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 *  @Entity
 *  @Table(name="Comments")
 */
class Comments
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
     * @var \DateTime $posted
     * @Column(name="posted", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /** @Column(name="comment", type="text", nullable=false) */
    private $comment;

}