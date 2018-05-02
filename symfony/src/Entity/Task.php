<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class Task {
    private $id;
    public function getId() { return $this->id; }    
    private $title;
    public function setTitle($title) { $this->title = $title; return $this; }
    public function getTitle() { return $this->title; }    
    private $description;
    public function setDescription($description) { $this->description = $description; return $this; }
    public function getDescription() { return $this->description; }    
    private $status;
    public function setStatus($status) { $this->status = $status; return $this; }
    public function getStatus() { return $this->status; }    
    private $createdAt;
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; return $this; }
    public function getCreatedAt() { return $this->createdAt; }    
    private $updatedAt;
    public function setUpdatedAt($updatedAt) { $this->updatedAt = $updatedAt; return $this; }
    public function getUpdatedAt() { return $this->updatedAt; }    
    private $user;
    public function setUser(User $user = null) { $this->user = $user; return $this; }
    public function getUser() { return $this->user; }
}