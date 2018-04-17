<?php

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 *  @Entity
 *  @Table(name="Users")
 */
class Users
{
    /**
     * @Id
     * @Column(name="id", type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(name="title", type="string", nullable=false) */
    private $name;

    /** @Column(name="avatar", type="integer", nullable=true) */
    private $avatar;

    /** @Column(name="prefix", type="string", nullable=true) */
    private $prefix;

}