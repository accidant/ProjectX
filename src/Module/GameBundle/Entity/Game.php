<?php

namespace Module\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\CoreBaseBundle\Entity\BaseEntity;

use DateTime;

/**
 * Date: 03.08.12
 * Time: 21:43
 *
 * @author Thomas Jou�en
 *
 * @ORM\Entity()
 * @ORM\Table()
 */
 class Game extends BaseEntity {
 
	/**
	 * @var string
	 * @ORM\Column(type="string", unique=true)
	 */
	private $name;
	
	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $description;
	
	/**
	 * @var string
	 * @ORM\Column(type="string", nullable="true")
	 */
	 private $icon;
	 
	/**
	 * @var boolean
	 * @ORM\Column(type="string", nullable="true")
	 */
	 private $url;
	 
	 /**
	 * @var \System\NewsBundle\Entity\NewsCategory
	 * @ORM\ManyToMany(targetEntity="Core\UserBundle\Entity\User")
	 */
	 private $users;
  

    public function __construct()
    {
        $this->setCreateDate(new DateTime());
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set icon
     *
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * Get icon
     *
     * @return string 
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Add users
     *
     * @param Core\UserBundle\Entity\User $users
     */
    public function addUser(\Core\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}