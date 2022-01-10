<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Regalo
 *
 * @ORM\Table(name="regalo")
 * @ORM\Entity
 */
class Regalo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="puntos", type="integer", nullable=false)
     */
    private $puntos;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="blob", length=16777215, nullable=false)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=500, nullable=false)
     */
    private $descripcion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="regalo")
     */
    private $usuario;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="present")
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __set($target,$valor) {
        $this->$target = $valor;
    }

    public function __get($target) {
        return $this->$target;
    }

    public function mostrarQuienLoHanPedido() {
        $users = [];
        foreach($this->usuario as $usu) {
            $ninyo = [
                'nick'=>$usu->nick,
                'correo'=>$usu->correo,
                'buenometro'=>$usu->buenometro
            ];
            array_push($users,$ninyo);
        }
        return $users;
    }

    public function mostrarQuienLoHaRecibido() {
        $users = [];
        foreach($this->user as $usu) {
            $ninyo = [
                'nick'=>$usu->nick,
                'correo'=>$usu->correo,
                'buenometro'=>$usu->buenometro
            ];
            array_push($users,$ninyo);
        }
        return $users;
    }

    public static function listarTodosLosRegalos($em) {
        $regalos = $em->getRepository('regalo')->findAll();
        foreach($regalos as $regalo) {
            $img = base64_encode(stream_get_contents($regalo->img,-1,-1));
            $regalo->img = $img;
            $pedidos = $regalo->mostrarQuienLoHanPedido();
            $regalo->usuario = $pedidos;
            $recibidos = $regalo->mostrarQuienLoHaRecibido();
            $regalo->user = $recibidos;
        }
        return $regalos;
    }
}
