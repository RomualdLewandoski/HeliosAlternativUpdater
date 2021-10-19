<?php

namespace App\Entity;

use App\Repository\StatsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatsRepository::class)
 */
class Stats
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $windowsLauncher;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $linuxLauncher;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $macLauncher;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWindowsLauncher(): ?int
    {
        return $this->windowsLauncher;
    }

    public function setWindowsLauncher(?int $windowsLauncher): self
    {
        $this->windowsLauncher = $windowsLauncher;

        return $this;
    }

    public function getLinuxLauncher(): ?int
    {
        return $this->linuxLauncher;
    }

    public function setLinuxLauncher(?int $linuxLauncher): self
    {
        $this->linuxLauncher = $linuxLauncher;

        return $this;
    }

    public function getMacLauncher(): ?int
    {
        return $this->macLauncher;
    }

    public function setMacLauncher(?int $macLauncher): self
    {
        $this->macLauncher = $macLauncher;

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
