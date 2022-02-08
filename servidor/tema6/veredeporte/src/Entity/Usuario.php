<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 */
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $curso;

    /**
     * @ORM\OneToMany(targetEntity=Reserva::class, mappedBy="vigila")
     */
    private $vigilancias;

    /**
     * @ORM\ManyToOne(targetEntity=Equipo::class, inversedBy="jugadores")
     */
    private $equipo;

    /**
     * @ORM\ManyToMany(targetEntity=Equipo::class, mappedBy="solicitudes")
     */
    private $solicitudes;

    /**
     * @ORM\OneToMany(targetEntity=Partido::class, mappedBy="arbitro")
     */
    private $arbitraciones;

    public function __construct()
    {
        $this->vigilancias = new ArrayCollection();
        $this->solicitudes = new ArrayCollection();
        $this->arbitraciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getCurso(): ?string
    {
        return $this->curso;
    }

    public function setCurso(?string $curso): self
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * @return Collection|Reserva[]
     */
    public function getVigilancias(): Collection
    {
        return $this->vigilancias;
    }

    public function addVigilancia(Reserva $vigilancia): self
    {
        if (!$this->vigilancias->contains($vigilancia)) {
            $this->vigilancias[] = $vigilancia;
            $vigilancia->setVigila($this);
        }

        return $this;
    }

    public function removeVigilancia(Reserva $vigilancia): self
    {
        if ($this->vigilancias->removeElement($vigilancia)) {
            // set the owning side to null (unless already changed)
            if ($vigilancia->getVigila() === $this) {
                $vigilancia->setVigila(null);
            }
        }

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
            $solicitude->addSolicitude($this);
        }

        return $this;
    }

    public function removeSolicitude(Equipo $solicitude): self
    {
        if ($this->solicitudes->removeElement($solicitude)) {
            $solicitude->removeSolicitude($this);
        }

        return $this;
    }

    /**
     * @return Collection|Partido[]
     */
    public function getArbitraciones(): Collection
    {
        return $this->arbitraciones;
    }

    public function addArbitracione(Partido $arbitracione): self
    {
        if (!$this->arbitraciones->contains($arbitracione)) {
            $this->arbitraciones[] = $arbitracione;
            $arbitracione->setArbitro($this);
        }

        return $this;
    }

    public function removeArbitracione(Partido $arbitracione): self
    {
        if ($this->arbitraciones->removeElement($arbitracione)) {
            // set the owning side to null (unless already changed)
            if ($arbitracione->getArbitro() === $this) {
                $arbitracione->setArbitro(null);
            }
        }

        return $this;
    }
}
