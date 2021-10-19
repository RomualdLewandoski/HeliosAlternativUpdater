<?php

namespace App\Entity;

use App\Repository\LauncherConfigRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LauncherConfigRepository::class)
 */
class LauncherConfig
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $fallbackVideo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $fallbackAudio;

    /**
     * @ORM\Column(type="text")
     */
    private $loginApi;

    /**
     * @ORM\Column(type="text")
     */
    private $skinApi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $serverIp;

    /**
     * @ORM\Column(type="integer")
     */
    private $serverPort;

    /**
     * @ORM\Column(type="text")
     */
    private $distroList;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siteName;

    /**
     * @ORM\Column(type="text")
     */
    private $newsApi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $version;

    /**
     * @ORM\Column(type="text")
     */
    private $java;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFallbackVideo(): ?string
    {
        return $this->fallbackVideo;
    }

    public function setFallbackVideo(string $fallbackVideo): self
    {
        $this->fallbackVideo = $fallbackVideo;

        return $this;
    }

    public function getFallbackAudio(): ?string
    {
        return $this->fallbackAudio;
    }

    public function setFallbackAudio(?string $fallbackAudio): self
    {
        $this->fallbackAudio = $fallbackAudio;

        return $this;
    }

    public function getLoginApi(): ?string
    {
        return $this->loginApi;
    }

    public function setLoginApi(string $loginApi): self
    {
        $this->loginApi = $loginApi;

        return $this;
    }

    public function getSkinApi(): ?string
    {
        return $this->skinApi;
    }

    public function setSkinApi(string $skinApi): self
    {
        $this->skinApi = $skinApi;

        return $this;
    }

    public function getServerIp(): ?string
    {
        return $this->serverIp;
    }

    public function setServerIp(string $serverIp): self
    {
        $this->serverIp = $serverIp;

        return $this;
    }

    public function getServerPort(): ?int
    {
        return $this->serverPort;
    }

    public function setServerPort(int $serverPort): self
    {
        $this->serverPort = $serverPort;

        return $this;
    }

    public function getDistroList(): ?string
    {
        return $this->distroList;
    }

    public function setDistroList(string $distroList): self
    {
        $this->distroList = $distroList;

        return $this;
    }

    public function getSiteName(): ?string
    {
        return $this->siteName;
    }

    public function setSiteName(string $siteName): self
    {
        $this->siteName = $siteName;

        return $this;
    }

    public function getNewsApi(): ?string
    {
        return $this->newsApi;
    }

    public function setNewsApi(string $newsApi): self
    {
        $this->newsApi = $newsApi;

        return $this;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getJava(): ?string
    {
        return $this->java;
    }

    public function setJava(string $java): self
    {
        $this->java = $java;

        return $this;
    }


}
