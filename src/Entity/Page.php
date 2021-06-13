<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=PageRepository::class)
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="pages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $auteur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFeatured;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAbout;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isTeam;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPartenaire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isConseiladmin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isProjetsocial;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isBenevole;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHistorique;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOrganigramme;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVenir;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isMentionslegales;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isInscription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file5;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /*
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
    */

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getIsFeatured(): ?bool
    {
        return $this->isFeatured;
    }

    public function setIsFeatured(bool $isFeatured): self
    {
        $this->isFeatured = $isFeatured;

        return $this;
    }

    public function getIsAbout(): ?bool
    {
        return $this->isAbout;
    }

    public function setIsAbout(bool $isAbout): self
    {
        $this->isAbout = $isAbout;

        return $this;
    }

    public function getIsTeam(): ?bool
    {
        return $this->isTeam;
    }

    public function setIsTeam(bool $isTeam): self
    {
        $this->isTeam = $isTeam;

        return $this;
    }

    public function getIsPartenaire(): ?bool
    {
        return $this->isPartenaire;
    }

    public function setIsPartenaire(bool $isPartenaire): self
    {
        $this->isPartenaire = $isPartenaire;

        return $this;
    }

    public function getIsConseiladmin(): ?bool
    {
        return $this->isConseiladmin;
    }

    public function setIsConseiladmin(bool $isConseiladmin): self
    {
        $this->isConseiladmin = $isConseiladmin;

        return $this;
    }

    public function getIsProjetsocial(): ?bool
    {
        return $this->isProjetsocial;
    }

    public function setIsProjetsocial(bool $isProjetsocial): self
    {
        $this->isProjetsocial = $isProjetsocial;

        return $this;
    }

    public function getIsBenevole(): ?bool
    {
        return $this->isBenevole;
    }

    public function setIsBenevole(bool $isBenevole): self
    {
        $this->isBenevole = $isBenevole;

        return $this;
    }

    public function getIsHistorique(): ?bool
    {
        return $this->isHistorique;
    }

    public function setIsHistorique(bool $isHistorique): self
    {
        $this->isHistorique = $isHistorique;

        return $this;
    }

    public function getIsOrganigramme(): ?bool
    {
        return $this->isOrganigramme;
    }

    public function setIsOrganigramme(bool $isOrganigramme): self
    {
        $this->isOrganigramme = $isOrganigramme;

        return $this;
    }

    public function getIsVenir(): ?bool
    {
        return $this->isVenir;
    }

    public function setIsVenir(bool $isVenir): self
    {
        $this->isVenir = $isVenir;

        return $this;
    }

    public function getIsMentionslegales(): ?bool
    {
        return $this->isMentionslegales;
    }

    public function setIsMentionslegales(bool $isMentionslegales): self
    {
        $this->isMentionslegales = $isMentionslegales;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIsInscription(): ?bool
    {
        return $this->isInscription;
    }

    public function setIsInscription(bool $isInscription): self
    {
        $this->isInscription = $isInscription;

        return $this;
    }

    public function getFile1(): ?string
    {
        return $this->file1;
    }

    public function setFile1(?string $file1): self
    {
        $this->file1 = $file1;

        return $this;
    }

    public function getFile2(): ?string
    {
        return $this->file2;
    }

    public function setFile2(?string $file2): self
    {
        $this->file2 = $file2;

        return $this;
    }

    public function getFile3(): ?string
    {
        return $this->file3;
    }

    public function setFile3(?string $file3): self
    {
        $this->file3 = $file3;

        return $this;
    }

    public function getFile4(): ?string
    {
        return $this->file4;
    }

    public function setFile4(?string $file4): self
    {
        $this->file4 = $file4;

        return $this;
    }

    public function getFile5(): ?string
    {
        return $this->file5;
    }

    public function setFile5(?string $file5): self
    {
        $this->file5 = $file5;

        return $this;
    }
}
