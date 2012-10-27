<?php

namespace System\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\CoreBaseBundle\Entity\BaseEntity;
use DateTime;
use DateInterval;

/**
 * Date: 03.08.12
 * Time: 21:43
 *
 * @author Florian Hermey
 *
 * @ORM\Entity()
 * @ORM\Table()
 */
 class News extends BaseEntity {
 
	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $title;
	
	/**
	 * @var string
	 * @ORM\Column(type="string", nullable="true")
	 */
	private $subtitle;
	
	/**
	 * @var string
	 * @ORM\Column(type="text")
	 */
	 private $content;
	 
	 /**
	 * @var \DateTime
	 * @ORM\Column(type="datetime", nullable="true")
	 */
	 private $startDate;
	 
	 /**
	 * @var \DateTime
	 * @ORM\Column(type="datetime", nullable="true")
	 */
	 private $endDate;
	 
	 /**
	 * @var boolean
	 * @ORM\Column(type="boolean")
	 */
	 private $published;
	 
	/**
	 * @var boolean
	 * @ORM\Column(type="boolean")
	 */
	 private $commentsAllowed;
	 
	 /**
	 * @var \System\NewsBundle\Entity\NewsCategory
	 * @ORM\ManyToOne(targetEntity="System\NewsBundle\Entity\NewsCategory", inversedBy="news")
	 */
	 private $newsCategory;


	public function __construct()
	{
		 $this->setCreateDate(new DateTime());
		 $date_start = new DateTime();
		 $this->setStartDate($date_start);
		 $date_end = new DateTime();
		 $date_end->add(new DateInterval('P7D'));
		 $this->setEndDate($date_end);
		 $this->setCommentsAllowed(true);
	}

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Get subtitle
     *
     * @return string 
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set startDate
     *
     * @param datetime $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * Get startDate
     *
     * @return datetime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param datetime $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * Get endDate
     *
     * @return datetime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set published
     *
     * @param boolean $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set commentsAllowed
     *
     * @param boolean $commentsAllowed
     */
    public function setCommentsAllowed($commentsAllowed)
    {
        $this->commentsAllowed = $commentsAllowed;
    }

    /**
     * Get commentsAllowed
     *
     * @return boolean 
     */
    public function getCommentsAllowed()
    {
        return $this->commentsAllowed;
    }


    /**
     * Set newsCategory
     *
     * @param System\NewsBundle\Entity\NewsCategory $newsCategory
     */
    public function setNewsCategory(\System\NewsBundle\Entity\NewsCategory $newsCategory)
    {
        $this->newsCategory = $newsCategory;
    }

    /**
     * Get newsCategory
     *
     * @return System\NewsBundle\Entity\NewsCategory 
     */
    public function getNewsCategory()
    {
        return $this->newsCategory;
    }
    
    public function __toString()
    {
        return $this->title;
    }
    
}