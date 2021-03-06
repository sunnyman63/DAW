<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table(name="producto", indexes={@ORM\Index(name="idProveedor", columns={"idProveedor"})})
 * @ORM\Entity
 */
class Producto
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
     * @var int
     *
     * @ORM\Column(name="precio", type="integer", nullable=false)
     */
    private $precio;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var \Proveedor
     *
     * @ORM\ManyToOne(targetEntity="Proveedor",inversedBy="productos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProveedor", referencedColumnName="id")
     * })
     */
    private $idproveedor;

    public function __set($target,$valor) {
        $this->$target = $valor;
    }

    public function __get($target) {
        return $this->$target;
    }

}
