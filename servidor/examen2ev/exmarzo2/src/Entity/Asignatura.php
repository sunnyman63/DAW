<?php

namespace App\Entity;

use App\Repository\AsignaturaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AsignaturaRepository::class)
 */
class Asignatura
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
    private $nombre;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_creditos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $curso;

    /**
     * @ORM\OneToMany(targetEntity=Examen::class, mappedBy="pertenece")
     */
    private $examenes;

    public function __construct()
    {
        $this->examenes = new ArrayCollection();
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

    public function getNumCreditos(): ?int
    {
        return $this->num_creditos;
    }

    public function setNumCreditos(int $num_creditos): self
    {
        $this->num_creditos = $num_creditos;

        return $this;
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

    /**
     * @return Collection<int, Examen>
     */
    public function getExamenes(): Collection
    {
        return $this->examenes;
    }

    public function addExamene(Examen $examene): self
    {
        if (!$this->examenes->contains($examene)) {
            $this->examenes[] = $examene;
            $examene->setAsignatura($this);
        }

        return $this;
    }

    public function removeExamene(Examen $examene): self
    {
        if ($this->examenes->removeElement($examene)) {
            // set the owning side to null (unless already changed)
            if ($examene->getAsignatura() === $this) {
                $examene->setAsignatura(null);
            }
        }

        return $this;
    }
}
