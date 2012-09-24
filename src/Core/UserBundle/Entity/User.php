<?php

namespace Core\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\CoreBaseBundle\Entity\BaseEntity;

/**
 * Date: 21.08.12
 * Time: 09:52
 * @author Thomas Joußen <tjoussen@databay.de>
 *
 * @ORM\Table()
 * @ORM\Entity()
 * x@ORM\UniqueEntity(fields={"username"}, message="Dieser Benutzername ist bereits vergeben!")
 */
class User extends BaseEntity{

	/**
	 * Der Benutzername
	 *
	 * @var string
	 * @ORM\Column(type="string", length=50)
	 */
	private $username;

	/**
	 * Das Passwort
	 *
	 * @var string
	 * @ORM\Column(type="string", length=128)
	 */
	private $password;

	/**
	 * @param string $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param string $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * @return string
	 */
	public function getUsername() {
		return $this->username;
	}
}
