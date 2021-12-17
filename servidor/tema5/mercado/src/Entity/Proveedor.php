<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Proveedor
 *
 * @ORM\Table(name="proveedor")
 * @ORM\Entity
 */
class Proveedor
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
     * @ORM\Column(name="edad", type="integer", nullable=false)
     */
    private $edad;

    /** 
     * 
     * Un proveedor tiene muchos productos 
     * @ORM\OneToMany(targetEntity="Producto", mappedBy="idproveedor") 
     */

    private $productos;

    public function __construct() { $this->productos = new ArrayCollection(); } 

    public function __set($target,$valor) {
        $this->$target = $valor;
    }

    public function __get($target) {
        return $this->$target;
    }
}
