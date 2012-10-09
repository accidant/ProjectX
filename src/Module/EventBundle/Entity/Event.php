<?php

namespace Module\EventBundle\Entity;

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
 class Event extends BaseEntity {
 
	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $name;
	
	/**
	 * @var string
	 * @ORM\Column(type="string", nullable="true")
	 */
	private $description;
	
	/**
	 * @var string
	 * @ORM\Column(type="datetime")
	 */
	 private $date;


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
     * Set date
     *
     * @param datetime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return datetime 
     */
    public function getDate()
    {
        return $this->date;
    }
    
    public function __construct() {
        $this->setCreateDate(new DateTime());
        $date = new DateTime();
        $date->add(new DateInterval('P1D'));
        $date->setTime('20','00','00');
        $this->setDate($date);
    }
 }