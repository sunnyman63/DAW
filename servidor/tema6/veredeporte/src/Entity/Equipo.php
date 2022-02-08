<?php

namespace App\Entity;

use App\Repository\EquipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipoRepository::class)
 */
class Equipo
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
     * @ORM\OneToMany(targetEntity=Usuario::class, mappedBy="equipo")
     */
    private $jugadores;

    /**
     * @ORM\ManyToMany(targetEntity=Usuario::class, inversedBy="solicitudes")
     */
    private $solicitudes;

    /**
     * @ORM\OneToMany(targetEntity=Reserva::class, mappedBy="equipo", orphanRemoval=true)
     */
    private $reservas;

    /**
     * @ORM\ManyToOne(targetEntity=Liga::class, inversedBy="equipos")
     */
    private $liga;

    /**
     * @ORM\OneToMany(targetEntity=Partido::class, mappedBy="local")
     */
    private $partidos_local;

    /**
     * @ORM\OneToMany(targetEntity=Partido::class, mappedBy="visitante")
     */
    private $partidos_visitante;

    public function __construct()
    {
        $this->jugadores = new ArrayCollection();
        $this->solicitudes = new ArrayCollection();
        $this->reservas = new ArrayCollection();
        $this->partidos_local = new ArrayCollection();
        $this->partidos_visitante = new ArrayCollection();
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

    /**
     * @return Collection|Usuario[]
     */
    public function getJugadores(): Collection
    {
        return $this->jugadores;
    }

    public function addJugadore(Usuario $jugadore): self
    {
        if (!$this->jugadores->contains($jugadore)) {
            $this->jugadores[] = $jugadore;
            $jugadore->setEquipo($this);
        }

        return $this;
    }

    public function removeJugadore(Usuario $jugadore): self
    {
        if ($this->jugadores->removeElement($jugadore)) {
            // set the owning side to null (unless already changed)
            if ($jugadore->getEquipo() === $this) {
                $jugadore->setEquipo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Usuario[]
     */
    public function getSolicitudes(): Collection
    {
        return $this->solicitudes;
    }

    public function addSolicitude(Usuario $solicitude): self
    {
        if (!$this->solicitudes->contains($solicitude)) {
            $this->solicitudes[] = $solicitude;
        }

        return $this;
    }

    public function removeSolicitude(Usuario $solicitude): self
    {
        $this->solicitudes->removeElement($solicitude);

        return $this;
    }

    /**
     * @return Collection|Reserva[]
     */
    public function getReservas(): Collection
    {
        return $this->reservas;
    }

    public function addReserva(Reserva $reserva): self
    {
        if (!$this->reservas->contains($reserva)) {
            $this->reservas[] = $reserva;
            $reserva->setEquipo($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getEquipo() === $this) {
                $reserva->setEquipo(null);
            }
        }

        return $this;
    }

    public function getLiga(): ?Liga
    {
        return $this->liga;
    }

    public function setLiga(?Liga $liga): self
    {
        $this->liga = $liga;

        return $this;
    }

    /**
     * @return Collection|Partido[]
     */
    public function getPartidosLocal(): Collection
    {
        return $this->partidos_local;
    }

    public function addPartidosLocal(Partido $partidosLocal): self
    {
        if (!$this->partidos_local->contains($partidosLocal)) {
            $this->partidos_local[] = $partidosLocal;
            $partidosLocal->setLocal($this);
        }

        return $this;
    }

    public function removePartidosLocal(Partido $partidosLocal): self
    {
        if ($this->partidos_local->removeElement($partidosLocal)) {
            // set the owning side to null (unless already changed)
            if ($partidosLocal->getLocal() === $this) {
                $partidosLocal->setLocal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Partido[]
     */
    public function getPartidosVisitante(): Collection
    {
        return $this->partidos_visitante;
    }

    public function addPartidosVisitante(Partido $partidosVisitante): self
    {
        if (!$this->partidos_visitante->contains($partidosVisitante)) {
            $this->partidos_visitante[] = $partidosVisitante;
            $partidosVisitante->setVisitante($this);
        }

        return $this;
    }

    public function removePartidosVisitante(Partido $partidosVisitante): self
    {
        if ($this->partidos_visitante->removeElement($partidosVisitante)) {
            // set the owning side to null (unless already changed)
            if ($partidosVisitante->getVisitante() === $this) {
                $partidosVisitante->setVisitante(null);
            }
        }

        return $this;
    }
}
