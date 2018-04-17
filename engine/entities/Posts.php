<?php

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 *  @Entity
 *  @Table(name="Posts")
 */
class Posts
{
    /**
     * @Id
     * @Column(name="id", type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(name="title", type="string", nullable=false) */
    private $title;

    /** @Column(type="string", nullable=false) */
    private $contentfile;

    /** @Column(type="string", nullable=true) */
    private $headerfile;

    /**
     * @var \DateTime $created
     * @Column(name="created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /** @Column(type="text", nullable=true) */
    private $description;

    /** @Column(type="text", nullable=true) */
    private $tags;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContentfile()
    {
        return $this->contentfile;
    }

    /**
     * @param mixed $contentfile
     */
    public function setContentfile($contentfile)
    {
        $this->contentfile = $contentfile;
    }

    /**
     * @return mixed
     */
    public function getHeaderfile()
    {
        return $this->headerfile;
    }

    /**
     * @param mixed $headerfile
     */
    public function setHeaderfile($headerfile)
    {
        $this->headerfile = $headerfile;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }



}