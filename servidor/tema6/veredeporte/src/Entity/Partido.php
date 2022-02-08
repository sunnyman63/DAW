<?php

namespace App\Entity;

use App\Repository\PartidoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PartidoRepository::class)
 */
class Partido
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
     * @ORM\Column(type="json", nullable=true)
     */
    private $resultado = [];

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="arbitraciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $arbitro;

    /**
     * @ORM\ManyToOne(targetEntity=Campo::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $campo;

    /**
     * @ORM\ManyToOne(targetEntity=Liga::class, inversedBy="partidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $liga;

    /**
     * @ORM\ManyToOne(targetEntity=Equipo::class, inversedBy="partidos_local")
     * @ORM\JoinColumn(nullable=false)
     */
    private $local;

    /**
     * @ORM\ManyToOne(targetEntity=Equipo::class, inversedBy="partidos_visitante")
     * @ORM\JoinColumn(nullable=false)
     */
    private $visitante;

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

    public function getResultado(): ?array
    {
        return $this->resultado;
    }

    public function setResultado(?array $resultado): self
    {
        $this->resultado = $resultado;

        return $this;
    }

    public function getArbitro(): ?Usuario
    {
        return $this->arbitro;
    }

    public function setArbitro(?Usuario $arbitro): self
    {
        $this->arbitro = $arbitro;

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

    public function getLiga(): ?Liga
    {
        return $this->liga;
    }

    public function setLiga(?Liga $liga): self
    {
        $this->liga = $liga;

        return $this;
    }

    public function getLocal(): ?Equipo
    {
        return $this->local;
    }

    public function setLocal(?Equipo $local): self
    {
        $this->local = $local;

        return $this;
    }

    public function getVisitante(): ?Equipo
    {
        return $this->visitante;
    }

    public function setVisitante(?Equipo $visitante): self
    {
        $this->visitante = $visitante;

        return $this;
    }
}
