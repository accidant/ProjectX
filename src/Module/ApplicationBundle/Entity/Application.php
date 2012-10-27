<?php

namespace Module\ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Core\CoreBaseBundle\Entity\BaseEntity;

/**
 * Date: 03.08.12
 * Time: 21:43
 *
 * @author Florian Hermey
 *
 * @ORM\Entity()
 * @ORM\Table()
 */
 class Application extends BaseEntity {
 
	/**
	 * @var string
	 * @ORM\Column(type="string", nullable="false")
	 */
	private $nickname;
	
        /**
	 * @var string
	 * @ORM\Column(type="string", nullable="false")
	 */
	private $firstname;
        
        /**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $surname;
        
         /**
	 * @var int
	 * @ORM\Column(type="integer", nullable="false")
         * 
         * @todo statt alter, geburtsdatum
	 */
	private $age;
        
        /**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $email;
        
        /**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $skype;
        
        /**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $clanhistory;
        
        /**
	 * @var string
	 * @ORM\Column(type="text", nullable="false")
	 */
	private $text;
        
	/**
	 * @var \Module\GameBundle\Entity\Game
	 * @ORM\OneToMany(targetEntity="Module\GameBundle\Entity\Game", mappedBy="Game")
	 */
	private $games;
  
        
    public function __construct()
    {
        $this->games = new ArrayCollection();
    }
    
    /**
     * Set nickname
     *
     * @param string $nickname
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * Get nickname
     *
     * @return string 
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set surname
     *
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set age
     *
     * @param number $age
     */
    public function setAge(\number $age)
    {
        $this->age = $age;
    }

    /**
     * Get age
     *
     * @return number 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set skype
     *
     * @param string $skype
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;
    }

    /**
     * Get skype
     *
     * @return string 
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Set clanhistory
     *
     * @param string $clanhistory
     */
    public function setClanhistory($clanhistory)
    {
        $this->clanhistory = $clanhistory;
    }

    /**
     * Get clanhistory
     *
     * @return string 
     */
    public function getClanhistory()
    {
        return $this->clanhistory;
    }

    /**
     * Set text
     *
     * @param text $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return text 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Add games
     *
     * @param Module\GameBundle\Entity\Game $games
     */
    public function addGame(\Module\GameBundle\Entity\Game $games)
    {
        $this->games[] = $games;
    }

    /**
     * Get games
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGames()
    {
        return $this->games;
    }
    
    public function __toString()
    {
        return $this->nickname;
    }
}