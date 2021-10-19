<?php

namespace App\Entity;

use App\Repository\DownloadRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DownloadRepository::class)
 */
class Download
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $windowsFile;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true))
     */
    private $linuxFile;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true))
     */
    private $macFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getWindowsFile(): string
    {
        return $this->windowsFile;
    }

    /**
     * @param string $windowsFile
     */
    public function setWindowsFile(string $windowsFile): void
    {
        $this->windowsFile = $windowsFile;
    }

    /**
     * @return string
     */
    public function getLinuxFile(): string
    {
        return $this->linuxFile;
    }

    /**
     * @param string $linuxFile
     */
    public function setLinuxFile(string $linuxFile): void
    {
        $this->linuxFile = $linuxFile;
    }

    /**
     * @return string
     */
    public function getMacFile(): string
    {
        return $this->macFile;
    }

    /**
     * @param string $macFile
     */
    public function setMacFile(string $macFile): void
    {
        $this->macFile = $macFile;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


}
