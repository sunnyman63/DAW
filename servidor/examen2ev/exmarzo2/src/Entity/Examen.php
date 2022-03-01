<?php

namespace App\Entity;

use App\Repository\ExamenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExamenRepository::class)
 */
class Examen
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $curso;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $convocatoria;

    /**
     * @ORM\ManyToOne(targetEntity=Asignatura::class, inversedBy="examenes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $asignatura;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCurso(): ?string
    {
        return $this->curso;
    }

    public function setCurso(string $curso): self
    {
        $this->curso = $curso;

        return $this;
    }

    public function getConvocatoria(): ?string
    {
        return $this->convocatoria;
    }

    public function setConvocatoria(string $convocatoria): self
    {
        $this->convocatoria = $convocatoria;

        return $this;
    }

    public function getAsignatura(): ?Asignatura
    {
        return $this->asignatura;
    }

    public function setAsignatura(?Asignatura $asignatura): self
    {
        $this->pertenece = $asignatura;

        return $this;
    }
}
