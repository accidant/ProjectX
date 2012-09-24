<?php

namespace System\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\CoreBaseBundle\Entity\BaseEntity;

/**
 * Date: 03.08.12
 * Time: 21:43
 *
 * @author Thomas Jou�en
 *
 * @ORM\Entity()
 * @ORM\Table()
 */
 class NewsCategory extends BaseEntity {
 
	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $name;
	
	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $description;
	
	
	 /**
	 * @var \System\NewsBundle\Entity\NewsCategory
	 * @ORM\OneToMany(targetEntity="System\NewsBundle\Entity\News", mappedBy="newsCategory")
	 */
	 private $news;
	 
	 
	 // TODO: Rechte!
         
    public function __construct()
    {
        $this->news = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add news
     *
     * @param System\NewsBundle\Entity\News $news
     */
    public function addNews(\System\NewsBundle\Entity\News $news)
    {
        $this->news[] = $news;
    }

    /**
     * Get news
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getNews()
    {
        return $this->news;
    }
    
    
    public function __toString()
    {
        return $this->name;
    }
}