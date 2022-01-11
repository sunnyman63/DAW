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
     * @ORM\GeneratedValue(strategy="NONE")
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
    public function __construct($nick="",$correo="",$password="",$buenometro=0,$esRey=0)
    {
        $this->nick = $nick;
        $this->correo = $correo;
        $this->password = password_hash($password,PASSWORD_DEFAULT);
        $this->buenometro = $buenometro;
        $this->regalo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->present = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __set($target,$valor) {
        $this->$target = $valor;
    }

    public function __get($target) {
        return $this->$target;
    }

    //Comprobar que existe o no el usuario
    public function existeUsuario($em) {
        $datos = Array('nick' => $this->nick);
        $user = $em->getRepository("usuario")->findOneBy($datos);
        return !empty($user);
    }

    //Inserción de un usuario en la base de datos
    public function insertarUsuario($em) {
        if(!$this->existeUsuario($em)) {
            $em->persist($this);
            $em->flush();
            return 0;
        } else {
            return null;
        }
    }

    public static function login($em,$user,$pass) {
        $datos = array('nick' => $user);
        $log = $em->getRepository("usuario")->findOneBy($datos);
        if(!empty($log)) {
            if(password_verify($pass,$log->password)) {
                return $log;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function anyadirRegaloALaCarta($em,$regalo) {
        $this->regalo->add($regalo);
        $em->persist($this);
        $em->flush();
    }

    public function eliminarRegaloDeLaCarta($em,$regalo) {
        $this->regalo->removeElement($regalo);
        $em->persist($this);
        $em->flush();
    }

    // public function mostrarCarta() {
    //     $regalos = [];
    //     foreach($this->regalo as $regal) {
    //         $item = [
    //             'nombre'=>$regal->nombre,
    //             'puntos'=>$regal->puntos,
    //             'img'=>base64_encode(stream_get_contents($regal->img,-1,-1)),
    //             'descripcion'=>$regal->descripcion
    //         ];
    //         array_push($regalos,$item);
    //     }
    //     return $regalos;
    // }

    // public function mostrarRegalosRecibidos() {
    //     $regalos = [];
    //     foreach($this->present as $regal) {
    //         $item = [
    //             'nombre'=>$regal->nombre,
    //             'puntos'=>$regal->puntos,
    //             'img'=>base64_encode(stream_get_contents($regal->img,-1,-1)),
    //             'descripcion'=>$regal->descripcion
    //         ];
    //         array_push($regalos,$item);
    //     }
    //     return $regalos;
    // }

    // public function mostrarUsuario() {
    //     $usr = $this;
    //     $usr->regalo = $this->mostrarCarta();
    //     $usr->present = $this->mostrarRegalosRecibidos();

    //     return $usr;
    // }

    public static function listarTodosLosUsuarios($em) {
        $users = $em->getRepository('usuario')->findBy(array('esRey' => false));
        // foreach($users as $user) {
        //     $pedidos = $user->mostrarCarta();
        //     $user->regalo = $pedidos;
        //     $recibidos = $user->mostrarRegalosRecibidos();
        //     $user->present = $recibidos;
        // }
        return $users;
    }
}
