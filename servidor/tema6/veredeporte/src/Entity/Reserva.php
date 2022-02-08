<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservaRepository::class)
 */
class Reserva
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaHora;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="vigilancias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vigila;

    /**
     * @ORM\ManyToOne(targetEntity=Equipo::class, inversedBy="reservas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipo;

    /**
     * @ORM\ManyToOne(targetEntity=Campo::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $campo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaHora(): ?\DateTimeInterface
    {
        return $this->fechaHora;
    }

    public function setFechaHora(\DateTimeInterface $fechaHora): self
    {
        $this->fechaHora = $fechaHora;

        return $this;
    }

    public function getVigila(): ?Usuario
    {
        return $this->vigila;
    }

    public function setVigila(?Usuario $vigila): self
    {
        $this->vigila = $vigila;

        return $this;
    }

    public function getEquipo(): ?Equipo
    {
        return $this->equipo;
    }

    public function setEquipo(?Equipo $equipo): self
    {
        $this->equipo = $equipo;

        return $this;
    }

    public function getCampo(): ?Campo
    {
        return $this->campo;
    }

    public function setCampo(?Campo $campo): self
    {
        $this->campo = $campo;

        return $this;
    }
}
