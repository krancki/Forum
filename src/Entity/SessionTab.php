<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionTabRepository")
 * @ORM\Table(name="sessions")
 */
class SessionTab
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer",name="id_session")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $islogin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastactivity;

    /**
     * @ORM\Column(type="integer")
     */
    private $users_id;

    public function getId()
    {
        return $this->id;
    }

    public function getIslogin(): ?bool
    {
        return $this->islogin;
    }

    public function setIslogin(bool $islogin): self
    {
        $this->islogin = $islogin;

        return $this;
    }

    public function getLastactivity(): ?\DateTimeInterface
    {
        return $this->lastactivity;
    }

    public function setLastactivity(\DateTimeInterface $lastactivity): self
    {
        $this->lastactivity = $lastactivity;

        return $this;
    }

    public function getUsersId(): ?int
    {
        return $this->users_id;
    }

    public function setUsersId(int $users_id): self
    {
        $this->users_id = $users_id;

        return $this;
    }
}
