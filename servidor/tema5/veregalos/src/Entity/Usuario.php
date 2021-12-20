<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var string
     *
     * @ORM\Column(name="nick", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nick;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=100, nullable=false)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100, nullable=false)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="es_rey", type="integer", nullable=false)
     */
    private $esRey;

    /**
     * @var int
     *
     * @ORM\Column(name="buenometro", type="integer", nullable=false)
     */
    private $buenometro;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Regalo", inversedBy="usuario")
     * @ORM\JoinTable(name="pide",
     *   joinColumns={
     *     @ORM\JoinColumn(name="usuario", referencedColumnName="nick")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="regalo", referencedColumnName="id")
     *   }
     * )
     */
    private $regalo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Regalo", inversedBy="user")
     * @ORM\JoinTable(name="recibe",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user", referencedColumnName="nick")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="present", referencedColumnName="id")
     *   }
     * )
     */
    private $present;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->regalo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->present = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
