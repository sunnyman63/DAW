<?php

namespace App\Entity;

use App\Repository\LigaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LigaRepository::class)
 */
class Liga
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $tipo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_inicio;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha_fin;

    /**
     * @ORM\OneToMany(targetEntity=Equipo::class, mappedBy="liga")
     */
    private $equipos;

    /**
     * @ORM\OneToMany(targetEntity=Partido::class, mappedBy="liga", orphanRemoval=true)
     */
    private $partidos;

    /**
     * @ORM\OneToMany(targetEntity=Equipo::class, mappedBy="solicitarParticipar")
     */
    private $solicitudes;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxEquipos;

    public function __construct()
    {
        $this->equipos = new ArrayCollection();
        $this->partidos = new ArrayCollection();
        $this->solicitudes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio(\DateTimeInterface $fecha_inicio): self
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(?\DateTimeInterface $fecha_fin): self
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    /**
     * @return Collection|Equipo[]
     */
    public function getEquipos(): Collection
    {
        return $this->equipos;
    }

    public function addEquipo(Equipo $equipo): self
    {
        if (!$this->equipos->contains($equipo)) {
            $this->equipos[] = $equipo;
            $equipo->setLiga($this);
        }

        return $this;
    }

    public function removeEquipo(Equipo $equipo): self
    {
        if ($this->equipos->removeElement($equipo)) {
            // set the owning side to null (unless already changed)
            if ($equipo->getLiga() === $this) {
                $equipo->setLiga(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Partido[]
     */
    public function getPartidos(): Collection
    {
        return $this->partidos;
    }

    public function addPartido(Partido $partido): self
    {
        if (!$this->partidos->contains($partido)) {
            $this->partidos[] = $partido;
            $partido->setLiga($this);
        }

        return $this;
    }

    public function removePartido(Partido $partido): self
    {
        if ($this->partidos->removeElement($partido)) {
            // set the owning side to null (unless already changed)
            if ($partido->getLiga() === $this) {
                $partido->setLiga(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Equipo[]
     */
    public function getSolicitudes(): Collection
    {
        return $this->solicitudes;
    }

    public function addSolicitude(Equipo $solicitude): self
    {
        if (!$this->solicitudes->contains($solicitude)) {
            $this->solicitudes[] = $solicitude;
            $solicitude->setSolicitarParticipar($this);
        }

        return $this;
    }

    public function removeSolicitude(Equipo $solicitude): self
    {
        if ($this->solicitudes->removeElement($solicitude)) {
            // set the owning side to null (unless already changed)
            if ($solicitude->getSolicitarParticipar() === $this) {
                $solicitude->setSolicitarParticipar(null);
            }
        }

        return $this;
    }

    public function getMaxEquipos(): ?int
    {
        return $this->maxEquipos;
    }

    public function setMaxEquipos(int $maxEquipos): self
    {
        $this->maxEquipos = $maxEquipos;

        return $this;
    }
}
