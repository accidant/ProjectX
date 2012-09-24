<?php

namespace Core\CoreBaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Date: 03.08.12
 * Time: 21:43
 *
 * @author Thomas Joußen
 *
 * @ORM\MappedSuperclass
 */
abstract class BaseEntity{

	/**
	 * Die ID für jede Entität
	 *
	 * @var integer
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * Der Zeitstempel zu welchem Zeitpunkt diese Entität erstellt wurde
	 *
	 * @var \DateTime
	 * @ORM\Column(type="datetime", nullable="true")
	 */
	protected $createDate;

	/**
	 * Der Zeitstempel zu welchem Zeitpunkt diese Entität zuletzt bearbeitet wurde
	 *
	 * @var \DateTime
	 * @ORM\Column(type="datetime", nullable="true")
	 */
	protected $updateDate;

	/**
	 * Der Benutzer, welcher diese Entität erstellt hat
	 *
	 * @var string
	 * @todo Einen BenutzerObjekt implementieren und hier klassifizieren
	 */
	protected $createUser;

	/**
	 * Der Benutzer, welcher diese Entität zuletzt bearbeitet hat
	 *
	 * @var string
	 * @todo Einen BenutzerObjekt implementieren und hier klassifizieren
	 */
	protected $updateUser;

	/**
	 * Entscheidet, ob diese Entität angezeigt werden soll
	 *
	 * @var boolean
	 * @ORM\Column(type="boolean")
	 */
	protected $hidden = false;

	/**
	 * Legt fest, das diese Entität gelöscht ist
	 *
	 * @var boolean
	 * @ORM\Column(type="boolean")
	 */
	protected $deleted = false;

	/**
	 * @return int
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * @param \DateTime $createDate
	 */
	public function setCreateDate(\DateTime $createDate){
		$this->createDate = $createDate;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreateDate(){
		return $this->createDate;
	}

	/**
	 * @param \DateTime $updateDate
	 */
	public function setUpdateDate(\DateTime $updateDate){
		$this->updateDate = $updateDate;
	}

	/**
	 * @return \DateTime
	 */
	public function getUpdateDate(){
		return $this->updateDate;
	}

	/**
	 * @param string $createUser
	 */
	public function setCreateUser($createUser){
		$this->createUser = $createUser;
	}

	/**
	 * @return string
	 */
	public function getCreateUser(){
		return $this->createUser;
	}

	/**
	 * @param string $updateUser
	 */
	public function setUpdateUser($updateUser){
		$this->updateUser = $updateUser;
	}

	/**
	 * @return string
	 */
	public function getUpdateUser(){
		return $this->updateUser;
	}

	/**
	 * @param boolean $hidden
	 */
	public function setHidden($hidden){
		$this->hidden = $hidden;
	}

	/**
	 * @return boolean
	 */
	public function isHidden(){
		return $this->hidden;
	}

	/**
	 * @param boolean $deleted
	 */
	public function setDeleted($deleted){
		$this->deleted = $deleted;
	}

	/**
	 * @return boolean
	 */
	public function isDeleted(){
		return $this->deleted;
	}
}
