<?php

namespace System\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Date: 20.08.12
 * Time: 13:20
 * @author Thomas Joußen <tjoussen@databay.de>
 * @ORM\Table()
 * @ORM\Entity()
 */
class PageMetadata {

	/**
	 * @var int
	 *
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * Der Seitentitel
	 *
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $title;

	/**
	 * Die Sprache in der die Seite verfasst ist
	 *
	 * @var string
	 * @ORM\Column(type="string", nullable="true")
	 */
	private $language;

	/**
	 * Die Robots, die in den Kopf des HTML eingesetzt werden sollen
	 *
	 * @var string
	 * @ORM\Column(type="string", nullable="true")
	 */
	private $robots;

	/**
	 * Die Beschreibung, welche in den Kopf des HTML eingesetzt werden soll
	 *
	 * @var string
	 * @ORM\Column(type="text", nullable="true")
	 */
	private $description;

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string $language
	 */
	public function setLanguage($language) {
		$this->language = $language;
	}

	/**
	 * @return string
	 */
	public function getLanguage() {
		return $this->language;
	}

	/**
	 * @param \System\CoreBundle\Entity\Page $page
	 */
	public function setPage($page) {
		$this->page = $page;
	}

	/**
	 * @return \System\CoreBundle\Entity\Page
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * @param string $robots
	 */
	public function setRobots($robots) {
		$this->robots = $robots;
	}

	/**
	 * @return string
	 */
	public function getRobots() {
		return $this->robots;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}
}
