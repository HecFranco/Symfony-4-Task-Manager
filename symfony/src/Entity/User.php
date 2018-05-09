<?php
// src/Entity/User.php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\HttpFoundation\JsonResponse;


class User implements UserInterface {
    private $id;
		public function getId() { return $this->id; } 
    private $username;
    public function getUsername() { return $this->username; }
    public function setUsername($username) { $this->username = $username; } 		 	
		private $surname;
    public function setSurname($surname) { $this->surname = $surname; return $this; }
    public function getSurname() { return $this->surname; }		
		private $email;
    public function setEmail($email) { $this->email = $email; return $this; }
    public function getEmail() { return $this->email; }		
		private $password;
    public function setPassword($password) { $this->password = $password; return $this; }
    public function getPassword() { return $this->password; }		
    private $createdAt;
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; return $this; }
		public function getCreatedAt() { return $this->createdAt; }
    /* other necessary methods ***********************************************************************************/
    public function getSalt() {
			// The bcrypt and argon2i algorithms don't require a separate salt.
			// You *may* need a real salt if you choose a different encoder.
			return null;
		}
		// other methods, including security methods like getRoles()
		private $role;
			public function setRole($role) { $this->role = $role; /*return $this;*/ }
		public function getRole() { return $this->role; }
		public function getRoles(){ return array('ROLE_USER','ROLE ADMIN'); }
		// ... and eraseCredentials()
		public function eraseCredentials() { }
		/** @see \Serializable::serialize() */
		public function serialize() {
				return serialize(array(
						$this->id,
						$this->username,
						$this->password,
						$this->role,
						// see section on salt below
						// $this->salt,
				));
		}
		public function unserialize($serialized) {
				list (
						$this->id,
						$this->username,
						$this->password,
						// see section on salt below
						// $this->salt
				) = unserialize($serialized);
		} 		
}

