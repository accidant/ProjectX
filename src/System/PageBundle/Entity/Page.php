<?php

namespace System\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use System\CoreBundle\Entity\BaseEntity;

/**
 * Date: 20.08.12
 * Time: 12:49
 * @author Thomas Joußen
 * @ORM\Table()
 * @ORM\Entity()
 */
class Page extends BaseEntity{

	/**
	 * Der Name der Seite
	 *
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $name;

	/**
	 * Der Alias für eine Seite. Wird genutzt um in der URL anzuzeigen
	 *
	 * @var string
	 * @ORM\Column(type="string", nullable="true")
	 */
	private $alias;

	/**
	 * Gibt an, ob die Seite im Menu auftauchen soll
	 *
	 * @var boolean
	 * @ORM\Column(type="boolean")
	 */
	private $inMenu;

	/**
	 * Gibt an, welche Seite die Vaterseite dieser Seite ist
	 *
	 * @var Page
	 * @ORM\OneToOne(targetEntity="System\PageBundle\Entity\Page")
	 */
	private $parent;

	/**
	 * Die Metadaten zu dieser Seite
	 *
	 * @var PageMetadata
	 * @ORM\OneToOne(targetEntity="System\PageBundle\Entity\PageMetadata", cascade={"persist", "remove"})
	 */
	private $metadata;

	/**
	 * @param string $alias
	 */
	public function setAlias($alias) {
		$this->alias = $alias;
	}

	/**
	 * @return string
	 */
	public function getAlias() {
		return $this->alias;
	}

	/**
	 * @param boolean $inMenu
	 */
	public function setInMenu($inMenu) {
		$this->inMenu = $inMenu;
	}

	/**
	 * @return boolean
	 */
	public function getInMenu() {
		return $this->inMenu;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param \System\PageBundle\Entity\Page $parent
	 */
	public function setParent($parent) {
		$this->parent = $parent;
	}

	/**
	 * @return \System\PageBundle\Entity\Page
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * @param \System\PageBundle\Entity\PageMetadata $metadata
	 */
	public function setMetadata($metadata) {
		$this->metadata = $metadata;
	}

	/**
	 * @return \System\PageBundle\Entity\PageMetadata
	 */
	public function getMetadata() {
		return $this->metadata;
	}
}
