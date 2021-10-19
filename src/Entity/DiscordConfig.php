<?php

namespace App\Entity;

use App\Repository\DiscordConfigRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiscordConfigRepository::class)
 */
class DiscordConfig
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $clientId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $smallImageKey;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $smallImageText;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function setClientId(?string $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getSmallImageKey(): ?string
    {
        return $this->smallImageKey;
    }

    public function setSmallImageKey(?string $smallImageKey): self
    {
        $this->smallImageKey = $smallImageKey;

        return $this;
    }

    public function getSmallImageText(): ?string
    {
        return $this->smallImageText;
    }

    public function setSmallImageText(?string $smallImageText): self
    {
        $this->smallImageText = $smallImageText;

        return $this;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


}
