<?php

namespace Engine\Entities;

use Doctrine\ORM\Mapping as ORM;
use DoctrineExtensions\Query\Mysql\Date;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 *  @Entity
 *  @Table(name="post")
 */
class Post
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

    public function __construct()
    {
        $this->created = new \DateTime();
    }

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
     * @return string
     */
    public function getCreated()
    {
        $date = $this->created;
        $months = Array("Január", "Február", "Március", "Április", "Május", "Június", "Július", "Augusztus", "Szeptember", "Október", "November", "December");
        $result = $date->format("Y.") . WS;
        $result .= $months[(integer) $date->format("m") - 1] . WS;
        $result .= $date->format("d.") . WS;
        $result .= $date->format("H:i");
        
        return $result;
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
        return explode(",", $this->tags);
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }



}