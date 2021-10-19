<?php

namespace App\Entity;

use App\Repository\ServerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServerRepository::class)
 */
class Server
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
    private $nameId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $version;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $minecraftVersion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mainServer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $autoConnect;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity=ForgeHosted::class, inversedBy="servers")
     */
    private $forgeHosted;

    /**
     * @ORM\ManyToMany(targetEntity=Library::class, mappedBy="servers")
     */
    private $libraries;

    /**
     * @ORM\ManyToMany(targetEntity=Files::class, mappedBy="servers")
     */
    private $files;

    /**
     * @ORM\ManyToMany(targetEntity=Mod::class, mappedBy="servers")
     */
    private $mods;

    /**
     * @ORM\ManyToMany(targetEntity=Shader::class, mappedBy="servers")
     */
    private $shaders;

    /**
     * @ORM\ManyToMany(targetEntity=RessourcePack::class, mappedBy="servers")
     */
    private $ressourcePacks;

    /**
     * @ORM\ManyToOne(targetEntity=Version::class, inversedBy="servers")
     */
    private $versionManifest;

    public function __construct()
    {
        $this->libraries = new ArrayCollection();
        $this->files = new ArrayCollection();
        $this->mods = new ArrayCollection();
        $this->shaders = new ArrayCollection();
        $this->ressourcePacks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameId(): ?string
    {
        return $this->nameId;
    }

    public function setNameId(string $nameId): self
    {
        $this->nameId = $nameId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
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

    public function getMinecraftVersion(): ?string
    {
        return $this->minecraftVersion;
    }

    public function setMinecraftVersion(string $minecraftVersion): self
    {
        $this->minecraftVersion = $minecraftVersion;

        return $this;
    }

    public function getMainServer(): ?bool
    {
        return $this->mainServer;
    }

    public function setMainServer(bool $mainServer): self
    {
        $this->mainServer = $mainServer;

        return $this;
    }

    public function getAutoConnect(): ?bool
    {
        return $this->autoConnect;
    }

    public function setAutoConnect(bool $autoConnect): self
    {
        $this->autoConnect = $autoConnect;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getForgeHosted(): ?ForgeHosted
    {
        return $this->forgeHosted;
    }

    public function setForgeHosted(?ForgeHosted $forgeHosted): self
    {
        $this->forgeHosted = $forgeHosted;

        return $this;
    }

    /**
     * @return Collection|Library[]
     */
    public function getLibraries(): Collection
    {
        return $this->libraries;
    }

    public function addLibrary(Library $library): self
    {
        if (!$this->libraries->contains($library)) {
            $this->libraries[] = $library;
            $library->addServer($this);
        }

        return $this;
    }

    public function removeLibrary(Library $library): self
    {
        if ($this->libraries->removeElement($library)) {
            $library->removeServer($this);
        }

        return $this;
    }

    /**
     * @return Collection|Files[]
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(Files $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->addServer($this);
        }

        return $this;
    }

    public function removeFile(Files $file): self
    {
        if ($this->files->removeElement($file)) {
            $file->removeServer($this);
        }

        return $this;
    }

    /**
     * @return Collection|Mod[]
     */
    public function getMods(): Collection
    {
        return $this->mods;
    }

    public function addMod(Mod $mod): self
    {
        if (!$this->mods->contains($mod)) {
            $this->mods[] = $mod;
            $mod->addServer($this);
        }

        return $this;
    }

    public function removeMod(Mod $mod): self
    {
        if ($this->mods->removeElement($mod)) {
            $mod->removeServer($this);
        }

        return $this;
    }

    /**
     * @return Collection|Shader[]
     */
    public function getShaders(): Collection
    {
        return $this->shaders;
    }

    public function addShader(Shader $shader): self
    {
        if (!$this->shaders->contains($shader)) {
            $this->shaders[] = $shader;
            $shader->addServer($this);
        }

        return $this;
    }

    public function removeShader(Shader $shader): self
    {
        if ($this->shaders->removeElement($shader)) {
            $shader->removeServer($this);
        }

        return $this;
    }

    /**
     * @return Collection|RessourcePack[]
     */
    public function getRessourcePacks(): Collection
    {
        return $this->ressourcePacks;
    }

    public function addRessourcePack(RessourcePack $ressourcePack): self
    {
        if (!$this->ressourcePacks->contains($ressourcePack)) {
            $this->ressourcePacks[] = $ressourcePack;
            $ressourcePack->addServer($this);
        }

        return $this;
    }

    public function removeRessourcePack(RessourcePack $ressourcePack): self
    {
        if ($this->ressourcePacks->removeElement($ressourcePack)) {
            $ressourcePack->removeServer($this);
        }

        return $this;
    }

    public function getVersionManifest(): ?Version
    {
        return $this->versionManifest;
    }

    public function setVersionManifest(?Version $versionManifest): self
    {
        $this->versionManifest = $versionManifest;

        return $this;
    }
}
